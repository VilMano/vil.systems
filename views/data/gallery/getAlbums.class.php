<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $dir = parse_ini_file('../../../../db.ini');
    $albums = scandir($dir["albums"]);
    unset($albums[0], $albums[1]);
    $albumArr = array();
    foreach($albums as $album){
        array_push($albumArr, $album);
        $files = scandir($dir["albums"] . '/' . strval($album));
        unset($files[0], $files[1]);
        $albumArr += [$album => $files];
    }

    echo json_encode($albumArr);
?>