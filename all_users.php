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
$squared_sum = 0;

// Make table and column headers
echo "<table>";
echo "<tr><th>Name</th><th>Debt</th></tr>"; 
foreach ($users as $user) {
    $debt_sum += $user->getBalance();
    $squared_sum += pow($user->getBalance(),2); ?>
    <tr>
    <td><?= $user->getUsername() ?> </td>
    <td><?= format_currency($user->getBalance()) ?> </td>
    </tr> <?php
}

$squared_sum /= count($users);
$squared_sum -= pow($debt_sum/count($users),2);
$squared_sum = sqrt($squared_sum);
$mean_debt = format_currency($debt_sum/count($users));
$debt_sum = format_currency($debt_sum);
$squared_sum = format_currency($squared_sum);

echo "<h3>Sum of debt: $debt_sum</h3>";
echo "<h3>Mean debt: $mean_debt</h3>";
echo "<h3>Standard Deviation: $squared_sum</h3>";
?>

</center>

<?php include( 'templates/footer.php'); ?>


