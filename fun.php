<?php
require_once( 'db.php');
require_once('config.php');
require_once('actions.php');


?>
<?php include( 'templates/header.php'); ?>

<center>
<h2> Purchasing Time Frequencies </h2>
<?php
$purchases = PurchaseQuery::create()->find();
$plot = plot($purchases);
echo $plot;
?>
<h2> Stocking Time Frequencies </h2>
<?php
$purchases = StockQuery::create()->find();
$plot = plot($purchases);
echo $plot;
?>

<h2> Transfering Time Frequencies </h2>
<?php
$purchases = TransferQuery::create()->find();
$plot = plot($purchases);
echo $plot;
?>
</center>

<?php include( 'templates/footer.php'); ?>


