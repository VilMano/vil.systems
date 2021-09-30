<?php
    class Temp{
        private $conn;

        function __construct($db)
        {
            $this->conn = $db;
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }

        function getPicturesByToken($token){
            $sql = 'SELECT id, used FROM token
                    WHERE token = :token;
            ';

            $query = $this->conn->prepare($sql);
            $query->bindParam(':token', $token);
            $query->execute();
            $token = $query->fetch();
            $token_id = $token["id"];

            if($token["used"] == 1){
                return array();
            }

            $sql = 'SELECT temp.url, id, downvote FROM temp
                    LEFT JOIN temp_token 
                    ON temp_token.temp_id = temp.id
                    WHERE temp_token.token_id = :token_id';
                    
            $query = $this->conn->prepare($sql);
            $query->bindParam(':token_id', $token_id);
            $query->execute();

            return $query->fetchAll();
        }

        function insertVotes($idlist, $token){
            if(!empty($idlist)){
                try{
                    $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
                    $sql = 'UPDATE temp
                        SET downvote = 1
                        WHERE id = :id;
                    ';
                    $query = $this->conn->prepare($sql);

                    foreach($idlist as $id){
                        $idint = intval($id);
                        $query->bindParam(':id', $idint, PDO::PARAM_INT);
                        $query->execute();
                    }

                    $sql = 'UPDATE token SET used = 1 WHERE token = :token';
                    $query = $this->conn->prepare($sql);
                    $query->bindParam(':token', $token);
                    $query->execute();
                }catch(PDOException $e){
                    throw new Exception($e);
                }
            }


        }
    }
?>