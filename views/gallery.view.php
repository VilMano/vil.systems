<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once '../model/gallery.class.php';

    $albumsJSON = Gallery::getAllAlbums();
    
    $albums = json_decode($albumsJSON);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="../css/gallery/gallery.css">
        <link id="stylesheet" rel="stylesheet" href="../css/gallery/gallery-dark.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@200&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="../css/navbar/navbar.css">
        <link rel="stylesheet" id="style-nav" href="../css/navbar/navbar-dark.css">
        <script src="/scripts/jQuery.min.js"></script>

    </head>
    
    <body>
        <header>
            <div class="container">
                <div class="header-column">
                    <div class="title">
                        <h1>Gallery</h1>
                    </div>
                </div>
            </div>
        </header>

        <div class="container" id="picture-container">
            <?php 
            foreach($albums->name as $albumname => $pictures){
                print_r($albumname);
                echo '<br />';
                print_r($pictures);
                echo '<br/>';
            }
            ?>
        </div>
        
        <div id="nav-fixed">
            <div class="buttons-style">
                <div class="style-buttons"><img id="moon" src="/media/images/icons/moon_light.png" class="clickable light-switch" width="16">
                </div>
                <div class="style-buttons"><img id="sun" src="/media/images/icons/sun_light.png" class="clickable light-switch" width="16">
                </div>
                <div id="blur"></div>
            </div>
            <div id="blur-nav"></div>
        </div>
        <script src="../scripts/nav-fixed.js"></script>
        <script type="text/javascript">
            var darkmode = false;

            document.getElementById("sun").onclick = function(){
                document.getElementById("stylesheet").href = "../css/gallery/gallery-light.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar.css";
                document.getElementById("moon").src = "/media/images/icons/moon.png";
                document.getElementById("sun").src = "/media/images/icons/sun.png";
            };

            document.getElementById("moon").onclick = function(){
                document.getElementById("stylesheet").href = "../css/gallery/gallery-dark.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar-dark.css";
                document.getElementById("moon").src = "/media/images/icons/moon_light.png";
                document.getElementById("sun").src = "/media/images/icons/sun_light.png";
            };
        </script>
    </body>
</html>