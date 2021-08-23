<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/blog/blog.css">
        <link rel="stylesheet" id="stylesheet" href="../css/blog/blog-dark.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/navbar/navbar.css">
        <link rel="stylesheet" id="style-nav" href="../css/navbar/navbar-dark.css">
        <script src="/scripts/jQuery.min.js"></script>
    </head>
    <body>
    <div class="container">
        <div class="column">
            <h2 class="title">Hello there, welcome to my blog</h2>
            <p>Welcome to my blog. Here I will be displaying coding related articles,</br>
            one of them being the old versions of my website since I am constantly rebuilding it.</br>
            Hope you have fun visiting my little contribution to the internet.</p>
        </div>
    </div>
        <div class="container">
            <div class="container-left">
                <embed id="gallery-html" src="/old/gallery.php" width="400" height="600" />
            </div>
            <div class="container-right">
                <div class="column">
                    <p>
                        The gallery started off as a webpage separated by two sections.</br>
                        This decision was made in order to have the original size of the pictures and </br>
                        making them fit properly in a container.</br>
                        
                    </p>
                    <p>Once mixing portrait and landscape pictures two things can happen:</br>
                        - Vertical pictures are too small in order to have horizontal ones with proper quality</br>
                        - Horizontal pictures are way too big in order to have vertical pictures with proper quality</br></p>

                    <p>In order to fix this issue I could come up with the perfect ratio combining vertical and horizontal pictures.</br>
                    Making them fit together inside a container with the same height that them to make this odd shape on a container</br>
                    that you can visit here:
                    </P>
                    <a id="gallery-link" href="/views/gallery.view.php"><p>Gallery</p></a>
                </div>
            </div>
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
                document.getElementById("stylesheet").href = "../css/blog/blog-light.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar.css";
                document.getElementById("moon").src = "/media/images/icons/moon.png";
                document.getElementById("sun").src = "/media/images/icons/sun.png";
            };

            document.getElementById("moon").onclick = function(){
                document.getElementById("stylesheet").href = "../css/blog/blog-dark.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar-dark.css";
                document.getElementById("moon").src = "/media/images/icons/moon_light.png";
                document.getElementById("sun").src = "/media/images/icons/sun_light.png";
            };
        </script>
    </body>
</html>