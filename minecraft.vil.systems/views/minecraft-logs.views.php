<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('../models/minecraft-data.class.php');
    require('../models/minecraft.class.php');

    $mcDB = new minecraftData();
    $mcDB = $mcDB->openConn();

    $mc = new Minecraft($mcDB);
    $mc = $mc->getTimeByPlayer();

    print('
        <div class="card-record">
            <div class="name-user">
                <span style="color: #2e79c8;"><b>Name</b></span>
            </div>
            <div class="total-time">
                <span style="color: #b56e5d;"><b>Total time played</b></span>
            </div>
        </div>
        <hr style="width: 100%; color: #292929; padding: 0.1rem; background-color: #292929; border: none;">
    ');

    foreach($mc as $log){
        // $date = new DateTime();
        // $date->setTimestamp($log["timestamp"]);

        $hours = floor($log["total_time"] / 60);
        $minutes = ($log["total_time"] % 60);
        $time = sprintf('%02dh:%02dm', $hours, $minutes);

        print('
            <div class="card-record">
                <div class="name-user">
                    <span style="color: #2e79c8;">'. $log["name"] .'</span>
                </div>
                <div class="total-time">
                    <span style="color: #b56e5d;">'. $time .'</span>
                </div>
            </div>
        ');
    }
?>