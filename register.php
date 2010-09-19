<?php
require_once( 'db.php');
require('config.php');
if (array_key_exists('message',$_GET)) {
  $message = strip_tags($_GET['message']);
} else {
  $message = '';
}
if(!empty($_GET['submit']) && !empty($_GET['username'])) {
  $_GET['username'] = trim($_GET['username']);
  if (is_numeric($_GET['username'])) {
    $message = 'I need a more sensible name to call you by.';
  } else {
    $user = UserQuery::create()->findOneByUsername($_GET['username']);
    if (is_null($user)) {
      $user = new User();
      $user->setUsername(strip_tags($_GET['username']));
      $user->setEmail(strip_tags(trim($_GET['email'])));
      $user->setRealName(strip_tags(trim($_GET['name'])));
      $user->save();
      redirect("welcome to the party.");
      die;
    } else {
      $message = "I already know someone by that name.";
    }
  }
}
?>
<?php include('templates/header.php'); ?>

<center>
<h1> Do tell me who you are </h1>
<p class="message"> <?= $message ?> </p>
<form method="get">

<script type="text/javascript">
$(document).ready(function() {
  $("input[type=text]#username").focus();
});
</script>

<label for="username">I'm known as </label> <input name="username" id="username" type="text" />, 
<br />
<label for="email">my email address is </label>  <input name="email" type="text" />
<br/>
<label for="name">and my real name is </label>  <input name="name" type="text" />.
<br />
<input value="and that is who I am." class="submit" type="Submit"/>
<input type="hidden" name="submit" value="true" />
</form>
</center>


<?php include( 'templates/footer.php'); ?>