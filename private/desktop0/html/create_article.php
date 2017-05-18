<!-- 
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */
 -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include ("private/desktop0/html/build/head.php"); ?>
    </head>

    <body class="flat-blue" style="background-image: url('source/img/back/bg1.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
        <div class="app-container">
            <div class="row content-container">
                <?php include ("private/desktop0/html/build/tape.php"); ?>
                
                <?php include ("private/desktop0/html/build/menu_left.php"); ?>
                
                <?php include ("private/desktop0/html/build/view_create_article.php"); ?>
            </div>

            <?php include ("private/desktop0/html/build/footer.php"); ?>
        </div>
        <?php include ("private/desktop0/html/build/scripts.php"); ?>
        <script type="text/javascript">
            setTimeout(function(){
                $("navbar-nav .active").removeClass("active");
                $(".option_article__item").addClass("active");
            }, 100);
        </script>
    </body>
</html>
