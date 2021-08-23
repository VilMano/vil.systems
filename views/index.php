<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('/var/www/websites/model/data.php');
    
    $conn = new Data("music");
    $songs = $conn->getAllSongs();
    $countSongs = $conn->getCountAllSongs();

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
        <link rel="stylesheet" href="../css/homepage.css">
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
    <header>
        <p hidden="hidden" id="song_id">1</p>
        <p hidden="hidden" id="isPlaying">1</p>
        <p hidden="hidden" id="isExpanded">0</p>
    </header>
        <div class="playlist-box">
            <ul class="songs-playlist">
                <?php
                    for($i = 0; $i < count($songs); $i++){
                        $namesArr = explode(" ", $songs[$i][6], 10);
                        $initials = "";
                            $initial = substr($namesArr[0],0, 1);
                            $initials = $initials . strval($initial);
                            $horizRow = "<hr style='background-color: #121212;'>";
                            if($i == count($songs)-1){ $horizRow = "";}
                        print('
                        <div id="song-'.$songs[$i]['ID'] .'">
                         <li id="play-num-'.$i.'" onclick="setPlayerSong(\''. $songs[$i]['LOCATION'].'\', '. $songs[$i]['ID'] .', \'' . $songs[$i]['NAME'] .'\', \'' . $songs[$i]['DESCRIPTION'].'\');">
                                    '. $initials .'
                                </li>
                                '.$horizRow.'
                        </div>
                               
                        ');
                    }
                ?>
            </ul>
        </div>

        
        <div class="container">
            <div class="album-image-div">
                <!-- Mobile button -->
                <img src="/media/images/icons/play_white_512.png" style="margin-left: 6%;" onclick="changePlayBtn();" id="playing-cover" alt="play">
                <!-- Album image -->
                <img class="album-image" src="https://i1.sndcdn.com/avatars-s1cYG8goC68zX45y-LuenYQ-t200x200.jpg" alt="album-picture">
                <!-- Desktop button -->
                <img class="play-button-player" id="play-button-player" src="/media/images/icons/play_white_64.png" alt="btn_play">
                
                <div class="slider-desktop">
                    <div style="position: absolute; bottom: 0; width: 100%;">
                        <div id="details-song">
                            <p id="song-name-desktop" class="h2"><?php print($songs[0]['NAME']) ?></summary>
                            <p class="web-broken-p" id="song-description" onclick=""><?php print($songs[0]['DESCRIPTION']) ?></p>
                        </div>
                        <div class="desktop-player-controls">
                            <img id="play-btn-desktop" src="/media/images/icons/play_white_64.png" onclick="changePlayBtn()" alt="btn_play_desktop">
                            <!-- Volume slider -->
                            <div class="volume" id="volume">
                                <input type="range" min="0" max="100" id="volume-slider" class="volume-slider" value="50">
                            </div>

                            <!-- max set to 99 so the currentTime doesn't go back to 0 -->
                            <input type="range" min="0" max="99" id="slider-desktop-song" class="slider-desktop-song" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $inc = 1; 
            foreach($songs as $song){ 
                if($inc%2!=0){
                    print("<div class=\"row_desktop\">");
                }

                $timeSong = strtotime($song['TIME']);
                $song_date = date('d-m-Y', strtotime($song['CREATED_DATE']));
                
                print('      
                    <div class="song">
                        <div class="image-player" id="mouseover-player1">
                            <img onclick="setPlayerSong(\''. $song['LOCATION'].'\', '. $song['ID'] .', \'' . $song['NAME'] .'\', \'' . $song['DESCRIPTION'].'\'); " id="play-'. $song['ID'] .'" class="song-picture" src="'. $song['IMAGE_LOCATION'] .'" alt="song-image">
                        </div>
                        <div class="info-song" id="slider-top-'. $song['ID'] .'">
                            <div class="info">
                                <span id="song-upload-date-id" class="song-upload-date">'. $song_date .'</span>
                                <span id="song-name-id-'. $song['ID'].'" class="song-name">'. $song['NAME'] .'</span>
                                <span id="song-author-id" class="song-author">BY '. $song['AUTHOR'] .' | '. $song['ALBUM_NAME'] .' | '. date('i:s', $timeSong) .' </span>
                                <span id="song-status-'. $song['ID'] .'" class="song-status" >Now playing</span>
                            </div>
                        </div>
                    </div>
                ');

                if($inc%2==0){
                print("
                    </div>
                ");
                }
                $inc = $inc + 1;
            }
            ?>
        </div>
        <footer class="footer" id="footer" >
            <div class="buttons">
                <audio id="univ-player" ontimeupdate="sliderPlay(this.currentTime);">
                    <source src="/media/music/No_Name.mp3" type="audio/mpeg">
                        <span id="time">0 / 0</span>
                </audio>
            </div>
        </footer>


        <script type="text/javascript">
            var audio = document.getElementById("univ-player");                 //audio source
            var volume = document.getElementById("volume-slider");              //volume slider
            var sliderDesktop = document.getElementById("slider-desktop-song"); //desktop song time slider

            sliderDesktop.value = 0;                                            //start song time slider at 0

            function setPlayerSong(location, id, name, description){            //location: path to the audio file; id: id of the song; name: name of the song; description: description of the song
                document.title = document.getElementById("song-name-id-"+id).textContent;
                document.getElementById("song-name-desktop").textContent = name;
                document.getElementById("song-description").textContent = description == undefined ? "" : description;
                for(var i = 1; i < <?php echo $countSongs ?>+1; i++){
                    if(i !== id){                                               //if the i value doesn't match the song's id, the slider will be invisible
                        var slider = document.getElementById("slider-top-"+i);
                        var bgStr = "background: -webkit-linear-gradient(180deg, #121212 100%, #adadad 100%);";
                        slider.setAttribute("style", bgStr);
                    }
                }

                for(var i = 1; i < id-1;i++){                                   //playlist things I need to change
                    var hideLi = document.getElementById("song-"+i);
                    hideLi.textContent = "";
                }
                

                audio.setAttribute("src",location);
                changePlayBtn();
                setPlayingStatus(id);                                           //add label
                var song_id = document.getElementById("song_id");
                song_id.innerText=id;                                           //set id of current song on html
            }

            function playFromUrl(){                                             //gets the id from the URI and music info
                <?php if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    sanitize_input($id);
                    $song = $conn->getSongById($id);
                    print('
                        const id = '. $id .';
                        const name = "'. $song["0"] .'";
                        var description = "'. $song["1"] .'";
                        const path = "'. $song["3"] .'";
                        setPlayerSong(path, id, name, description);
                    ');
                } ?>                
            }

            function removePlayingStatus(){
                var songs = parseInt(<?php  print($countSongs); ?>);
                for(var i=1; i < songs+1; i++){
                    setPlayingStatusOff(i);
                }
            }
        </script>

        <script src="/js/homepage.js" type="text/javascript"></script>

        <script type="text/javascript">
            <?php
            for($i = 1; $i < $countSongs +1; $i++){ //change song currentTime by clicking on the rectangle in front of the song picture
            print('
                var ele'.$i.' = document.getElementById("slider-top-"+'. $i .');
                ele'.$i.'.addEventListener("mousedown", function(e) {
                    if(playing(audio)){
                    // Get the target
                    const target = e.target;
                    const rect = target.getBoundingClientRect();
                    // Mouse position
                    const x = e.clientX - rect.left;

                    var width = ele'.$i.'.offsetWidth;
                    var slider = ele'.$i.';
                    //pixels to time
                    var timeSec = (x*audio.duration/width);
                    var timePerc = (x*100/width);
                    var bgStr = "background: -webkit-linear-gradient(180deg, #121212 "+timePerc+"%, #adadad "+timePerc+"%);";
                    for(var i = 1; i < '.$countSongs.'+1; i++){
                        if(i !== '.$i.'){
                            var slider = document.getElementById("slider-top-"+i);
                            var bgStr = "background: -webkit-linear-gradient(180deg, #121212 100%, #adadad 100%);";
                            slider.setAttribute("style", bgStr);
                        }
                    }
                    slider.setAttribute("style", bgStr);
                    audio.currentTime = timeSec;
                    }
                });
            ');

            }
            ?>
        </script>
    </body>
</html>
