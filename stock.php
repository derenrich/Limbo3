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
  echo "<tr><th>Name</th><th>Date</th><th>Price</th><th>Sales</th><th>Income</th></tr>";
  foreach($stocks as $stock) { ?>
    <tr>
    <td><?= $stock->getItem()->getName() ?> </td>
    <td><?= $stock->getCreated() ?> </td>
    <td><?= format_currency($stock->getPrice()) ?> </td>
    <td><?= $stock->getSold() ?>/<?=$stock->getQuantity() ?> </td>
    <td><?= format_currency((double)($stock->getPrice() * $stock->getSold())) ?></td>
    </tr>
  <?php
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
<input type="hidden" value="true" name="submit" />
<br />
<input value="¡Viva Capitalismo!" class="submit" type="Submit"/>

</form>
</center>
<?php include( 'templates/footer.php'); ?>
