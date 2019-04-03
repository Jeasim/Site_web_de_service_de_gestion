<?php
	require_once("action/CheckEmailUnicityAction.php");

	$action = new CheckEmailUnicityAction();
	$action->execute();

	echo json_encode($action->validity);
