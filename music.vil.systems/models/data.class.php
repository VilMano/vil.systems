<?php
    class Data{
        private $dbh;

        function getConnection(){
            if($this->dbh == null){
                $dbfile = realpath('../db/music_server.db');
                $this->dbh = new PDO('sqlite:'.$dbfile);
                return $this->dbh;
            }
        }
    }
?>