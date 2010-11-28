<?php
require_once( 'db.php');
require_once('config.php');
$message = strip_tags($_GET['message']);

?>
<?php include( 'templates/header.php'); ?>
<script type="text/javascript">
$(document).ready(function() {
  // so we clear out the cache of names sometimes
  setTimeout(function(){
    window.location = "<?=$domain.$path?>";
  },50000);
  data = <?= json_encode(user_suggest('')); ?> ;
  $("input[type=text]").autocomplete(data, {selectionLimit:1, matchCase: false, minChars: 1});
  $("input[type=text]").focus();
});
</script>
<center>
<h1> Who are you? </h1>
<h2> <?= $message ?> </h2>
<div id="login-box">
<form action="store.php" method="get">
<input name="username" type="text"  id="username" autofocus/>
<br /><br />
<input value="Go" class="submit" type="Submit"/>
</form>
</div>
<br />
(<a href="register.php">what? you haven't heard of me?</a>)
<?php 
// Get the head of the list of users, ordered by increasing balance
$worst_user = UserQuery::create()->orderByBalance()->findOne();

if ($worst_user->getBalance() < 0) {
	echo "<h2>Fun fact: ",$worst_user->getUsername(),"'s debt is ",$worst_user->getBalance(),"</h2>";
}
?>
(<a href="wall_of_shame.php">why is limbo harassing me?</a>)

</center>
<?php include( 'templates/footer.php'); ?>

