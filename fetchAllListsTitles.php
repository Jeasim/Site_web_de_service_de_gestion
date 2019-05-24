<?php
	require_once("action/FetchAllListsTitlesAction.php");

	$action = new FetchAllListsTitlesAction();
	$action->execute();

	echo json_encode($action->result);