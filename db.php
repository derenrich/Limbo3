<?php
require_once( 'propel/Propel.php');
//Initialize Propel with the runtime configuration
Propel::init("propel/build/conf/limbo3-conf.php");
set_include_path("propel/build/classes" . PATH_SEPARATOR . get_include_path());

function user_suggest($user){
  $user_list = array();
  if (!empty($user)) {
    $users = UserQuery::create()->where('User.Username like ?', "%".addslashes($user)."%")->find();
  } else {
    $users = UserQuery::create()->find();
  }
  foreach($users as $user){
    $user_list[] = $user->getUsername();
  }
  return $user_list;
}

function stock_suggest($q) {
  $stocks = array();
  if (!empty($q)) {
    $stock = StockQuery::create()->useItemQuery()->where('Item.Name like ?', "%". addslashes($q) ."%")->endUse()->where('not Stock.SoldOut')->orderByCreated()->find();
  } else {
    $stock = StockQuery::create()->where('not Stock.SoldOut')->orderByCreated()->find();
  }
  foreach($stock as $item){
    $entry = array();
    $entry['id'] = ((string) $item->getId());
    $entry['item_id'] = ((string) $item->getItemId());
    $entry['value'] = (string) $item->getItem()->getName();
    $entry['price'] = (string) $item->getPrice();
    $entry['quantity'] = (string) ($item->getQuantity() - $item->getSold());
    $entry['text'] =  $entry['value'] . " at ".format_currency($entry['price'])."";
    $stocks[] = $entry;
  }
  return $stocks;
}

?>
