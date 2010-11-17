<?php

global $path, $domain;
$path = "/limbo3/";
$domain = "http://blacker.caltech.edu";

function redirect($message='', $page='') {
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
    $format_val =  sprintf("($%.2f)",$val);
    $format_val = "<span class='negative'>". $format_val . "</span>";
  } else {
    $format_val = sprintf("$%.2f",$val);    
    $format_val = "<span class='positive'>". $format_val . "</span>";
  }
  return $format_val;
}


function plot($points) {
  $hist = array(0=>0, 1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0, 17=>0, 18=>0, 19=>0, 20=>0, 21=>0, 22=>0, 23=>0);
  foreach($points as $p) {
    $time = new DateTime($p->getCreated(), new DateTimeZone('UTC')); 
    $time->setTimezone(new DateTimeZone('America/Los_Angeles'));
    $hour = (int) $time->format("H");
    $hist[$hour] += 1;
  }
  $max_count =  max($hist);
  $max_count = max($max_count, 1);
  $data = '';
  $x = '';
  for($i=0; $i<24; $i++) {
    $x .= (((float) $i) / 24.0 * 100) .",";
    $data .= ((100* (((float) $hist[$i]) /$max_count))) .",";
  }
  $data = rtrim($data,",");
  $x = rtrim($x,",");
  return "<img src='http://chart.apis.google.com/chart?chs=500x200&chf=bg,s,00000000&cht=lxy&chd=t:$x|$data&chxt=x,y&chxr=0,0,23,2'/>";
}

?>
