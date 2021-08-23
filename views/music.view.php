<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once '../model/data.php';
    include_once '../model/music.class.php';

    $db = new Data();
    $conn = $db->getConnection("music");
    $songObj = new Song($conn);
    $songs = $songObj->getAllSongs();
    $albums = $songObj->getAlbums();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/music/music.css">
        <link rel="stylesheet" id="stylesheet" href="../css/music/music-dark.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/navbar/navbar.css">
        <link rel="stylesheet" id="style-nav" href="../css/navbar/navbar-dark.css">
        <script src="/scripts/jQuery.min.js"></script>
    </head>
    <body>
        <header>
        </header>
        <div class="container">
            <div class="container-left" id="infoartist">
                <div class="row">
                    <div class="profile-picture">
                        <img id="pfp" alt="profile_picture" src="../media/images/logo/PFP1.jpg">
                    </div>
                </div>
                <div class="column border-b bg-left" >
                    <p class="bg-left left-p">Guilherme Mano</p>
                    <p class="bg-left left-p">
                        <?php 
                            $countAlbums = count($albums);
                            if(count($albums) > 1){
                                echo $countAlbums . ' albums';
                            }else{
                                echo $countAlbums . ' album';
                            }
                        ?>
                    </p>
                    <p class="bg-left left-p"><?php echo count($songs); ?> songs</p>
                    <p class="bg-left left-p">Instruments: bass, guitar</p>
                    <p class="bg-left left-p">Genre: Post rock/ambient</p>
                </div>
            </div>
            <div class="container-right" id="music">
                
                <?php

                foreach($albums as $album){

                    print('
                    <div class="row">
                        <div class="album-title"><p class="album-p">'. $album["NAME"] .'</p></div>
                    </div>');


                    $i = 1;
                    foreach($songs as $song){
                        $time = strtotime($song["TIME"]);
                        if($i%2 == 0){
                            print('
                            <div class="row lightrow">
                                <span class="songname top-1">'. $song["NAME"] .'</span>
                            </div>
                            <div class="row bottom-1 lightrow">
                                <div class="tracknum"><p class="num">'. $i .'.</p></div>
                                <div class="column song-column">
                                    
                                    <span id="timeleft-'. $song["ID"] .'">'. date('i:s', $time) .'</span>
                                    <span id="status-'. $song["ID"] .'" class="songstatus">Playing</span>
                                </div>
                                <div class="song-row lightrow">
                                    <img id="play-'. $song["ID"] .'" class="actionbtn" src="../media/images/icons/play_black_512.png" width="50">
                                    <div class="range-div">
                                        <input id="slider-'. $song["ID"] .'" class="slider" value="0" type="range" min="0" max="100" oninput="updaterange(this.value);">
                                    </div>
                                </div>
                            </div>
                            ');
                        }else{
                            print('
                            <div class="row darkrow">
                                <span class="songname top-1">'. $song["NAME"] .'</span>
                            </div>
                            <div class="row bottom-1 darkrow">
                                <div class="tracknum"><p class="num">'. $i .'.</p></div>
                                <div class="column song-column">
                                    
                                    <span id="timeleft-'. $song["ID"] .'">'. date('i:s', $time) .'</span>
                                    <span id="status-'. $song["ID"] .'" class="songstatus">Playing</span>
                                </div>
                                <div class="song-row darkrow">
                                    <img id="play-'. $song["ID"] .'" class="actionbtn" src="../media/images/icons/play_black_512.png" width="50">
                                    <div class="range-div">
                                        <input id="slider-'. $song["ID"] .'" class="slider" value="0" type="range" min="0" max="100" oninput="updaterange(this.value);">
                                    </div>
                                </div>
                            </div>
                            ');
                        }
                        $i = $i +1;
                    }
                }
                ?>
            </div>
            
            <audio id="player" controls="controls" ontimeupdate="updatetime(this.currentTime, this.duration);">
                <source id="audiosource" src="" type="audio/mpeg">
            </audio>
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
                document.getElementById("stylesheet").href = "../css/music/music-light.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar.css";
                document.getElementById("moon").src = "/media/images/icons/moon.png";
                document.getElementById("sun").src = "/media/images/icons/sun.png";
            };

            document.getElementById("moon").onclick = function(){
                document.getElementById("stylesheet").href = "../css/music/music-dark.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar-dark.css";
                document.getElementById("moon").src = "/media/images/icons/moon_light.png";
                document.getElementById("sun").src = "/media/images/icons/sun_light.png";
            };
        </script>
        <script>
            var player = document.getElementById("player");
            var audiosource = document.getElementById("audiosource");
            var songid = 0;

            

            function play(location){
                if(location == audiosource.src){
                    player.load();
                    player.play();
                }

                if(location != audiosource.src){
                    audiosource.src = location;
                    player.load();
                    player.play().catch(error => { console.log(error) });;
                }
                document.getElementById("status-"+songid).style.display = "block";
            }

            function updaterange(value){
                player.currentTime = value;
            }

            function updatetime(currentime, duration){
                if(songid != 0){
                    var time = (currentime*100)/duration;
                    document.getElementById("slider-"+songid).value = time;
                    document.getElementById("timeleft-"+songid).innerText = translateToMinutes(currentime);
                }
            }

            function translateToMinutes(time){
                var minutes = parseInt(time/60);
                var seconds = parseInt(time%60);
                return minutes+":"+seconds.toString().padStart(2, '0');
            }

            <?php 
                foreach($songs as $song){
                    print('
                        document.getElementById("play-'. $song["ID"] .'").onclick = function(){
                            songid = '. $song["ID"] .';
                            
                            var btns = Array.prototype.slice.call(document.getElementsByClassName("actionbtn"));
                            btns.forEach(btn => btn.src = "../media/images/icons/play_black_512.png");
                            var status = Array.prototype.slice.call(document.getElementsByClassName("songstatus"));
                            status.forEach(status => status.style.display = "none");
                            var sliders = Array.prototype.slice.call(document.getElementsByClassName("slider"));
                            sliders.forEach(slider => slider.disabled = true);
                            document.getElementById("slider-"+songid).disabled = false;
                            if(player.paused){
                                try{
                                    play("https://vil.systems'.$song["LOCATION"].'");
                                    this.src = "../media/images/icons/pause_black_512.png";
                                }catch(err){
                                    console.log(err);
                                }
                            }else if(!player.paused && "https://vil.systems'. $song["LOCATION"] .'" != audiosource.src){
                                try{
                                    play("https://vil.systems'. $song["LOCATION"] .'");
                                    this.src = "../media/images/icons/pause_black_512.png";
                                }catch(err){
                                    console.log(err);
                                }
                                console.log("'. $song["LOCATION"] .'");
                                console.log(audiosource.src);
                            }else{
                                try{
                                    player.pause();
                                    this.src = "../media/images/icons/play_black_512.png";
                                    document.getElementById("status-"+songid).style.display = "none";
                                }catch(err){
                                    console.log(err);
                                }
                            }
                        };
                    ');
                }
            ?>
        </script>
    </body>
</html>