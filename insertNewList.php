<?php
	require_once("action/InsertNewListAction.php");

	$action = new InsertNewListAction();
	$action->execute();

	echo json_encode($action->response);