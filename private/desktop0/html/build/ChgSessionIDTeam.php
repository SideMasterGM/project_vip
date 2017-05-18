<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	@session_start();

	@$_SESSION['id_team'] = $_POST['IDInputIDTeam'];

	echo "ID: ".$_SESSION['id_team'];
?>