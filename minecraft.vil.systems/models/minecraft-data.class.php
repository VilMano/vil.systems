<?php
    class MinecraftData{
        private $dbh;

        function openConn(){
            $this->dbh = new PDO("mysql:host=94.60.78.129;dbname=mcstatus;", "root", "Tool+0112358");

            return $this->dbh;
        }
    }
?>