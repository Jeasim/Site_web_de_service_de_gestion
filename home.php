<?php
require_once("action/HomeAction.php");
$action = new HomeAction();
$action->execute();
 
require_once("partial/header.php");
?>


<?php
require_once("partial/footer.php");