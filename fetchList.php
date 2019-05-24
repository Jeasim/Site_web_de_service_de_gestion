<?php
	require_once("action/FetchListAction.php");

	$action = new FetchListAction();
	$action->execute();

	echo json_encode($action->result);