<!DOCTYPE html>
<html>
    <?php 
        @session_start();
        //session_destroy();
        if (!isset($_SESSION['session']) || $_SESSION['session'] == "No"){
            ?>
                <head>
                    <?php include ("source/php/head.php"); ?>
                </head>

                <body style="overflow: hidden;">
                    <?php
                        include ("source/php/content.php");
                        include ("source/php/foot_js.php");
                    ?>
                </body>
            <?php
        } else {
            include ("private/desktop0/html/articles.php");
        }

    ?>
</html>