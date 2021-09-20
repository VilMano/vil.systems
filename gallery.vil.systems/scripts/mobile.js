$(document).ready(function(){
        var infomobileArr = document.getElementsByClassName("info-mobile");
        var columnleftArr = document.getElementsByClassName("column-left");
        var columnrightArr = document.getElementsByClassName("column-right");

        for( var i=0; i < infomobileArr.length; i++){
            if(window.screen.width < 960){
                console.log(window.screen.width);

                infomobileArr[i].setAttribute("style", "display: block;");
                columnleftArr[i].setAttribute("style", "display: none;");
                columnrightArr[i].setAttribute("style", "width: 98%;");
            }else{
                console.log(window.screen.width);
                
                infomobileArr[i].setAttribute("style", "display: none;");
                columnleftArr[i].setAttribute("style", "display: flex;");
                columnrightArr[i].setAttribute("style", "width: 73%;");
            }
            
            $(window).on("resize", function(){
                if(window.screen.width < 960){
                    infomobileArr[i].setAttribute("style", "display: block;");
                    columnleftArr[i].setAttribute("style", "display: none;");
                    columnrightArr[i].setAttribute("style", "width: 98%;");
                }else{
                    infomobileArr[i].setAttribute("style", "display: none;");
                    columnleftArr[i].setAttribute("style", "display: flex;");
                    columnrightArr[i].setAttribute("style", "width: 73%;");
                }
            });
        }
    }
);
