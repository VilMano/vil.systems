<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../styles/homepage.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/scripts/jQuery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1 class="title">Vil.Systems</h1>
            </div>
            <div class="column center intro">
                <span class="center">Hey Stranger, welcome to my website.</span>
                <span class="center">This is my little corner of the internet where I publish music, photography and I blog a bit.</span>
                <span class="center">Go ahead, take a look around!</span>
                <span class="center">Thank you for visiting 🤍</span>
            </div>

            <div class="row" id="webpages">
                <div id="music">
                    <div class="row">
                        <div class="music-box box">
                            <img src="../resources/icons/music.png" onclick="sendToPage('music')" width="100" height="100" alt="music" class="music-icon" />
                        </div>
                    </div>
                </div>

                <div id="gallery">
                    <div class="row">
                    <div class="gallery-box box">
                            <img src="../resources/icons/image.png" onclick="sendToPage('gallery')" width="100" height="100" alt="music" class="gallery-icon" />
                        </div>
                    </div>
                </div>

                <div id="blog">
                    <div class="row">

                    </div>
                </div>

                <div id="about">
                    <div class="row">

                    </div>
                </div>
            </div>

            <div class="row center">
                <a href="https://minecraft.vil.systems">Minecraft server status</a>
            </div>





            <div id="featured">
                <div class="row">
                    <div class="featured"><span>Latest code for fun:</span></div>
                </div>
                <div class="row featured-box">
                    <embed id="feature-html" src="views/terminal.views.php"/>
                </div>
                <div class="row">
                    <div id="featured-btn" onclick="refreshCode();" class="featured"><span>Click here to re-run the code.</span></div>
                </div>
            </div>
        </div>

        <div id="navbar"></div>
        <script src="/scripts/navbar.js"></script>
        <script src="/scripts/mobile.js"></script>
        <script>
            // re-run code for terminal
            function refreshCode(){
                document.getElementById("feature-html").src = document.getElementById("feature-html").src; 
            }

            function sendToPage(page){
                window.location.replace("https://"+ page +".vil.systems");
            }
        </script>
    </body>

</html>