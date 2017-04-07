<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");
	@session_start();

	$src = trim(urldecode($_POST['MyNameImgDelete']));

	if (is_array($CN->getTmpImgUnique(@$_SESSION['usr'], $src))){
		foreach ($CN->getTmpImgUnique(@$_SESSION['usr'], $src) as $R) {
			chmod("../../".$R['folder'].$R['src'], 0777);
			unlink("../../".$R['folder'].$R['src']);
		}

		if ($CN->deleteTmpImg($src))
			echo "OK";
	} else if (is_bool($CN->getTmpImgUnique(@$_SESSION['usr'], $src))){
		echo "Mandela";
	}
?>