<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("all");

	if (is_array($CN->getProjectComunidadPoblacion())){
		?> <optgroup label="Lista de comunidades"> <?php

		foreach ($CN->getProjectComunidadPoblacion() as $value) {
			?>
				<option value="<?php echo $value['cod_muni']; ?>"><?php echo $value['nombre_muni']; ?></option>
			<?php
		}

		?> </optgroup> <?php
	} else if (is_bool($CN->getProjectComunidadPoblacion())){
		?>
	        <optgroup label="Lista de comunidades">
	        </optgroup>
	    <?php
	}
?>