<?php
	require_once("action/CheckListTitleUnicityAction.php");

	$action = new CheckListTitleUnicityAction();
	$action->execute();

	echo json_encode($action->validity);
