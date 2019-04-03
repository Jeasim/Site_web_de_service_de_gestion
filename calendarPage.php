<?php
	require_once("action/CalendarPageAction.php");
	$action = new CalendarPageAction();
	$action->execute();

	require_once("partial/header.php");
?>




<?php
	require_once("partial/footer.php");
