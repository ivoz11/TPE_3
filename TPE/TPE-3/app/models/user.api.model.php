<?php

    require_once 'app/models/model.php';


    class UserModel extends Model {

        //Funcion que se fija si el usuario registrado existe.
            public function getByUser($usuario) {
                $query = $this->db->prepare("SELECT * FROM usuarios WHERE user = ?");
                $query->execute([$usuario]);
                $date = $query->fetch(PDO::FETCH_OBJ);
                return $date;
        }
    }