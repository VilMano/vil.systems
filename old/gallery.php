<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('../model/data.php');

    function sanitize_input($par){
        $par = strip_tags($par);        // Remove dangerous tags
        $par = htmlspecialchars($par);  // Escape any remaining special characters
    
        return $par;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/old/gallery/gallery.css">
        <link id="stylesheet" rel="stylesheet" href="../css/old/gallery/gallery_light.css">
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
        <script src="/scripts/jQuery.min.js"></script>

    </head>
    
    <body>
        <header>
            <div class="container">
                <div class="header-column">
                    <div id="switch-div">
                        <img src="/media/images/icons/moon.png" class="clickable" id="moon" width="32">
                        <img src="/media/images/icons/sun.png" class="clickable" id="sun" width="40">
                    </div>
                    <div class="title">
                        <h1>Gallery</h1>
                        <!--<p id="vertical" class="clickable">vertical</p>-->
                        <span id="vertical">Vertical</span> / <span id="horizontal">Horizontal</span>
                        <!--<p id="horizontal" class="clickable" style="display: none;">horizontal</p>-->
                    </div>
                </div>
            </div>
        </header>

        <div class="container" id="picture-container">
            
        </div>
        <script>
            $("#picture-container").load("../old/getImages.php");
        </script>
        <script type="text/javascript">
            var darkmode = false;

            document.getElementById("sun").onclick = function(){
                document.getElementById("stylesheet").href = "../css/old/gallery/gallery_light.css";
                document.getElementById("moon").src = "/media/images/icons/moon.png";
                document.getElementById("sun").src = "/media/images/icons/sun.png";
            };

            document.getElementById("moon").onclick = function(){
                document.getElementById("stylesheet").href = "../css/old/gallery/gallery_dark.css";
                document.getElementById("moon").src = "/media/images/icons/moon_light.png";
                document.getElementById("sun").src = "/media/images/icons/sun_light.png";
            };

            document.getElementById("vertical").onclick = function(){

                document.getElementById("vertical-div").style.display = "block";
                document.getElementById("horizontal-div").style.display = "none";
            }

            document.getElementById("horizontal").onclick = function(){

                document.getElementById("vertical-div").style.display = "none";
                document.getElementById("horizontal-div").style.display = "block";
            }

        </script>
    </body>
</html>