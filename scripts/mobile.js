var featured = document.getElementById("featured");

    if(window.screen.width < 960){
        featured.setAttribute("style", "display: none;");
    }else{
        featured.setAttribute("style", "display: block;");
    }

$(window).on("resize", function(){
    if(window.screen.width < 960){
        featured.setAttribute("style", "display: none;");
    }else{
        featured.setAttribute("style", "display: block;");
    }
});

