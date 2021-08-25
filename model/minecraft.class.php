<?php
    class Minecraft{
        private $conn;

        function __construct($db){
            $this->conn = $db;
        }

        function getOnlineUsers(){
            try{
                $sql = 'SELECT player.name, status.timestamp FROM player_status 
                LEFT JOIN player ON player_status.player_id = player.id
                LEFT JOIN status ON player_status.status_id = status.id
                WHERE status.id = (SELECT id FROM status ORDER BY id DESC LIMIT 1);';
                $query = $this->conn->prepare($sql);
                $query->execute();
                return $query->fetchAll();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }
        }

        function getLogs(){
            try{
                $sql = 'SELECT player.id, player.name, status.timestamp, status.status FROM player_status 
                LEFT JOIN player ON player_status.player_id = player.id
                LEFT JOIN status ON player_status.status_id = status.id
                ORDER BY status.id DESC LIMIT 25;';
                $query = $this->conn->prepare($sql);
                $query->execute();
                return $query->fetchAll();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }
        }

        function lastCurrentStatus(){
            try{
                $sql = 'SELECT status, timestamp FROM status ORDER BY id DESC LIMIT 1;';
                $query = $this->conn->prepare($sql);
                $query->execute();
                return $query->fetchAll();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }
        }

        function lastServerStatus(){
            try{
                $sql = 'SELECT * FROM server_status ORDER BY id DESC LIMIT 1;';
                $query = $this->conn->prepare($sql);
                $query->execute();
                return $query->fetchAll();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }
        }
        
        function getTimeByPlayer(){
            try{
                $sql = 'SELECT COUNT(player_status.status_id) as total_time, player_status.player_id, player.name FROM player_status 
                LEFT JOIN player ON player_status.player_id = player.id
                LEFT JOIN status ON player_status.status_id = status.id
                GROUP BY player.id
                ORDER BY total_time DESC;';
                $query = $this->conn->prepare($sql);
                $query->execute();
                return $query->fetchAll();
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }
        }

    }
?>
