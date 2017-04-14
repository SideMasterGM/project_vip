<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("all");

	if (is_array($CN->getProjectFacCurEsc())){
		?> <optgroup label="Lista de centros"> <?php

		foreach ($CN->getProjectFacCurEsc() as $value) {
			?>
				<option value="<?php echo $value['codigo_facultad']; ?>"><?php echo $value['nombrefac']; ?></option>
			<?php
		}

		?> </optgroup> <?php
	} else if (is_bool($CN->getProjectFacCurEsc())){
		?>
	        <optgroup label="Lista de centros">
	        </optgroup>
	    <?php
	}
?>