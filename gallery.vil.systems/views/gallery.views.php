<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once '../models/data.class.php';
    include_once '../models/gallery.class.php';

    $data = new Data();
    $conn = $data->getConnection();
    $galleryDB = new Gallery($conn);

    $albums = $galleryDB->getAlbums();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/gallery.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/scripts/jQuery.min.js"></script>
        <script src="/scripts/mobile.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row center">
                <h1 id="title">Gallery</h1>
            </div>
            <?php 
                foreach($albums as $album){
                    print("
                        <div class=\"row\">
                            <div class=\"column-left\" id=\"column-left\">
                                <div class=\"left-row\">
                                    <div class=\"info\" id=\"info\">
                                        <div class=\"album-title\">
                                            <span class=\"album-name\" onclick=\"openAlbum(". $album->id .")\">". $album->name ."</span>
                                        </div>
                                        <div class=\"album-date\">
                                            <span>". $album->date ."</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"column-mid\">
                                <div class=\"vr\"></div>
                            </div>

                            <div class=\"column-right\" id=\"column-right\">
                            <div class=\"info info-mobile\">
                                        <div class=\"album-title\">
                                            <span class=\"album-name\" onclick=\"openAlbum(". $album->id .")\">". $album->name ."</span>
                                        </div>
                                        <div class=\"album-date\">
                                            <span>". $album->date ."</span>
                                        </div>
                                    </div>
                        ");

                    $i = 0;
                    foreach($album->pictures as $picture){
                        $path = explode("gallery.vil.systems" , $picture["url"]);

                        $fp = fopen($picture["url"], 'rb');
                        $pictureOri = exif_read_data($fp);
                        $height = $pictureOri['COMPUTED']['Height'];
                        $width = $pictureOri['COMPUTED']['Width'];

                        $orientation = 'horizontal-picture';
                        $orientationBox = 'horizontal';
                        if( $width < $height){
                            $orientation = 'vertical-picture';
                            $orientationBox = 'vertical';
                        }

                        if($i == 0){
                            print("
                            <div class=\"row\">
                                <div class=\"square-picture  ". $orientationBox ."\">
                                    <img loading=\"lazy\" onclick=\"openAlbum(". $album->id .")\" class=\"picture ". $orientation ." top-left-round\" id=\"picture-". $picture["id"] ."\" src=\"". $path[1] ."\" alt=\"\">
                                </div>
                            ");
                        }

                        if($i == 1){
                            print("
                                <div class=\"square-picture ". $orientationBox ."\">
                                    <img loading=\"lazy\" onclick=\"openAlbum(". $album->id .")\" class=\"picture ". $orientation ." top-right-round\" id=\"picture-". $picture["id"] ."\" src=\"". $path[1] ."\" alt=\"\">
                                </div>
                            </div>
                            ");
                        }

                        if($i == 2){
                            print("
                            <div class=\"row\">
                                <div class=\"square-picture ". $orientationBox ."\">
                                    <img loading=\"lazy\" onclick=\"openAlbum(". $album->id .")\" class=\"picture ". $orientation ." bottom-left-round\" id=\"picture-". $picture["id"] ."\" src=\"". $path[1] ."\" alt=\"\">
                                </div>
                            ");
                        }

                        if($i == 3){
                            print("
                                <div class=\"square-picture ". $orientationBox ."\">
                                    <img loading=\"lazy\" onclick=\"openAlbum(". $album->id .")\" class=\"picture ". $orientation ." bottom-right-round\" id=\"picture-". $picture["id"] ."\" src=\"". $path[1] ."\" alt=\"\">
                                </div>
                            </div>
                            ");
                        }
                        $i = $i +1;
                    }
                    
                    print("
                            </div>
                        </div>    
                    ");
                }
            ?>
        </div>
        <div id="navbar"></div>
        <script src="../scripts/transform-pictures.js"></script>
        <script src="../scripts/navbar.js"></script>
    </body>
</html>