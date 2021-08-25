<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('../model/minecraft-data.class.php');
    require('../model/minecraft.class.php');

    $mcDB = new minecraftData();
    $mcDB = $mcDB->openConn();

    $mc = new Minecraft($mcDB);
    $status = $mc->lastServerStatus();

    $online_status = $mc->lastCurrentStatus()[0];
?>

<!Doctype html>
<html>
    <head>
        <link rel="stylesheet" href="../css/minecraft/minecraft.css">
        <link rel="stylesheet" id="stylesheet" href="../css/minecraft/minecraft-dark.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/navbar/navbar.css">
        <link rel="stylesheet" id="style-nav" href="../css/navbar/navbar-dark.css">
        <script src="/scripts/jQuery.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row title-row">
                <span id="title">Minecraft Server</span>
            </div>
            <div class="row">
                <div class="align-center">
                    <div class="column center">
                        <div class="card">
                            <div class="card-title">
                                <span>Online</span><div id="online-sing"></div>
                            </div>
                            <div id="card-body">
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="server-info">
                            <span id="info-title">Server info</span>
                        </div>
                            <span>SERVER STATUS: <?php if($online_status["status"] == 1){ print('<span style="color: green;">Online </span>'); } else { print('<span style="color: red;">Offline</span>'); } ?></span>
                            <span>OS: Ubuntu 20.04.2 LTS</span>
                            <span>SERVER HARDWARE: Raspberry Pi 4</span>
                            <span>STORAGE:  <?php print($status[0][3]); ?>GB/32GB</span>
                            <span>MINECRAFT SERVER: 1.12.2-forge-14.23.5.2855</span>
                            <span>LAST UPDATED: 
                                <?php 
                                    $date = new DateTime();
                                    $date->setTimestamp($online_status["timestamp"]);
                                    print($date->format('d-m-Y H:i:s'));
                                ?>
                            </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
            <div class="card-100">
                        <div class="card-title">
                            <span>Logs</span>
                        </div>
                        <div id="card-body-log">
                        </div>
                    </div>
            </div>
        </div>
        <div class="navbar-single">
            <img id="moon" src="/media/images/icons/moon_light.png" class="clickable light-switch-single" width="16">
            <img id="sun" src="/media/images/icons/sun_light.png" class="clickable light-switch-single" width="16">
            <div id="blur"></div>
        </div>

        <script type="text/javascript">
            var darkmode = false;

            document.getElementById("sun").onclick = function(){
                document.getElementById("stylesheet").href = "../css/minecraft/minecraft-light.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar.css";
                document.getElementById("moon").src = "/media/images/icons/moon.png";
                document.getElementById("sun").src = "/media/images/icons/sun.png";
            };

            document.getElementById("moon").onclick = function(){
                document.getElementById("stylesheet").href = "../css/minecraft/minecraft-dark.css";
                document.getElementById("style-nav").href = "../css/navbar/navbar-dark.css";
                document.getElementById("moon").src = "/media/images/icons/moon_light.png";
                document.getElementById("sun").src = "/media/images/icons/sun_light.png";
            };
        </script>
        <script>
            $("#card-body").load("../views/onlineplayers.view.php");
            const interval = setInterval(function(){
                $("#card-body").load("../views/onlineplayers.view.php");
            }, 3000);

            $("#card-body-log").load("../views/minecraft-logs.view.php");
            const logs = setInterval(function(){
                $("#card-body-log").load("../views/minecraft-logs.view.php");
            }, 3000);

        </script>
    </body>
</html>