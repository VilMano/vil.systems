<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once '../models/data.class.php';
    include_once '../models/temp.class.php';

    $data = new Data();
    $tempConn = new Temp($data->getTempConnection());

    $tempConn->insertVotes($_POST['pictures'], $_POST['token']);
?>

