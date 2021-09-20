<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../styles/featured/terminal.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/scripts/jQuery.min.js"></script>
    </head>
    <body>
        <div class="container terminal-container">
            <div class="row">
                <div class="column">
                    <div class="welcome-div" id="welcome">
                        <p>Welcome to Vil.Systems v.3.0</p>
                        <span> * Documentation: <a href="https://github.com/VilMano/vil.systems">https://github.com/VilMano/vil.systems</a></span>
                        <span> * Support: admin@vil.systems</span>
                        <p>This message is shown once a day. To disable it please create the /vil.systems/.hushlogin file.</p>
                    </div>
                    <div class="location-div" id="location">
                        <span class="green">user@vil.systems</span><span>:</span><span class="blue">~/homepage</span><span>$</span><div id="webpages" class="typewriter">ls -la webpages</div>
                    </div>
                    <div id="pages">
                        <span id="homepage">-rw-r--r-- 1 vil  vil     0 Sep  8 22:35 homepage</span>
                        <span id="music">-rw-r--r-- 1 vil  vil     0 Sep  8 22:35 music</span>
                        <span id="gallery">-rw-r--r-- 1 vil  vil     0 Sep  8 22:35 gallery</span>
                        <span id="blog">-rw-r--r-- 1 vil  vil     0 Sep  8 22:35 blog</span>
                        <span id="about">-rw-r--r-- 1 vil  vil     0 Sep  8 22:35 about</span>
                    </div>
                    <div id="destination">
                        
                    </div>
                </div>

            </div>
        </div>
        <script>
            $(document).ready(function(){
                setTimeout(() => {
                    document.getElementById("pages").style.visibility = "visible";
                }, 1000);

                $("#homepage").click(function(){
                    setLocation("homepage");
                });

                $("#music").click(function(){
                    setLocation("music");
                });

                $("#gallery").click(function(){
                    setLocation("gallery");
                });

                $("#blog").click(function(){
                    setLocation("blog");
                });

                $("#about").click(function(){
                    setLocation("about");
                });

                function setLocation(location){
                    var destinationHtml = "<span class=\"green\">user@vil.systems</span><span>:</span><span class=\"blue\">~/homepage</span><span>$ cd "+location+"</span>"
                    $("#destination").html(destinationHtml);

                    setTimeout(() => {
                        window.location.replace("https://vil.systems/views/"+ location +".view.php");
                    }, 500);
                }
            });
        </script>
    </body>

</html>