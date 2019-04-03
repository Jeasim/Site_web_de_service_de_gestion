<?php
	require_once("action/BudgetPageAction.php");
	$action = new BudgetPageAction();
	$action->execute();

	require_once("partial/header.php");
?>




<?php
	require_once("partial/footer.php");
