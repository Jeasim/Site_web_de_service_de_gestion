<?php
	require_once("action/CheckMatchingPasswordsAction.php");

	$action = new CheckMatchingPasswordsAction();
	$action->execute();

	echo json_encode($action->validity);
