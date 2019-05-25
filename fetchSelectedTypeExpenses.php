<?php
	require_once("action/FetchSelectedTypeExpensesAction.php");

	$action = new FetchSelectedTypeExpensesAction();
	$action->execute();

	echo json_encode($action->result);