<?php
    class Data{
        private $dbh;
        private $sql = '';
        private $results;

        function getConnection($database){
            $db = parse_ini_file('../db.ini');
            if($this->dbh==null){
                $this->dbh = new PDO('sqlite:'. $db["path". $database] .'');
                return $this->dbh;
            }

            return $this->dbh;
        }

        function sanitize_input($par){
            $par = strip_tags($par);        // Remove dangerous tags
            $par = htmlspecialchars($par);  // Escape any remaining special characters
        
            return $par;
        }

        function getAllSongs(){
            try{
                $this->sql = '
                SELECT ALBUM.NAME as ALBUM_NAME, SONG.ID, SONG.LOCATION, SONG.AUTHOR, SONG.IMAGE_LOCATION, SONG.CREATED_DATE as CREATED_DATE,  SONG.NAME, SONG.DESCRIPTION, ALBUM.CREATED_BY, SONG.TIME
                FROM SONG
                INNER JOIN ALBUM
                ON SONG.ALBUM_ID= ALBUM.ID;
                ';
                //Get PDOStatememnt object
                 $this->results = $this->dbh->prepare($this->sql);
                 $this->results->execute();
                 return $this->results->fetchAll();
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }

        function getCountAllSongs(){
            try{
                $this->sql = '
                SELECT ID
                FROM SONG;
                ';
                //Get PDOStatememnt object
                 $this->results = $this->dbh->prepare($this->sql);
                 $this->results->execute();
                 return $this->results->rowCount();
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }

        function getSongById($id){
            try{
                $this->sql = '
                SELECT NAME, DESCRIPTION, ID, LOCATION
                FROM SONG
                WHERE ID = :id;
                ';
                //Get PDOStatememnt object
                $this->results = $this->dbh->prepare($this->sql);
                
                $this->results->bindParam(':id', $id, PDO::PARAM_INT);
                $this->results->execute();
                return $this->results->fetch();
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }

        function getAllComments(){
            try{
                $this->sql = '
                SELECT NAME, COMMENT_EN, CREATED_DATE, ID, COMMENT_PT
                FROM COMMENT;
                ';
                //Get PDOStatememnt object
                 $this->results = $this->dbh->prepare($this->sql);
                 $this->results->execute();
                 return $this->results->fetchAll();
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }

        function getAllPfp(){
            try{
                $this->sql = '
                SELECT PICTURE_PATH, ID
                FROM PROFILE;
                ';
                //Get PDOStatememnt object
                 $this->results = $this->dbh->prepare($this->sql);
                 $this->results->execute();
                 return $this->results->fetchAll();
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }

        function insertIntoCommentaries($name, $comment){
            try{
                if($name != null && $comment != null){
                    $name = $this->sanitize_input($name);
                    $comment = $this->sanitize_input($comment);
                }

                if($name != "" && $comment != ""){
                    $today = date("Y-m-d");

                    //$this->results->bindParam(':id', $id, PDO::PARAM_INT);
                    $this->sql = '
                    INSERT INTO COMMENT (NAME, COMMENT_EN, CREATED_DATE, ACTIVE) VALUES (?, ?, STR_TO_DATE(?, "%Y-%m-%d"), 1);
                    ';
                    $this->dbh->prepare($this->sql)->execute([strtoupper($name), $comment, $today]);
                }else{

                }
                 
            }catch(PDOException $e){
                print 'Error: ' . $e->getMessage() . '<br/>';
            }
        }

        //##################### GALLERY DB #####################

        function getAllHorizontalPictures(){
            try{
                $sql = 'SELECT path FROM picture WHERE vertical = 0 AND visibility = 1;';
                $results = $this->dbh->prepare($sql);
                
                $results->execute();
                return $results->fetchAll();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }
        }

        function getAllVerticalPictures(){
            try{
                $sql = 'SELECT path FROM picture WHERE vertical = 1 AND visibility = 1;';
                $results = $this->dbh->prepare($sql);
                $results->execute();
                return $results->fetchAll();
            }catch(PDOException $e){

            }
        }

        //##################### JERMA DB #####################

        function getJermaAdhd($url){
            try{
                $sql = 'SELECT adhd FROM video WHERE url = :url';
                $results = $this->dbh->prepare($sql);
                $results->bindParam(':url', $url);
                $results->execute();
                
                return $results->fetch();
            }catch(PDOException $e){
                return 'There was an error when trying to retrieve data.';
            }
        }
    }
?>
