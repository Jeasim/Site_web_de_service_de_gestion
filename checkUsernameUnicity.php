<?php
	require_once("action/CheckUsernameUnicityAction.php");

	$action = new CheckUsernameUnicityAction();
	$action->execute();

	echo json_encode($action->validity);
