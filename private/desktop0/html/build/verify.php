<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	@session_start();
    if (@$_SESSION['login'] != 1){
        header("Location: ../../");
    }
?>