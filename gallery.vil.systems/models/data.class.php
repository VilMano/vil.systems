<?php 
    class Data{
        private $dbh;

        function getConnection(){
            if($this->dbh==null){
                $dbfile = realpath('../db/gallery.db');
                $this->dbh = new PDO('sqlite:'.$dbfile);
            }

            return $this->dbh;
        }

        function getTempConnection(){
            if($this->dbh==null){
                $dbfile = realpath('../db/temp.db');
                $this->dbh = new PDO('sqlite:'.$dbfile);
            }

            return $this->dbh;
        }
    }
?>