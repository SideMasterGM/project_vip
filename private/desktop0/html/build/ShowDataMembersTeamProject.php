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
							        	<?php echo $val['firts_name']." ".$val['last_name']; ?>
								    </a>
								    <i class="fa fa-trash buttons_addPanel" id="idTeamMember_<?php echo $val['id_member']; ?>" onclick="javascript: AreYouSureDeleteMember(this);" aria-hidden="true" title="Eliminar miembro"></i>
							    </span>
							</div>

						    <div id="collapseTeamMembers<?php echo $CountAccordion; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTeamMembers<?php echo $CountAccordion; ?>">
						    	<div class="panel-body">
						      		<?php 
						      			echo $val['date_log']." - ".$val['date_log_unix'];
						      		?>
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