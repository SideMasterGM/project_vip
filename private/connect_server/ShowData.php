if (!$ObjProject){
		echo "No hay datos";
	} else {
		?>
			<table border="1">
				<tr>
					<td><b>ID</b></td>
					<td><b>Nombre</b></td>
					<td><b>Facultad</b></td>
					<td><b>Objetivo General</b></td>
					<td><b>Objetivos Especificos</b></td>
					<td><b>Resultados Esperados</b></td>
					<td><b>Fecha de aprobación</b></td>
					<td><b>Código dictamen económico</b></td>
					<td><b>Nombre instancia de aprobación</b></td>
				</tr>
		<?php

		foreach($ObjProject as $equipo) {
	 		?>
				<tr>
					<td><?php echo $equipo['id_project']; ?></td>
					<td><?php echo $equipo['nombre']; ?></td>
					<td><?php echo $equipo['facultad_cur_escuela']; ?></td>
					<td><?php echo $equipo['objetivo_general']; ?></td>
					<td><?php echo $equipo['objetivo_especifico']; ?></td>
					<td><?php echo $equipo['resultados_esperados']; ?></td>
					<td><?php echo $equipo['fecha_aprobacion']; ?></td>
					<td><?php echo $equipo['cod_dictamen_economico']; ?></td>
					<td><?php echo $equipo['nombre_instancia_aprobacion']; ?></td>
				</tr>
	 		<?php
	 	}

	 	?>
			</table>
	 	<?php
	}
