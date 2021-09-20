<?php
    class Music{
        private $conn;

        function __construct($db){
            $this->conn = $db;
        }

        // get all songs
        function getAllSongs(){
            try{
                $sql = '
                SELECT ALBUM.NAME as ALBUM_NAME, SONG.ID, SONG.LOCATION, SONG.AUTHOR, SONG.IMAGE_LOCATION, SONG.CREATED_DATE as CREATED_DATE,  SONG.NAME, SONG.DESCRIPTION, ALBUM.CREATED_BY, SONG.TIME
                FROM SONG
                INNER JOIN ALBUM
                ON SONG.ALBUM_ID= ALBUM.ID;
                ';
                //Get PDOStatememnt object
                 $pQuery = $this->conn->prepare($sql);
                 $pQuery->execute();
                 return $pQuery->fetchAll();
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }

        // get song by id
        function getSongById($id){
            try{
                $sql = '
                SELECT NAME, DESCRIPTION, ID, LOCATION
                FROM SONG
                WHERE ID = :id;
                ';
                //Get PDOStatememnt object
                $results = $this->conn->prepare($sql);
                
                $results->bindParam(':id', $id, PDO::PARAM_INT);
                $results->execute();
                return $results->fetchAll();
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }

        // get all albums
        function getAlbums(){
            try{
                $sql = '
                SELECT *
                FROM ALBUM;
                ';
                //Get PDOStatememnt object
                $results = $this->conn->prepare($sql);
                
                $results->execute();
                return $results->fetchAll();
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }
    }
?>