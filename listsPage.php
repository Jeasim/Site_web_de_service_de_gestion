<?php
	require_once("action/ListsPageAction.php");
	$action = new ListsPageAction();
	$action->execute();

	require_once("partial/header.php");
?>




<?php
	require_once("partial/footer.php");