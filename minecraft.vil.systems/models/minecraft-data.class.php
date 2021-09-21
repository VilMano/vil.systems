<?php
    class MinecraftData{
        private $dbh;

        function openConn(){
            $this->dbh = new PDO("mysql:host=192.168.1.146;dbname=mcstatus;", "mc", "vilminecraft");

            return $this->dbh;
        }
    }
?>