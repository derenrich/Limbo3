<?php
require_once( 'db.php');
require_once('config.php');
require_once('actions.php');
?>

<?php include( 'templates/header.php'); ?>

<center>
<h2> Wall O' Shame </h2>
<?php

// Get list of all users
$users = UserQuery::create()->orderByBalance()->find();

$debt_sum = 0;

// Make table and column headers
echo "<table>";
echo "<tr><th>Name</th><th>Debt</th></tr>"; 
foreach ($users as $user) {
    // Only bitch at users if they actually owe us money
    if ($user->getBalance() < 0) {
        $debt_sum += $user->getBalance(); ?>
        <tr>
        <td><?= $user->getUsername() ?> </td>
        <td><?= format_currency($user->getBalance()) ?> </td>
        </tr> <?php
    }
}

$debt_sum = format_currency($debt_sum);

echo "<h3>Sum of debt: $debt_sum</h3>";
?>

</center>

<?php include( 'templates/footer.php'); ?>


