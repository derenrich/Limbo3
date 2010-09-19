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
    $error= transfer($acting_user, $to, $direction * ((double) $_POST['amount']));
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
    
    break;
  default:
    echo "Invalid action";
    die;
}

if ($error) {
  
} else {
  redirect();
}

?>