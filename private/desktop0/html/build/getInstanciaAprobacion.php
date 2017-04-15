<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	if (is_array($CN->getProjectInstanciaAprobacion())){
		?> <optgroup label="Instancias de aprobación"> <?php

		foreach ($CN->getProjectInstanciaAprobacion() as $value) {
			?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['nombre_instancia_aprobacion']; ?></option>
			<?php
		}

		?> </optgroup> <?php
	} else if (is_bool($CN->getProjectInstanciaAprobacion())){
		?>
	        <optgroup label="Instancia de aprobación">
	        </optgroup>
	    <?php
	}
?>