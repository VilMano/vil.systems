<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('../../model/data.php');

    $conn = new Data("gallery");
    $hpictures = $conn->getAllHorizontalPictures();
    $vpictures = $conn->getAllVerticalPictures();

    print('<div id="horizontal-div">');

    for($i = 0; $i<count($hpictures); $i++){
        if($hpictures[$i+1]["path"] != null){
    
        print('
            <div class="row horizontal-row">
                <img src="'. $hpictures[$i]["path"] .'" class="horizontal-picture picture">
                <img src="'. $hpictures[$i+1]["path"] .'" class="horizontal-picture picture">
            </div>');
            }else{
              print('
               <div class="row horizontal-row">
                    <img src="'. $hpictures[$i]["path"] .'" class="horizontal-picture picture">
                </div>');
        }
        $i = $i+1;
    }

    print('</div>');

    
    print('<div id="vertical-div" style="display: none;">');
    for($i = 0; $i<count($vpictures); $i++){
        if(isset($vpictures[$i+1])){
            print('
            <div class="row vertical-row">
                <img src="'. $vpictures[$i]["path"] .'" class="vertical-picture picture">
                <img src="'. $vpictures[$i+1]["path"] .'" class="vertical-picture picture">
            </div>');
        }else{
            print('
            <div class="row vertical-row">
                <img src="'. $vpictures[$i]["path"] .'" class="vertical-picture picture">
            </div>');
        }
       $i = $i+1;
    }
    print('</div>');
?>

