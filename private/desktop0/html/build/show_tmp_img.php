<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	include ("../../../connect_server/connect_server.php");
	
	$CN = CDB("vip");
	@session_start();

	if (is_array($CN->getTmpImg(@$_SESSION['usr']))){
		foreach ($CN->getTmpImg(@$_SESSION['usr']) as $value) {
			?>
				<div class="container_imgnow">
					<img onclick="javascript: OptionsImageSelected(this);" src="<?php echo "private/desktop0/".$value['folder'].$value['src']; ?>" />
				</div>
			<?php
		}
	}
?>