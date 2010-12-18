<?php
require_once( 'db.php');
require_once('config.php');
require_once('actions.php');

$username = $_GET['acting_user'];
if(!empty($username)) {
  // check if the user is a thing
  $user = parse_user($username);
  if (is_null($user)) {
    redirect("i've never heard of you before",'register.php');
  }
} else {
  redirect();
}
$message = '';
$error = false;
if (array_key_exists('submit', $_POST)) {
  //if($_POST['submit'] == 'clear'){    
  //}
  if($_POST['submit']=='stock'){
  assert_key('quantity', $_POST);
  assert_key('item', $_POST);
  assert_key('price', $_POST);
  $price = (double) $_POST['price'];
  if ($price <= 0 || $price > 100 || is_null($price)){
    $message = 'That was an invalid price';
    $error = true;
  }
  $quantity = (int) $_POST['quantity'];
  if ($quantity <= 0 || $quantity > 400 || is_null($quantity)){
    $message = 'That was an invalid quantity';
    $error = true;
  }
  if (empty($_POST['item'])){
    $message = 'That was an invalid item';
    $error = true;
  }
  if(!$error){
    $item = parse_item($_POST['item']);
    if (is_null($item)) {
      $item = new Item();
      $item->setName(strip_tags($_POST['item']));
      $item->save();
    }
    $stock = new Stock();
    $stock->setItemId($item->getId());
    $stock->setUserId($user->getId());
    $stock->setPrice($price);
    $stock->setQuantity($quantity);
    $stock->save();
  }
  }
}

// This is a hack; we should add a "last_sale" member to the stock
// class so we don't have to loop over all sales to compute this.
if (!empty($user)) {
  $stock = $user->getStocks();
  foreach ($stock as $stock_item)  {
    $last_sale = $stock_item->getCreated();
    $purchases = $stock_item->getPurchases();
    foreach ($purchases as $purchase) {
        $purchase_date = $purchase->getCreated();
        if ($purchase_date > $last_sale) {
            $last_sale = $purchase_date;
        }
    }
    // Convert timestamps from strings so we can compute the difference
    $sales_period = strtotime($last_sale) - strtotime($stock_item->getCreated());
    $sales_array[] = array($stock_item, $sales_period);
  }
}


?>
<?php include( 'templates/header.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
  $("input[type=text]#item").autocomplete("item_suggest.php", {matchCase: false, minChars: 2});
  $("[placeholder]").textPlaceholder()

});
</script>

<center>
<h1> <?= $user->getUsername() ?>'s storefront</h1>
<?php
  $stocks = $user->getStocks();
  if (count($stocks) > 0) {
    echo "<h2> History </h2>\n";
  }
  echo "<table>";
  echo "<tr><th>Name</th><th>Date</th><th>Price</th><th>Sales</th><th>Income</th><th>Clear Stock</th></tr>";
  if (count($sales_array) > 0) {
  foreach($sales_array as $sale) { 
    $stock = $sale[0];
    $time = $sale[1];?>
    <tr>
    <td><?= $stock->getItem()->getName() ?> </td>
    <td><?= $stock->getCreated() ?> </td>
    <td><?= format_currency($stock->getPrice()) ?> </td>
    <td><?= $stock->getSold() ?>/<?=$stock->getQuantity() ?> </td>
    <td><?= format_currency((double)($stock->getPrice() * $stock->getSold())) ?></td>
    <td>
      <?php if(!$stock->getSoldOut()){ ?>
      <center>
      <form method="post">
        <input type="hidden" name="action" value="clear" />
        <input type="hidden" value="true" name="submit" />
        <input type="hidden" value="<?= $stock->getId() ?>"
        <input type="submit" value="X" />
      </form>
      </center>
      <?php } ?>
    </td>
    </tr>
  <?php
  }
  }
  echo "</table>\n";
?>

<h2> Stock </h2>
<?php
  if (!empty($message)) {
    echo "<strong>$message</strong>";
  }
?>
<form method="post">
I'd like to stock 
<input type="number" name="quantity" min="0" max="100" step="1" placeholder="0">
<input id="item" type="text" name="item" placeholder="widget"/>s at a price
$<input type="number" name="price" min="0" max="100" step="0.01">

<input type="hidden" value="<?=$user->getId() ?>" name="acting_user" /> 
<input type="hidden" name="action" value="stock" />
<input type="hidden" value="stock" name="submit" />
<br />
<input value="¡Viva Capitalismo!" class="submit" type="Submit"/>

</form>
</center>
<?php include( 'templates/footer.php'); ?>
