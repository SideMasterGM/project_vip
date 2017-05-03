<?php
	include ("../../../connect_server/connect_server.php");
	include ("CalcDate.php");

	$CN_VIP = CDB("vip");
	@session_start();

	$id_team = $_SESSION['id_team'];

	if (is_array($CN_VIP->getTeamMembersAll($id_team))){

		$CountAccordion = 1;

		foreach ($CN_VIP->getTeamMembersAll($id_team) as $val) {
			if (!empty($val['firts_name']) && !empty($val['last_name'])){
				?>
					<div class="panel-body">
					  	<div class="panel" style="margin-bottom: -20px;">
							<div class="panel-heading" role="tab" id="headingTeamMembers<?php echo $CountAccordion; ?>">
							    <span class="panel-title">
							      	<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTeamMembers<?php echo $CountAccordion; ?>" aria-expanded="false" aria-controls="collapseTeamMembers<?php echo $CountAccordion; ?>"><span class="icon fa fa-user"></span>
							        	<?php echo explode(" ", $val['firts_name'])[0]." ".explode(" ", $val['last_name'])[0]; ?>
								    </a>
								    <i class="fa fa-trash buttons_addPanel" id="idTeamMember_<?php echo $val['id_member']; ?>" onclick="javascript: AreYouSureDeleteMember(this);" aria-hidden="true" title="Eliminar miembro"></i>
							    </span>
							</div>

						    <div id="collapseTeamMembers<?php echo $CountAccordion; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTeamMembers<?php echo $CountAccordion; ?>">
						    	<div class="panel-body">
									
									<div class="row">
										<div class="col-xs-6">
											
											<?php
												if (is_array($CN_VIP->getTeamMemberImgPerfilById($val['id_team'], $val['id_img'], "DESC", 1))){
													foreach ($CN_VIP->getTeamMemberImgPerfilById($val['id_team'], $val['id_img'], "DESC", 1) as $value) {
														?>
															<img src="private/desktop0/<?php echo $value['folder'].$value['src']; ?>" width="100%" alt="Imagen por defecto"/>
														<?php
													}
												} else if (is_bool($CN_VIP->getTeamMemberImgPerfilById($val['id_team'], $val['id_img'], "DESC", 1))){
													?>
														<img src="private/desktop0/img/img-default/team.jpg" width="100%" alt="Imagen por defecto"/>
													<?php
												}
											?>

											<hr>

											<label><i class="fa fa-globe" aria-hidden="true"></i> Tiempo de registro</label>
											<p><?php echo $val['date_log']." | ".nicetime(date("Y-m-d H:i", $val['date_log_unix'])); ?></p>
										</div>

										<div class="col-xs-6">
											<label><i class="fa fa-user" aria-hidden="true"></i> Nombre completo</label>
											<p><?php echo $val['firts_name']." ".$val['last_name']; ?></p>

											<hr>

											<label><i class="fa fa-graduation-cap" aria-hidden="true"></i> Grado académico</label>
											<p><?php echo $val['grado_academico']; ?></p>

											<hr>

											<label><i class="fa fa-legal" aria-hidden="true"></i> Dependencia académica</label>
											<p><?php echo $val['dependencia_academica']; ?></p>

											<hr>

											<label><i class="fa fa-info-circle" aria-hidden="true"></i> Tipo de contratación</label>
											<p><?php echo $val['tipo_contratacion']; ?></p>

											<hr>

											<label><i class="fa fa-clock-o" aria-hidden="true"></i> Horas semanales dedicadas</label>
											<p><?php echo $val['hrs_semanales_dedicacion']." hrs"; ?></p>
										</div>
									</div>

						      	</div>
						    </div>
					  	</div>
					</div>
				<?php
				$CountAccordion -= 100;
			}

			$CountAccordion++;
		}

		if ($CountAccordion > 1){
			echo "<p style='padding: 20px;'>Aún no hay miembros registrados en este equipo, por favor, finalice el registro que tiene en espera.</p>";
		}
	} else if (is_bool($CN_VIP->getTeamMembersAll($id_team))){
		echo "<p style='padding: 20px;'>Aún no hay miembros registrados en este equipo</p>";
	}
?>