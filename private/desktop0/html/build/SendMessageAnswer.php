<?php
	include ("../../../connect_server/connect_server.php");

    $CN = CDB("vip");
	@session_start();

	$username 		= @$_SESSION['usr'];
	$id_msg 		= $_POST['id_sms'];
	$answer_message = $_POST['answer_message'];


	if ($CN->addActivityMessage($username, $id_msg, $answer_message))
		echo "OK";
	else
		echo "Fail";
?>