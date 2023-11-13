<?php   

    require_once 'app/models/model.php';

    class CommentModel extends Model {

        //Trae todos los comentarios
        function getAllComments(){
            $query = $this->db->prepare('SELECT * FROM comentarios ORDER BY id_player ASC');
            $query->execute();
            $comments = $query->fetchAll(PDO::FETCH_OBJ);
            return $comments;
        }

        //Trae un comentario especifico
        function getComment($id_Comment){
            $query = $this->db->prepare( "SELECT * FROM comentarios WHERE id_comment =?");
            $query->execute(array($id_Comment));
            $comment = $query->fetch(PDO::FETCH_OBJ);
            return $comment;
        }

        //Trae todos los comentarios de un jugador especifico
        function getCommentsPlayer($id_Player){
            $query = $this->db->prepare( "SELECT * FROM comentarios WHERE id_player = ?");
            $query->execute(array($id_Player));
            $comments = $query->fetchAll(PDO::FETCH_OBJ);
            return $comments;
        }
        
        //Inserta un nuevo comentario
        function insertComment($comment,$id_player){
            $query = $this->db->prepare("INSERT INTO comentarios (comment, id_player) VALUES (?, ?)");
            $query->execute(array($comment,$id_player));
            return $this->db->lastInsertId();
        }

        //Eliminar comentario
        function deleteComment($id){
            $query = $this->db->prepare("DELETE FROM comentarios WHERE comentarios.id_comment= ?");
            $query->execute(array($id));
        }
    }