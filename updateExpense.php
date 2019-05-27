<?php
	require_once("action/UpdateExpenseAction.php");

	$action = new UpdateExpenseAction();
	$action->execute();

	echo json_encode($action->result);