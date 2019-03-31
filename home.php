<?php
require_once("action/HomeAction.php");
$action = new HomeAction();
$action->execute();
 
require_once("partial/header.php");
?>

<div> Hello, <?=  $_SESSION["name"] ?>!</div>

<?php
require_once("partial/footer.php");