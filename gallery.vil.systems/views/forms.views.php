<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once '../models/data.class.php';
    include_once '../models/temp.class.php';
    $token = $_GET["token"];
    
    $conn = new Data();
    $temp = new Temp($conn->getTempConnection());
    $files = $temp->getPicturesByToken($token);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/gallery.css">
        <link rel="stylesheet" href="../styles/forms.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/scripts/jQuery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row center">
                <h1 id="title">Choose Your Pictures</h1>
            </div>



            
            <?php 
                if(!empty($files)){
                    print('
                        <div class="row center">
                        <p>Hello there, if you have access to this webpage it\'s because you are in some of these pictures.</p>
                        </div>
                        <div class="row center">
                            <p>I\'d kindly ask you to select the pictures that you would <b>NOT</B> wish to be publicly seen on my website.</p>
                        </div>
                        <div class="row center">
                            <p><b>NOTE:</b> If you do not see yourself in any pictures just press the green botton at the bottom.</p>
                        </div>
                        <div class="row center bottom">
                            <p>Thank you for your help and cooperation!</p>
                        </div>    
                    ');
                }else{
                    print('
                        <div class="row center">
                            <h1>You have already submitted your pictures.</h1>
                        </div>
                    ');
                }
                ?>
                

                <?php 
                $i = 0;
                $count = 0;
                    if(!empty($files)){
                        foreach($files as $file){
                            $count = $count +1;
                            $path = explode("gallery.vil.systems" , $file["url"]);


                            $fp = fopen($file["url"], 'rb');
                            $picture = exif_read_data($fp);
                            $height = $picture['COMPUTED']['Height'];
                            $width = $picture['COMPUTED']['Width'];

                            $ori = $picture['Orientation'];

                            $orientation = 'horizontal-picture';
                            $orientationBox = 'horizontal';
                            if($ori == 6 || $ori == 8 && $width > $height){
                                $orientation = 'vertical-picture';
                                $orientationBox = 'vertical';
                            }
                            switch($i){
                                case 0:
                                    print('
                                        <div class="row center">
                                            <div onclick="hightlight('.$file["id"].')" id="picture-square-'. $file["id"] .'" class="square-picture '. $orientationBox .'">
                                                <img loading="lazy" class="picture '. $orientation .'" id="'.$file["id"] .'" src="'. $path[1] .'" alt="">
                                            </div>
                                    ');
                                    $i = $i +1;
                                break;

                                case 1:
                                    print('
                                        <div onclick="hightlight('.$file["id"].')" id="picture-square-'. $file["id"] .'" class="square-picture '. $orientationBox .'">
                                            <img loading="lazy" class="picture '. $orientation .'" id="'.$file["id"] .'" src="'. $path[1] .'" alt="">
                                        </div>
                                    ');
                                    $i = $i +1;

                                    break;

                                case 2: 
                                    print('
                                        <div onclick="hightlight('.$file["id"].')" id="picture-square-'. $file["id"] .'" class="square-picture '. $orientationBox .'">
                                            <img loading="lazy" class="picture '. $orientation .'" id="'.$file["id"] .'" src="'. $path[1] .'" alt="">
                                        </div>
                                    ');
                                    $i = $i +1;

                                    break;

                                default:
                                    print('
                                            <div onclick="hightlight('.$file["id"].')" id="picture-square-'. $file["id"] .'" class="square-picture '. $orientationBox .'">
                                                <img loading="lazy" class="picture '. $orientation .'" id="'.$file["id"] .'" src="'. $path[1] .'" alt="">
                                            </div>
                                        </div>
                                    ');
                                    $i = 0;
                                break;
                            }

                            if($count == count($files) && $i%3==0){
                                print('</div>');
                            }
                        }

                        print('
                            <div class="row center">
                                <button id="sumbit-btn" onclick="insertVote()" class="btn-submit">Submit</button>
                            </div>    
                        ');
                    }

                    print('<div class="row center">
                                <a style="color: whitesmoke;" href="https://gallery.vil.systems">Go back to the website</a>
                            </div>
                    ');

                    
                ?>


                




    </div>
    <script src="/scripts/transform-pictures.js"></script>
    <script>
        console.log(window.location.search.split("token=")[1]);
        function hightlight(id){
            var picture = document.getElementById(id);
            var element = document.getElementById("picture-square-" + id);
            if(element.classList.contains("highlighted")){
                element.classList.remove("highlighted");
                // picture.classList.remove("highlighted");
            }else{
                element.classList.add("highlighted");
                // picture.classList.add("highlighted");
            }
        }

        function insertVote(){ //on button click add funciton
            var picturesEle = document.getElementsByClassName("highlighted");
            var picArrId = Array();

            var link = window.location;
            var token = link.search.split("token=")[1];

            for(var i = 0; i < picturesEle.length; i++){
                picArrId.push(picturesEle[i].childNodes[1].id);
            }

            $.ajax({
                method: "POST",
                url: "/views/success.views.php",
                data: { pictures: picArrId, token: token},
                success: function(data){
                    console.log("success");
                    console.log(data);
                    alert("Thank you for contributing!");
                    location.replace("https://gallery.vil.systems");
                },
                error: function(){
                    console.log("error");
                }

            });
        }
    </script>
    </body>
</html>
