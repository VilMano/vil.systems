<?php 
    class Gallery{
        private $conn;
        
        function __construct($dbc)
        {
            $this->conn = $dbc;
        }

        function getAllHorizontalPictures(){
            try{
                $sql = 'SELECT path FROM picture WHERE vertical = 0 AND visibility = 1;';
                $results = $this->conn->prepare($sql);
                
                $results->execute();
                return $results->fetchAll();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }
        }

        function getAllVerticalPictures(){
            try{
                $sql = 'SELECT path FROM picture WHERE vertical = 1 AND visibility = 1;';
                $results = $this->conn->prepare($sql);
                $results->execute();
                return $results->fetchAll();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }
        }

        static function getAllAlbums(){
            $dir = parse_ini_file('../db.ini'); //get path to gallery
            $albums = array_values(array_diff(scandir($dir["albums"]), array('.','..'))); //get names of the folders
            $albumArr = array();
            $files = array();
            foreach($albums as $album){
                $files = array_values(array_diff(scandir($dir["albums"] . '/' . strval($album)), array('.', '..'))); //get all the pictures inside each album
                $albumArr += [$album => $files]; //insert files in the corresponding album
            }

            $albumJSON = ["name" => $albumArr];

            return json_encode($albumJSON);
        }
    }
?>