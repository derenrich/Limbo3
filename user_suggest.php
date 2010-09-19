<?php
require_once( 'db.php');
require_once('config.php');

$user = $_GET['q'];
$users = user_suggest($user);
echo join("\n",$users);
?>
