<?php
require_once( 'db.php');
require('config.php');
$q = $_GET['q'];
echo json_encode(stock_suggest($q));
?>
