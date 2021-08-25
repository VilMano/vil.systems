<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once '../model/data.php';

    $url = $_GET["v"];

    $data = new Data();
    $data->getConnection('jerma');
    echo $data->getJermaAdhd($url)[0];
?>