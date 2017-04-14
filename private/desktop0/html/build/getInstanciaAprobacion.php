<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	if (is_array($CNEx->getProjectInstanciaAprobacion())){
		?> <optgroup label="Instancias de aprobación"> <?php

		foreach ($CNEx->getProjectInstanciaAprobacion() as $value) {
			?>
				<option value="<?php echo $R['nombre_instancia_aprobacion']; ?>"><?php echo $R['nombre_instancia_aprobacion']; ?></option>
			<?php
		}

		?> </optgroup> <?php
	} else if (is_bool($CNEx->getProjectInstanciaAprobacion())){
		?>
	        <optgroup label="Instancia de aprobación">
	        </optgroup>
	    <?php
	}
?>