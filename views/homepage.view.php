<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/homepage/homepage.css">
        <link rel="stylesheet" id="stylesheet" href="../css/homepage/homepage-dark.css">
        <link rel="stylesheet" href="../css/navbar/navbar.css">
        <link rel="stylesheet" id="style-nav" href="../css/navbar/navbar-dark.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/scripts/jQuery.min.js"></script>
    </head>
    <body>
        <header>
        </header>
        <div class="container">
            <div class="main">
                <div class="row">
                    <div class="title">
                        <span id="vil-span" class="title clickable">Vil</span><span id="systems-span" class="title clickable">.systems</span>
                    </div>
                </div>
                <div class="row">
                    <div class="nav">
                        <button id="music-btn" class="button clickable">Music</button>
                        <button id="gallery-btn" class="button clickable">Gallery</button>
                        <button id="blog-btn" class="button clickable">Blog</button>
                        <button id="about-btn" class="button clickable">About</button>
                    </div>
                </div>
                <div class="row minecraft-a">
                    <p><a style="text-decoration: underline;" href="/views/minecraft.view.php">Minecraft server</a></p>
                </div>
            </div>
        </div>
        <div class="navbar-single">
            <img id="moon" src="/media/images/icons/moon_light.png" class="clickable light-switch-single" width="16">
            <img id="sun" src="/media/images/icons/sun_light.png" class="clickable light-switch-single" width="16">
            <div id="blur"></div>
        </div>

        <script type="text/javascript">
            var darkmode = false;

            document.getElementById("sun").onclick = function(){
                document.getElementById("stylesheet").href = "../css/homepage/homepage-light.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar.css";
                document.getElementById("moon").src = "/media/images/icons/moon.png";
                document.getElementById("sun").src = "/media/images/icons/sun.png";
            };

            document.getElementById("moon").onclick = function(){
                document.getElementById("stylesheet").href = "../css/homepage/homepage-dark.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar-dark.css";
                document.getElementById("moon").src = "/media/images/icons/moon_light.png";
                document.getElementById("sun").src = "/media/images/icons/sun_light.png";
            };
        </script>
        
        <script>
            document.getElementById("music-btn").onclick = function(){
                location.href = '/views/music.view.php';
            }

            document.getElementById("gallery-btn").onclick = function(){
                location.href = '/views/gallery.view.php';
            }

            document.getElementById("blog-btn").onclick = function(){
                location.href = '/views/blog.view.php';
            }

            document.getElementById("about-btn").onclick = function(){
                location.href = '/views/about.view.php';
            }
        </script>
        
    </body>
</html>
