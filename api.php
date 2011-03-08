<?php
require_once('db.php');
require_once('actions.php');
require_once('config.php');

assert_key('action', $_POST);
assert_key('acting_user', $_POST);
$acting_user = parse_user($_POST['acting_user']);

if (is_null($acting_user)) {
  echo "Invalid user";
  die;
}

if($maintenance) {
  echo "Error: Limbo is in maintenance mode. ";
  die;
}

$action = $_POST['action'];
$error= false;
switch($action){
  case "transfer":
    assert_key('amount', $_POST);
    assert_key('reason', $_POST);
    assert_key('target_user', $_POST);
    assert_key('direction', $_POST);
    $to = parse_user($_POST['target_user']);
    $direction = $_POST['direction'] == 'to' ? 1 : -1;
    $reason = $_POST['reason'];
    $error= transfer($acting_user, $to, $direction * ((double) $_POST['amount']), $reason);
    break;
  case 'deposit':
    assert_key('amount', $_POST);
    $amount = (double) $_POST['amount'];
    $error = deposit($acting_user, $amount);
    break;
  case 'withdraw':
    assert_key('amount', $_POST);
    $amount = (double) $_POST['amount'];
    $error = deposit($acting_user, -$amount);
    break;
  case 'purchase':
    // we need a count of each id
    $cart = $_POST['cart'];
    $items = array();
    if(count($cart) == 0){
      $cart = array();
    }
    foreach($cart as $item) {
      $item_id = (int) $item;
      if($items[$item_id] == null) {
	$items[$item_id] = 1;
      } else {
	$items[$item_id] += 1;
      }
    }
    // convert these ids to stocks
    $stock_count = array();
    foreach($items as $stock_id => $count) {
      $stock = StockQuery::create()->findOneById($stock_id);
      $stock_count[] = array($stock, $count);
    }
    if(count($stock_count) > 0){
      $error = purchase($acting_user,$stock_count);
      if (!$error) {
	assert_key('amount', $_POST);
	$amount = (double) $_POST['amount'];
	$error = deposit($acting_user, $amount); 	 
      }
    }
    break;
  default:
    echo "Invalid action";
    die;
}

if ($error) {
  redirect("ERROR: Your transaction was canceled. Please try again.");
} else {
  redirect($acting_user->getUsername() . " you have a balance of " . format_currency($acting_user->getBalance()));
}

?>
