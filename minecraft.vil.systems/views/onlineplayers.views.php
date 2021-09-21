<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('../models/minecraft-data.class.php');
    require('../models/minecraft.class.php');

    $mcDB = new minecraftData();
    $mcDB = $mcDB->openConn();

    $mc = new Minecraft($mcDB);
    $mc = $mc->getOnlineUsers();
    
        
    if(empty($mc)){
        
        print('
        <div class="card-record">
            <span>No players online</span>
        </div>');
    }else{
        foreach($mc as $player){
            print('
            <div class="card-record">
                    <span>'. $player["name"] .'</span>
            </div>
            '); 
        }
    }
?>