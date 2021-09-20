<?php
    include_once 'album.class.php';

    class Gallery{
        private $conn;

        function __construct($db)
        {
            $this->conn = $db;
        }

        // get all pictures and albums
        function getAlbums(){
            try{
                $albums = array();
                $sql = 'SELECT id, date, name FROM album;';
                $pQuery = $this->conn->prepare($sql);
                $pQuery->execute();

                foreach($pQuery->fetchAll() as $album){
                    $albumObj = new Album();
                    $albumObj->id = $album["id"];
                    $albumObj->name = $album["name"];
                    $albumObj->date = $album["date"];
                    $sql = 'SELECT url, id FROM picture WHERE album_id = ' . $albumObj->id . ' LIMIT 4';

                    $pQuery = $this->conn->prepare($sql);
                    $pQuery->execute(); 
                    $albumObj->pictures = $pQuery->fetchAll();

                    array_push($albums, $albumObj);
                }

                return $albums;
            }catch(PDOException $e){
                throw new Exception($e);
            }
        }

        // get all pictures and albums
        function getAlbumById($id){
            try{
                $albums = array();
                $sql = 'SELECT id, date, name FROM album WHERE id = :id;';
                $pQuery = $this->conn->prepare($sql);
                $pQuery->bindParam(':id', $id);
                $pQuery->execute();

                $album = $pQuery->fetch();
                    $albumObj = new Album();
                    $albumObj->id = $album["id"];
                    $albumObj->name = $album["name"];
                    $albumObj->date = $album["date"];
                    $sql = 'SELECT url, id FROM picture WHERE album_id = ' . $albumObj->id . ';';

                    $pQuery = $this->conn->prepare($sql);
                    $pQuery->execute(); 
                    $albumObj->pictures = $pQuery->fetchAll();

                    array_push($albums, $albumObj);

                return $albums;
            }catch(PDOException $e){
                throw new Exception($e);
            }
        }
    }
?>