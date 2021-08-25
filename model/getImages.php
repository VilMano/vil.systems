<?php 
    require('/var/www/vil.systems/model/data.php');

    $conn = new Data("gallery");
    $pictures = $conn->getAllPictures(true);
    $pictures_json = json_encode($pictures);

    echo $pictures_json;
?>