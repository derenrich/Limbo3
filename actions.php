<?php

function assert_key($key, $arr) {
  if(!array_key_exists($key,$arr)) {
    echo "Missing field: " . $key;
    die;
  }
}

function mail_users($from,$to,$amount,$reason) {
  $from_real_name = $from->getRealName();
  if ($from_real_name == "") {
    $from_real_name = $from->getUsername();
  }
  $to_real_name = $to->getRealName();
  if ($to_real_name == "") {
    $to_real_name = $to->getUsername();
  }
  if ($from->getEmail() != "") {
    $subject = "[Limbo] Transfer Notification";
    $body = "Hi " . $from_real_name . ",\n\nA transfer of " . $amount . " dollars has been initiated from you to " . $to_real_name . " for the reason:\n\t\"" . $reason . "\"\n\nYour balance is now " . format_currency($from->getBalance()) . ".\n\nSincerely,\nLimbo";
    mail($from->getEmail(),$subject,$body);
  }
  if ($to->getEmail() != "") {
    $subject = "[Limbo] Transfer Notification";
    $body = "Hi " . $to_real_name . ",\n\nA transfer of " . $amount . " dollars has been initiated to you from " . $from_real_name . " for the reason:\n\t\"" . $reason . "\"\n\nYour balance is now " . format_currency($to->getBalance()) . ".\n\nSincerely,\nLimbo";
    mail($from->getEmail(),$subject,$body);
  }
}

function parse_user($user_id) {
  $user = null;
  if (is_numeric($user_id)) {
    // assume this user is being specified by id
    $user = UserQuery::create()->findOneById($user_id);
  } else {
    $user = UserQuery::create()->findOneByUsername($user_id);
  }
  return $user;
}

function parse_item($item_id) {
  if (is_numeric($item_id)) {
    if (strlen($item_id)==12) {
      // UPC
      $item = ItemQuery::create()->findOneByUPC($item_id);      
    } else {
      $item = ItemQuery::create()->findOneById($item_id);    
    }
  } else {
    $item = ItemQuery::create()->findOneByName($item_id);
  }
  return $item;
}

function deposit($user, $amount) {
  //transactional
  //negative for withdraw
  // terrible double comparison...whoops
  if ($amount != 0.0) {
    $con = Propel::getConnection(UserPeer::DATABASE_NAME);
    $con->beginTransaction();
    try {
      $new_balance = $user->getBalance() + $amount;
      $user->setBalance($new_balance);
      $user->save($con);
      $d = new Deposit();
      $d->setUser($user);
      $d->setAmount($amount);
      $d->save($con);
      $bl = new BalanceLog();
      $bl->setUser($user);
      $bl->setNewBalance($new_balance);
      $bl->setDeposit($d);
      $bl->save($con);
      $con->commit();
    } catch (Exception $e) {
      $con->rollback();
      throw $e;
      return true;
    }
  }
  return false;

}


function transfer($from, $to, $amount,$reason) {
  //transactional
  //negative for withdraw
  $con = Propel::getConnection(UserPeer::DATABASE_NAME);
  $con->beginTransaction();
  try {
    // remove the amount from $fromAccount
    $from->setBalance($from->getBalance() - $amount);
    $from->save($con);
    $to->setBalance($to->getBalance() + $amount);
    $to->save($con);

    $trans = new Transfer();
    $trans->setUserFrom($from);
    $trans->setUserTo($to);
    $trans->SetReason($reason);
    $trans->SetAmount($amount);
    $trans->save($con);

    $bl = new BalanceLog();
    $bl->setUser($from);
    $bl->setNewBalance($from->getBalance());
    $bl->setTransfer($trans);
    $bl->save($con);

    $bl = new BalanceLog();
    $bl->setUser($to);
    $bl->setNewBalance($to->getBalance());
    $bl->setTransfer($trans);
    $bl->save($con);

    $con->commit();
    mail_users($from,$to,$amount,$reason);
  } catch (Exception $e) {
    $con->rollback();
    throw $e;
    return true;
  }
  return false;
}


function purchase($user, $items) {
  //transactional
  //negative for withdraw
  $con = Propel::getConnection(PurchasePeer::DATABASE_NAME);
  $con->beginTransaction();
  $total_price = 0;
  try {
    foreach($items as $item) {
      $stock = $item[0];
      $count = $item[1];
      $option_list = OptionQuery::create()->findByUserId($user);
      $item_obj = $stock->getItem();
      $stock_quantity = $stock->getQuantity() - $stock->getSold();
      if ($stock_quantity < $count) {
	// we don't have enough
	throw new Exception("Not enough stock");
      }
      $purchase = new Purchase();
      $purchase->setUser($user);
      $purchase->setStock($stock);
      $purchase->setItem($item_obj);
      $purchase->setQuantity($count);
      $cost = $stock->getPrice() * $count;
      $purchase->setPrice($cost);
      $purchase->save();
      $stock->setSold($stock->getSold() + $count);
      if ($stock->getQuantity() == $stock->getSold()) {
	$stock->setSoldOut(true);
      }
      $stock->save();
      foreach ($option_list as $option) {
        if ($option->getItem() == $item_obj && $option->getPrice() >= $stock->getPrice()) {
          $option->setSold($option->getSold() + $count);
          if ($option->getQuantity() == $option->getSold()) {
            $option->setSoldOut(true);
          }
          $option->save();
        }
      }
      $total_price += $cost;
    }
    // deal w/ the money
    $user->setBalance($user->getBalance() - $total_price);
    $user->save();
    $owner = $stock->getUser();
    $owner->setBalance($owner->getBalance() + $total_price);
    $owner->save();

    // log the money
    $bl = new BalanceLog();
    $bl->setUser($user);
    $bl->setNewBalance($user->getBalance());
    $bl->setPurchase($purchase);
    $bl->save();

    $bl = new BalanceLog();
    $bl->setUser($owner);
    $bl->setNewBalance($owner->getBalance());
    $bl->setSale($purchase);
    $bl->save();

    $con->commit();
  } catch (Exception $e) {
    var_dump($e);
    $con->rollback();
    return true;
  }
  return false;
}

?>
