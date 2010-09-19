<?php
require_once( 'db.php');
require('config.php');
$item_query = $_GET['q'];
if (!empty($item_query)) {
  $item_list = ItemQuery::create()->where('Item.Name like ?', "%". addslashes($item_query) ."%")->find();
  foreach($item_list as $item){
    echo $item->getName() . "\n";
  }
}
?>
