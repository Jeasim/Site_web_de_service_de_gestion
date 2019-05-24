<?php
	require_once("action/InsertExpenseAction.php");

	$action = new InsertExpenseAction();
	$action->execute();

	echo json_encode($action->response);