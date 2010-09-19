<?php

function assert_key($key, $arr) {
  if(!array_key_exists($key,$arr)) {
    echo "Missing field: " . $key;
    die;
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
  $con = Propel::getConnection(UserPeer::DATABASE_NAME);
  $con->beginTransaction();
  try {
    // remove the amount from $fromAccount
    $user->setBalance($user->getBalance() + $amount);
    $user->save($con);
    $con->commit();
  } catch (Exception $e) {
    $con->rollback();
    return true;
  }
  return false;
}


function transfer($from, $to, $amount) {
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
    $con->commit();
  } catch (Exception $e) {
    $con->rollback();
    throw $e;
    return true;
  }
  return false;
}


function purchase($user, $items, $quantity) {

}



?>