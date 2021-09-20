<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once '../models/data.class.php';
    include_once '../models/gallery.class.php';
    $album_id = $_GET["id"];
    
    $conn = new Data();
    $gallery = new Gallery($conn->getConnection());
    $album = $gallery->getAlbumById($album_id);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/single.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/scripts/jQuery.min.js"></script>
    </head>
    <body>
    <div id="modal" onclick="hideModal();">
        <div class="background"></div>
        <img id="modal-pic" src="/resources/images/Bemposta_20-10-2012/F1000005.JPG">
    </div>
    <div id="navbar"></div>
    <script src="/scripts/navbar.js"></script>
    <div class="container">
        <div class="row center">
            <h1 id="title"><?php print($album[0]->name); ?></h1>
        </div>
        <div class="column">
            <?php
                $i = 0;
                foreach($album[0]->pictures as $picture){
                    $path = explode("gallery.vil.systems" , $picture["url"]);

                    if($i!=0){
                        if($i%2==0){
                            print("
                                </div>
                                <div class=\"row center\">
                                    <img onclick=\"openImage(this);\" loading=\"lazy\" class=\"picture\" id=\"picture-". $picture["id"] ."\" src=\"". $path[1] ."\" alt=\"\">
                            ");
                        }else{
                            print("
                                <img onclick=\"openImage(this);\" loading=\"lazy\" class=\"picture\" id=\"picture-". $picture["id"] ."\" src=\"". $path[1] ."\" alt=\"\">
                            ");
                        }
                    
                    }else{
                        print("
                            <div class=\"row center\">
                                <img onclick=\"openImage(this);\" loading=\"lazy\" class=\"picture\" id=\"picture-". $picture["id"] ."\" src=\"". $path[1] ."\" alt=\"\">
                        ");
                    }

                    $i = $i + 1;
                }
            ?>

        </div>
        

    </div>
    
    <script>
        function openImage(el){
            if(window.screen.width > 960){
                var modal = document.getElementById("modal");
                var modal_pic = document.getElementById("modal-pic");
                modal_pic.src = el.src;

                modal.setAttribute("style", "display: flex;");
            }
        }

        function hideModal(){
            modal.setAttribute("style", "display: none;");

        }
    </script>
    </body>
</html>
