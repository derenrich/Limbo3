<?php

global $path, $domain;
$path = "/limbo3/";
$domain = "http://localhost";

function redirect($message, $page='') {
  global $domain, $path;
  $message = urlencode($message);
  header( "Location: $domain$path$page?message=$message" ) ;
  exit;
}

function quote($str){
  return '"' . $str . '"';
}

function format_currency($val) {
  $val = round($val, 2);
  if ($val < 0) {
    $val = abs($val);
    return sprintf("($%.2f)",$val);
  } else {
    return sprintf("$%.2f",$val);    
  }
}
?>