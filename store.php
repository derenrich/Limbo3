<?php

$username = $_GET['username'];
require_once( 'db.php');
require('config.php');

if(!empty($username)) {
  // check if the user is a thing
  $user = UserQuery::create()->findOneByUsername($username);
  if (is_null($user)) {
    redirect("i've never heard of you before",'register.php');
  } elseif($user->getEmail() == "") {
    redirect_no_message('get_email.php?username=' . $username);
  }
} else {
  redirect();
}

if($user->getEmail() == "") {
  redirect("",'get_email.php?username=' . $username);
}

?>
<?php include( 'templates/header.php'); ?>
<script type="text/javascript" src="public/javascript/auction.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("[placeholder]").textPlaceholder()
  $("input[type=text].username").autocomplete("user_suggest.php", {selectionLimit:1, matchCase: false, minChars: 2});
  setTimeout(function(){
    window.location = "<?=$domain.$path?>";
  },120000);
  $("input[type=text]#item-search").focus();
  $("input[type=text]#item-search").keypress(handleType);
  // this way we prefill the data
  populate(screen(<?= json_encode(stock_suggest('')); ?>));
});

function PriceWarning(){
  var total_text = $('span#total').html();
  // we should've done this with ints...
  if(parseFloat(total_text) == 0) {
    alert("Dude, you didn't buy anything.");
    return false;
  } else {
    return true;
  }
}
</script>
<center>
<?php
if($user->getBalance()<0) {
  echo "<h1>You are in debt! Pay off your  ".format_currency($user->getBalance())."</h1>";
}

?>
<table id="purchase-controls">
<tr>
<td>
<h2> Shelves </h2>
<label for="item-search">I'd like me some </label> <input type="text" id="item-search" value="" autocomplete="off" autofocus tabindex="1" onkeypress=”return event.keyCode!=13″
/>
<form method="post" action="api.php" onSubmit="$('select#cart option').attr('selected','selected');return PriceWarning();">
<input type="hidden" name="action" value="purchase" />
<input type="hidden" value="<?=$user->getId() ?>" name="acting_user" /> 
</td>
<td>
<h2> Cart </h2>
At a cost of $<span id="total">0.00</span>.
<br />
</td>
<tr>
<td>
<select class="store"id="storefront" size="10">
</select>
</td>
<td>
<select class="store"  name="cart[]" id="cart" size="10" multiple="multiple">
</select>
<br />
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center">
I'll pay you  $<input type="number" name="amount"  placeholder="0.00" tabindex="2"/>. 
<br /><br />
<input value="Put it on my tab." class="submit" type="Submit" tabindex="3"/>
</td>
</tr>
</form>
<tr>
<td colspan="2">
<h2> Transfer </h2>
<form method="post" action="api.php">
I want to transfer $<input type="number" name="amount" tabindex="4"/> <select  name="direction" tabindex="5"><option>to </option><option >from</option></select>  <input tabindex="6" type="text" class="username" name="target_user" />
because <input type="text" tabindex="7" name="reason" placeholder="he is such a cool dude"/>.
<input type="hidden" name="action" value="transfer" />
<br /> <br />
<input value="Make it so." class="submit" type="Submit" tabindex="7" />

<input type="hidden" value="<?=$user->getId() ?>" name="acting_user" /> 
</td>
</form>
</tr>
<tr>
<td>
<h2> Deposit </h2>
<form method="post" action="api.php">
I want to deposit $<input type="number" name="amount" />.
<br /> <br />
<input type="hidden" value="deposit" name="action" />
<input value="Take it to the bank." class="submit" type="Submit"/>
<input type="hidden" value="<?=$user->getId() ?>" name="acting_user" /> 
</form>
</td>
<td>
<h2> Withdraw </h2>
<form method="post" action="api.php">
I want to withdraw $<input type="number" name="amount" />.
<input type="hidden" value="withdraw" name="action" />
<br /> <br />
<input value="I have a good reason to do this." class="submit" type="Submit"/>
<input type="hidden" value="<?=$user->getId() ?>" name="acting_user" /> 
</form>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: center"> 
<h2>Administrative details</h2>
<table id="admin">
<tr>
<td>Your balance is</td> <td> <?= format_currency($user->getBalance()) ?> </td>
</tr>
<tr>
<td>Your e-mail address is</td><td><?= strip_tags($user->getEmail()) ?>
</tr>
<tr>
<td colspan="2">
<a href="log.php?seller=<?=$user->getId()?>">Check up on your sales. </a>
</td>
</tr>
<tr>
<td colspan="2">
<a href="log.php?buyer=<?=$user->getId()?>">Audit your purchases.</a>
</td>
</tr>
<tr>
<td colspan="2">
<a href="log.php?transfer=<?=$user->getId()?>">Monitor your transfers.</a>
</td>
</tr>
<tr>
<td>
<a href="log.php?depositer=<?=$user->getId()?>">See your deposits.</a>
</td>
</tr>
<tr>
<td colspan="2">
<a href="stock.php?acting_user=<?=$user->getId()?>">Manage stock.</a>
</td>
</tr>
<tr>
<td colspan="2">
<a href="option.php?acting_user=<?=$user->getId()?>">Manage options.</a>
</td>
</tr>

</table>
</td>
</tr>
</table>
</center>
<?php include( 'templates/footer.php'); ?>
