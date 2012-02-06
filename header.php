<?php
include_once(dirname(__FILE__).'/config.php');
include_once(dirname(__FILE__).'/users/users.php');

$current_user = User::get();
?><html>
<head><title>Sample Subscriptions App</title></head>
<body>
<div style="float: right"><?php include_once(dirname(__FILE__).'/users/navbox.php'); ?></div>

<h1><a href="<?php echo UserConfig::$SITEROOTURL ?>">Sample Subscriptions App</a></h1>

