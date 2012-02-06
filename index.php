<?php
include_once(dirname(__FILE__).'/header.php');

$current_user = User::get();

if (is_null($current_user)) {

	?>
	<p>Hi, please <a href="users/login.php">log in</a> to proceed.</p>

	<p>You'll have to <a href="users/login.php">register</a> first.</p>
	<p>Upon registration, this (test) app will create a few account automatically to show how users can switch between accounts and have different subscriptions on each.<br/>In real world you will not usually add more then one account for the user at the moment of registration, but add them later.</p>
	<?php
} else {
	?>
	<style>
	th {
		text-align: right;
	}
	</style>
	<table>
	<?php
	?><tr><th>You are logged in as:</th><td><?php echo $current_user->getName() ?></td></tr><?php

	$current_account = Account::getCurrentAccount($current_user);
	?><tr><th>Under the account:</th><td><?php echo $current_account->getName() ?></td></tr><?php
	?><tr><th>Account's plan:</th><td><?php echo $current_account->getPlan()->getName() ?></td></tr><?php

	?></table><?php
}

include_once(dirname(__FILE__).'/footer.php');
