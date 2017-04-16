<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$id = $_POST['newidimgdel'];

	$src = $_POST['MynImgDel'];

	echo "El ID: ".$id." y el src: ".$src;
	exit();

	$result = $Conexion->query("SELECT * FROM publish_img WHERE src='".$src."';");
	if ($result->num_rows > 0){
		$r = $result->fetch_array(MYSQLI_ASSOC);
		
		chmod("../../".$r['folder'].$src, 0777);
		unlink("../../".$r['folder'].$src);

		if ($Conexion->query("DELETE FROM publish_img WHERE src='".$src."';")){
			echo "OK";
		} else {
			echo "Algo va mal";
		}
	} else {
		echo "No hay datos";
	}
?>

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