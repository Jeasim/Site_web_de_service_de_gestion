<?php
	require_once("action/DeleteExpenseAction.php");

	$action = new DeleteExpenseAction();
	$action->execute();

	echo json_encode($action->result);