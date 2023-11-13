<?php   

    require_once 'app/models/model.php';

    class TeamModel extends Model {

    // Funcion que trae todos los equipos.
    public function getAllTeams(){
        $query = $this->db->prepare('SELECT * from equipos');
        $query->execute();
        $teams =$query->fetchAll(PDO::FETCH_OBJ);    
        return $teams;
    }

    //Funcion que inserta el equipo.
    function insertTeam($nameTeam,$league,$technicalDirector,$cups) {
        $query = $this->db->prepare('INSERT INTO equipos (name_team,league,technical_director,cups) VALUES (?,?,?,?)');
        $query->execute([$nameTeam,$league,$technicalDirector,$cups]);
        return $this->db->lastInsertId();
        
    }    
    //Funcion que Elimina el equipo a traves de su respectiva ID.
    function deleteTeam($id_Team){
        $query =$this->db->prepare('DELETE FROM equipos WHERE id_team = ?');
        $query->execute([$id_Team]);
    }
    //Funcion que a traves de su ID trae el equipo que le corresponda de la BD.
    function getTeam($id_Team){
        $query=$this->db->prepare('SELECT equipos.id_team, equipos.name_team, equipos.league, equipos.technical_director, equipos.cups FROM equipos WHERE id_team = ?');
        $query->execute(array($id_Team));
        $team = $query->fetch(PDO::FETCH_OBJ);
        return $team;
    }
    //Funcion que edita en la base de datos a traves de su ID.
    function updateTeam($id_Team,$name,$league,$technicalDirector,$cups){
        $query = $this->db->prepare("UPDATE equipos SET name_team = ?,league = ?,technical_director = ?,cups = ? WHERE id_team =?");
        $query->execute(array($name,$league,$technicalDirector,$cups,$id_Team));
    }

}