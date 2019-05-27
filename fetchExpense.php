<?php
	require_once("action/FetchExpenseAction.php");

	$action = new FetchExpenseAction();
	$action->execute();

	echo json_encode($action->result);