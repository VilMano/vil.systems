var audio = document.getElementById("player");                     //audio source
var volume = document.getElementById("volume-slider");                  //volume slider
var sliderDesktop = document.getElementById("slider-desktop-song");     //desktop song time slider

sliderDesktop.oninput = function()                                      //change audio on slider click
{
    audio.currentTime = audio.duration*sliderDesktop.value/100;
};

volume.oninput = function(){ audio.volume = volume.value/100; };

window.onload = playFromUrl();

document.body.onkeyup = function(e){
    //spacebar
    if(e.keyCode == 32){
        changePlayBtn();
    }
}

function changePlayBtn(){   //############################## NEEDS REVISION
    //get the song playing id and set status opacity function
    var song_id = document.getElementById("song_id").innerText;
    //change the icon
    var pause_play = document.getElementById("playing-cover");
    var play_btn_desktop = document.getElementById("play-btn-desktop");
    if(playing(audio)){
        pause_play.setAttribute("src", "/media/images/icons/play_white_512.png");
        pause_play.setAttribute("style", "margin-left: 6%;");
        play_btn_desktop.setAttribute("src", "/media/images/icons/play_white_64.png");  
        removePlayingStatus(song_id);
        audio.pause();
    }else{
        pause_play.setAttribute("src", "/media/images/icons/pause_white_512.png");
        pause_play.setAttribute("style", "margin-left: 0%;");
        play_btn_desktop.setAttribute("src", "/media/images/icons/pause_white_64.png");
        setPlayingStatus(song_id); 
        audio.play().catch((e)=>{
            console.log(e);
         });
    }
}

function sliderDesktopOnClick(){
    var timePerc = sliderDesktop.value;
    audio.currentTime = timePerc;
    console.log(timePerc);
}

function sliderPlay(time){
    var sliderDesktop = document.getElementById("slider-desktop-song");
    var song_id = document.getElementById("song_id");
    var id = song_id.textContent;
    var width = document.getElementById("slider-top-"+id).offsetWidth;
    var slider = document.getElementById("slider-top-"+id);
    var timePerc = (time*100/audio.duration);
    var timeRunning = timePerc;
    var timeLeft = 100-timePerc;
    var bgStr = "background: -webkit-linear-gradient(180deg, #121212 "+timeLeft+"%, #adadad "+timeLeft+"%);";
    slider.setAttribute("style", bgStr);
    sliderDesktop.value = timePerc;

    if(audio.currentTime === audio.duration){  audio.currentTime = 0; audio.pause(); removePlayingStatus();  }
}

function setPlayingStatusOff(id){
    var songStatus = document.getElementById("song-status-" + id);
    songStatus.setAttribute("style", "opacity: 0%;");
}

function setPlayingStatus(id){
    removePlayingStatus(song_id);
    var songStatus = document.getElementById("song-status-" + id);
    songStatus.setAttribute("style", "opacity: 100%;");
    songStatus.setAttribute("style","animation: blink 2s linear infinite;");
}

function playing(audioEl){
    return !audioEl.paused;
}

function stopAudio(){
    audio.currentTime = 0.0;
    changePlayBtn();
}
