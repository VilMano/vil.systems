$("#navbar").load("../views/master/master-nav.views.php");

function redirect(page){
    console.log(page);
    if(page == "home"){
        window.location.replace("https://vil.systems");
    }else{
        window.location.replace("https://"+ page +".vil.systems");
    }
}