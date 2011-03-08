<?php

require_once( 'db.php');
require_once('config.php');


$seller_id = $_GET['seller'];
$buyer_id = $_GET['buyer'];
$transfer_id = $_GET['transfer'];
$deposit_id = $_GET['depositer'];

if(empty($seller_id) && empty($buyer_id) && empty($transfer_id) && empty($deposit_id)) {
  die;
}

$sales_array = array();

if (!empty($seller_id)) {
  $stock = StockQuery::create()->findByUserId($seller_id);
  foreach ($stock as $stock_item)  {
    $purchases = $stock_item->getPurchases();
    $sales_array[] = array($stock_item, $purchases);
  }
}

$buys_array = array();
if (!empty($buyer_id)) {
  $buys_array = PurchaseQuery::create()->findByUserId($buyer_id);
}

$transfers_array = array();
if (!empty($transfer_id)) {
  $from_array = TransferQuery::create()->findByFromUser($transfer_id);
  $to_array = TransferQuery::create()->findByToUser($transfer_id);
  $transfers_array = array($from_array,$to_array);
}

$deposits_array = array();
if (!empty($deposit_id)) {
  $deposits_array = DepositQuery::create()->findByUserId($deposit_id);
}

?>

<?php include( 'templates/header.php'); ?>
<center>

<?php 
if(!empty($sales_array)) {
  echo "<h2> Sales </h2>";
  foreach ($sales_array as $sale) {
  $sales_item = $sale[0];
  $sales_actions = $sale[1];
?>
  <h3> <?= $sales_item->getItem()->getName() ?> sales </h3>
  <table>
  <tr>
  <th> Date </th>
  <th> Buyer </th>
  <th> Quantity </th>
  </tr>
<?php
  foreach($sales_actions as $action) {
    echo "<tr>";
    echo "<td>" . $action->getCreated() . "</td>";
    echo "<td>" . $action->getUser()->getUsername() . "</td>";
    echo "<td>" . $action->getQuantity() . "</td>";
    echo "</tr>";
  }
?>
  </table>
<?php

?>

<?php
  }
} 
if(!empty($buys_array)) {
  echo "<h2> Buyz </h2>";
?>
  <table>
  <tr>
  <th> Item </th>
  <th> Date </th>
  <th> User </th>
  <th> Quantity </th>
  </tr>
<?
  foreach($buys_array as $action) {
    echo "<tr>";
    echo "<td>" . $action->getStock()->getItem()->getName() . "</td>";
    echo "<td>" . $action->getCreated() . "</td>";
    echo "<td>" . $action->getUser()->getUsername() . "</td>";
    echo "<td>" . $action->getQuantity() . "</td>";
    echo "</tr>";
  }  
?>
</table>
<?php
}
if(!empty($transfers_array)) {
  echo "<h2> Tranzferzzz </h2>";
?>
  <table>
  <tr>
  <th> From </th>
  <th> To </th>
  <th> Amount </th>
  <th> Date </th>
  <th> Reason </th>
  </tr>
<?php
  for($i =0; $i < 2; $i++){
   $from = $transfers_array[$i];
   foreach($from as $transfer) {
     echo "<tr>";
     echo "<td>" . $transfer->getUserFrom()->getUsername() . "</td>";
     echo "<td>" . $transfer->getUserTo()->getUsername() . "</td>";
     echo "<td>" . format_currency($transfer->getAmount()) . "</td>";
     echo "<td>" . $transfer->getCreated() . "</td>";
     echo "<td>" . $transfer->getReason() . "</td>";
     echo "</tr>";
   }  
  }
  echo "</table>";
}
?>

<?php

if(!empty($deposits_array)) {
?>
  <h2> Deposits </h2>
  <table>
  <tr>
  <th> Amount </th>
  <th> Date </th>
  </tr>
<?php
  foreach($deposits_array as $deposit) {
    echo "<tr>";
    echo "<td>" . format_currency($deposit->getAmount()) . "</td>";
    echo "<td>" . $deposit->getCreated() . "</td>";
    echo "</tr>";
  }
  echo "</table>";

}


?>

</center>
</body>
</html>


