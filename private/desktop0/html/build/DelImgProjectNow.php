<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$id_project = $_POST['newidimgdel'];
	$src 		= $_POST['MynImgDel'];

	if (is_array($CN->getProjectImg())){
		foreach ($CN->getProjectImg() as $R) {

			if ($R['id_project'] == $id_project && $R['src'] == $src){

				chmod("../../".$R['folder'].$R['src'], 0777);
				unlink("../../".$R['folder'].$R['src']);

				if ($CN->deleteProjectImgBySrc($id_project, $src)){
					echo "OK";
				}
			}
		}
	} else if (is_bool($CN->getProjectImg())){
		echo "Fail";
	}
?>