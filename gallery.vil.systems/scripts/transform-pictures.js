var columns = document.getElementsByClassName("square-picture");


for(var i = 0; i < columns.length; i++){
    for(var e = 0; e < columns[i].childNodes.length; e++){
        if(columns[i].childNodes[e].nodeName == "IMG"){             //if img tag
            var picture = document.getElementById(columns[i].childNodes[e].attributes.id.nodeValue);
            if(picture.naturalHeight > picture.naturalWidth){               //if vertical
                picture.classList.remove("horizontal-picture");
                picture.classList.add("vertical-picture");
            }
        }
    }
}

function openAlbum(id){
    window.location.replace("/views/single.view.php?id="+ id +"");
}
