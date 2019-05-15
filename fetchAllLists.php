<?php
	require_once("action/FetchAllListsAction.php");

	$action = new FetchAllListsAction();
	$action->execute();

	echo json_encode($action->result);