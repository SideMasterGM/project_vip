<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */

	include ("../../../connect_server/connect_server.php");

    $CN = CDB("vip");

    $id = $_POST['ValueArticleByID'];

    if (is_array($CN->getProjectImgOnlyById($id))){
    	foreach ($CN->getProjectImgOnlyById($id) as $value) {
    		?>
				<div class="container_imgnow">
					<img onclick="javascript: SelectImgArticle(this);" src="<?php echo "private/desktop0/".$value['folder'].$value['src']; ?>" />
				</div>
			<?php
    	}
    }
?>