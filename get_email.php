<?php

$username = $_GET['username'];
$message = $_GET['message'];

require_once( 'db.php');
require_once('config.php');

if(!empty($username)) {
  // check if the user is a thing
  $user = UserQuery::create()->findOneByUsername($username);
  if (is_null($user)) {
    redirect("i've never heard of you before",'register.php');
  } elseif ($user->getEmail() != "") {
    redirect("we have your email already",'index.php');
  }
} else {
  redirect();
}

if(!empty($_POST['submit']) && !empty($_POST['email'])) {
    // FIXME: We should transactionify account creation
    $user->setEmail(strip_tags(trim($_POST['email'])));
    $user->save();
    redirect("Thank you for setting your email.", 'index.php');
    die;
}
?>
<?php include('templates/header.php'); ?>

<center>
<h1> We need your email address </h1>
<h2> We will notify you when a transfer to/from your account takes place </h2>
<form method="post">

<label for="email">my email address is </label>  <input name="email" type="text" />
<br />
<input value="and that is who I am." class="submit" type="Submit"/>
<input type="hidden" name="submit" value="true" />
</form>
</center>


<?php include( 'templates/footer.php'); ?>

