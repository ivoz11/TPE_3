<?php   

    require_once 'app/models/model.php';

    class PlayerModel extends Model {

        //Trae todos los jugadores
        function getAllPlayers(){
            $query = $this->db->prepare('SELECT jugadores.*, equipos.* FROM jugadores JOIN equipos ON jugadores.id_team = equipos.id_team');
            $query->execute();
            $players = $query->fetchAll(PDO::FETCH_OBJ);
            return $players;
        }
        //Trae un solo jugador
        function getPlayer($id_Player){
            $query = $this->db->prepare( 'SELECT jugadores.id_player, jugadores.name_player, jugadores.lastname, jugadores.age, jugadores.id_team,jugadores.profile_player, jugadores.position, jugadores.goals,equipos.name_team FROM jugadores JOIN equipos ON jugadores.id_team = equipos.id_team WHERE id_player =?');
            $query->execute(array($id_Player));
            $player = $query->fetch(PDO::FETCH_OBJ);
            return $player;
        }

        //Elimina un jugador
        function deletePlayer($id_Player) {
            $query = $this->db->prepare('DELETE FROM jugadores WHERE id_player = ?');
            $query->execute([$id_Player]);
        }

        //Inserta un jugador
        function insertPlayer($name,$lastname,$age,$team,$profile,$position,$goals) {
            $query = $this->db->prepare('INSERT INTO jugadores (name_player,lastname,age,id_team,profile_player,position,goals) VALUES (?,?,?,?,?,?,?)');
            $query->execute([$name,$lastname,$age,$team,$profile,$position,$goals]);
            return $this->db->lastInsertId();
        }

        //Modifica un jugador
        function updatePlayer($id,$name,$lastname,$age,$team,$profile,$position,$goals){
            $query = $this->db->prepare("UPDATE jugadores SET name_player =?,lastname=?,age=?,id_team=?,profile_player=?,position=?,goals=? WHERE id_player =?");
            $query->execute(array($name,$lastname,$age,$team,$profile,$position,$goals,$id));
        }
        //Se fija si la columna que se paso existe en la tabla
        function valueSort($sort=null){
            $query = $this->db->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = ? AND TABLE_NAME = 'jugadores'");
            $query->execute(array($sort));
            $column = $query->fetchAll(PDO::FETCH_OBJ);
            return count($column);
        }
        //Ordena por todos los parametros orden,columna y filtrado
        function orderSortedAndFiltered ($order,$sort,$filter){
            $query = $this->db->prepare( "SELECT jugadores.*, equipos.name_team FROM jugadores JOIN equipos ON jugadores.id_team = equipos.id_team WHERE jugadores.id_team = ? ORDER BY $sort $order");
            $query->execute([$filter]);
            $players = $query->fetchAll(PDO::FETCH_OBJ);
            return $players; 
        }
        //Ordena por orden y columna
        function sortedAndOrder($sort,$order){
            $query = $this->db->prepare( "SELECT jugadores.*, equipos.name_team FROM jugadores JOIN equipos ON jugadores.id_team = equipos.id_team ORDER BY $sort $order");
            $query->execute();
            $players = $query->fetchAll(PDO::FETCH_OBJ);
            return $players; 
        }
        //Paginado 
        function paginated($page,$limit){
            $offset = (($page - 1) * $limit); 
            $query = $this->db->prepare("SELECT jugadores.*, equipos.name_team FROM jugadores JOIN equipos ON jugadores.id_team = equipos.id_team ORDER BY id_player  LIMIT ".$offset ." , ".$limit);
            $query->execute();
            $players = $query->fetchAll(PDO::FETCH_OBJ);
            return $players; 
        }    
        //Filtra jugadores por equipo
        function filter($filter){
            $query = $this->db->prepare("SELECT * FROM jugadores WHERE id_team = ?");
            $query->execute([$filter]);
            $players = $query->fetchAll(PDO::FETCH_OBJ);
            return $players;
        }
    }