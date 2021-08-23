<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('../../model/data.php');

    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    $conn = new Data("music");
    $comments = $conn->getAllComments();
    $pictures = $conn->getAllPfp();
    $songs = $conn->getAllSongs();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/css/contacts.css">
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
    </head>
    <body>
        <div class="warning-browser">
            <p id="recomm-message" class="browser-message web-broken-p-sml">Viewed better on Firefox</p>
        </div>
        <header>
            <div class="container header-container">
                <div class="row center top-9" id="header-row">

                <div class="hr"></div>  
                <div class="relative">
                    <?php
                        $random = rand(1, count($pictures));
                        print("<img class='pfp' width='200' heigh='200' src='". $pictures[$random-1]["PICTURE_PATH"] ."' alt='pfp'>");
                    ?>
                    
                    <div class="block"></div>
                </div>
                </div>
            </div>
        <header>

        <div class="container" style="margin-top: 0;">
        <div class="row center-div">
            <div class="dark-row">
                    <p class="web-broken-p">Oh great, you made it to my website!</p>
</div>
                    <div class="light-row">
                        <b><p class="web-broken-p font-sml top-sml bottom-sml">Here's how my friends would describe me:</p></b>
                        <?php 
                            foreach($comments as $comment){
                                $name = $comment["NAME"];
                                $flag = "";
                                if($comment["COMMENT_EN"] == ""){
                                    $flag = "
                                    <div class=\"bottom-margin\">
                                        <a id=\"pt-flag-".$comment["ID"]."\" class=\"pt-flag\">
                                            <img width=\"16\" src=\"/media/images/icons/portgual_flag/portugal_16.png\">
                                        </a>
                                    </div>";
                                }else if($comment["COMMENT_PT"] == ""){
                                    $flag = "
                                    <div class=\"bottom-margin\">
                                        <a id=\"uk-flag-".$comment["ID"]."\" class=\"uk-flag\">
                                            <img width=\"16\" src=\"/media/images/icons/uk_flag/uk_16.png\">
                                        </a>
                                    </div>";
                                }else{
                                    $flag = "
                                    <div class=\"bottom-margin\">
                                        <a id=\"pt-flag-".$comment["ID"]."\" class=\"pt-flag\">
                                            <img width=\"16\" src=\"/media/images/icons/portgual_flag/portugal_16.png\">
                                        </a>


                                        <a id=\"uk-flag-".$comment["ID"]."\" class=\"uk-flag\">
                                            <img width=\"16\" src=\"/media/images/icons/uk_flag/uk_16.png\">
                                        </a>
                                    </div>";

                                }

                                
                                    print("<p id=\"comment-EN-".$comment["ID"]."\" class='web-broken-p-sml top-margin'>
                                    ". $comment["COMMENT_EN"] ." - "." $name "."
                                    </p>
                                    <p id=\"comment-PT-".$comment["ID"]."\" style=\"display: none;\" class='web-broken-p-sml top-margin'>
                                    ". $comment["COMMENT_PT"] ." - "." $name "."
                                    </p>
                                    ". $flag ."
                                ");




                                
                                
                            }
                        ?>
                    </div>
                    <div class="dark-row">
                        <details class="commentaries-details">
                            <summary><span class="font-IMB">Comments:</span></summary>
                                
                            <div class="comments center">
                                
                                <form class="form" action="success_comment.php" method="POST">
                                    <div class="column">
                                        <textarea required="required" class="comment_input" id="comment_input" name="comment" rows="5" placeholder="Type your comment here"></textarea>
                                        <input required="required" name="name" type="text" placeholder="Type your display name here" class="name-input" id="name_input">
                                    </div>
                                    <input id="btn_Upload" class="btn_Upload" value="Upload" type="submit"></input>
                                </form>
                            </div>
                        </details>
                    </div>

                    <div class="light-row">
                        <u><p class="web-broken-p font-sml top-sml">My music:</p></u>
                        <?php
                            foreach($songs as $song){
                                $id = $song["ID"];
                                $name = $song["NAME"];
                                if(intval($id) == count($songs)){
                                    print("<p id=\"bottom-song\" class='web-broken-p-sml top-margin-1'><a class=\"no-dec\" href=\"/views/index.php?id=". $id ."#slider-top-". $id ."\">". $name ."</a></p>");
                                }else{
                                    print("<p class='web-broken-p-sml top-margin-1'><a class=\"no-dec\" href=\"/views/index.php?id=". $id ."#slider-top-". $id ."\">". $name ."</a></p>");
                                }
                            }
                        ?>
                        </div>

                        <div class="row center dark-row w-100">
                            <p  class="web-broken-p-sml margin-right-sml">Guilherme Mano</p>
                            <p class="web-broken-p-sml margin-right-sml"> |</p>
                            <p  class="web-broken-p-sml margin-right-sml"><a id="contact-email" href="mailto:mano.gsat@hotmail.com">mano.gsat@hotmail.com</a></p>
                            <p class="web-broken-p-sml margin-right-sml">|</p>
                            <div class="li-info-profile">
                                <img width="16" src="/media/images/icons/lgbt_flag/lgbt_flag.png">
                                <img width="16" src="/media/images/icons/portgual_flag/portugal_16.png">
                            </div>   
                        </div>
                    <div class="row center">
                        <div class="hr-bottom"></div>  
                    </div>

                    
                </div>
        </div>
        <script type="text/javascript">
            var isFirefox = typeof InstallTrigger !== 'undefined';

            document.getElementById("btn_Upload").onclick = function () {
                location.href = "/success_comment.php";
            };
            
            if(isFirefox){ document.getElementById("recomm-message").setAttribute("style", "display: none;"); }
            else{ document.getElementById("recomm-message").setAttribute("style", "display: block;"); }

            function translate(id, lang){
                console.log(lang + " " + id);
                var comment = document.getElementById("comment-"+ lang +"-"+ id);
                comment.setAttribute("style","display: block;");
                lang = lang == "PT" ? "EN" : "PT";
                console.log(lang + " " + id);
                comment = document.getElementById("comment-"+ lang  +"-"+ id);
                comment.setAttribute("style","display: none;");
            }
            <?php
            foreach($comments as $comment){
            print("
                document.getElementById(\"pt-flag-". $comment["ID"] ."\").addEventListener('click', function(){
                    translate(". $comment["ID"] .", \"PT\");
                });

                document.getElementById(\"uk-flag-". $comment["ID"] ."\").addEventListener('click', function(){
                    translate(". $comment["ID"] .", \"EN\");
                });");
            } 
        ?>
        </script>
    </body>
</html>
