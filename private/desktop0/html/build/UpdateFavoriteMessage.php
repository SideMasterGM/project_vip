<?php
	include ("../../../connect_server/connect_server.php");
    include ("CalcDate.php");

    $CN = CDB("vip");
    @session_start();

	$Id = $_POST['ChangeIconFavId'];

	$Fav = $CN->getActivityFavorite($Id);
	
	if ($Fav == "0" || $Fav == ""){
		if ($CN->updateActivityFavorite(@$_SESSION['usr'], $Id, 1)){
			echo "<i class='fa fa-star fa-lg' onclick='javascript: UpdateFavoriteMessage();' title='Agregado como favorito' aria-hidden='true' style='float: left; cursor: pointer;'></i>";
		} else {
			echo "Fail";
		}
	} else if ($Fav == "1"){
		
		if ($CN->updateActivityFavorite(@$_SESSION['usr'], $Id, 0)){
			echo "<i class='fa fa-star-half-o fa-lg' onclick='javascript: UpdateFavoriteMessage();' title='Agregar a favoritos' aria-hidden='true' style='float: left; cursor: pointer;'></i>";
		} else {
			echo "Fail";
		}
	}
?>