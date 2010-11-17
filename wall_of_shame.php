<?php
require_once( 'db.php');
require_once('config.php');
require_once('actions.php');
?>

<?php include( 'templates/header.php'); ?>

<center>
<h2> Wall O' Shame </h2>
<?php

// Comparison function for uasort()
function cmp($a, $b) {
    if (($a->getBalance()) > ($b->getBalance())) {
        return 1;
    } else {
        return -1;
    }
}

// Get list of all users
$users = UserQuery::create()->find();
$user_list = array();
foreach ($users as $user) {
    // Add them to an array because PHP was complaining
    $user_list[] = $user;
}

// Sort $user_list
uasort($user_list, 'cmp');

// Make table and column headers
echo "<table>";
echo "<tr><th>Name</th><th>Debt</th></tr>"; 
foreach ($user_list as $user) {
    // Only bitch at users if they actually owe us money
    if ($user->getBalance() < 0) { ?>
        <tr>
        <td><?= $user->getUsername() ?> </td>
        <td><?= $user->getBalance() ?> </td>
        </tr> <?php
    }
}
?>

</center>

<?php include( 'templates/footer.php'); ?>


