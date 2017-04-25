<?php
	include ("../../../connect_server/connect_server.php");
	  include ("CalcDate.php");

	  $CN_VIP = CDB("vip");
	  @session_start();

?>

<div class="panel-body">
	<input type="text" class="form-control" id="id_names" placeholder="* Nombres" /><br/>
	<input type="text" class="form-control" id="id_lastnames" placeholder="* Apellidos" />
</div>