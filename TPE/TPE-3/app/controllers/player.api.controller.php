<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/models/player.api.model.php';

    class PlayerApiController extends ApiController{

        private $modelPlayer;
    

        public function __construct(){
            parent::__construct();
            $this->modelPlayer = new PlayerModel();
           
         
        }

        //Trae todos los jugadores
        
        function getPlayers() {    

            $sort = $_GET['sort'] ?? null;
            $order = $_GET['orderby'] ?? null;
            $filter = $_GET['filter'] ?? null;
            $page = $_GET['page'] ?? null;
            $limit = $_GET['limit'] ?? null;
           
            try {
                
                //VALIDACIONES URL
                if(!empty($order)){

                    if($order == "DESC" || $order  == "desc" || $order == "ASC" || $order == "asc"){
                    
                    }else{
                    
                        return $this->view->response("OrderBY mal escrito, prueba escribiendo ASC/asc/DESC/desc o revise la documentacion",400);
                    }
                }

                if(!empty($sort)){
                    //Se fija si tiene alguna columna
                    $valueSort = $this->modelPlayer->valueSort($sort);
                    
                    if( $valueSort == 0){
                        //Si el resultado es 0 quiere decir que no tiene ninguna columna con el parametro que ingreso el cliente
                        return $this->view->response("La columna no existe, por favor revise la documentacion",400);
                    }
                }
                if(!empty($filter) && !is_numeric($filter)){
            
                    $this->view->response("No se puede colocar un STRING en el filtrado, revise la documentacion", 400);
                
                }
                if(!empty($limit) && !is_numeric($limit)){

                    return $this->view->response("No se puede colocar un STRING en el limit. Revise la documentacion", 400);
                
                }
            
               //Trae los jugadores por orden , columna y filtrado
               if(!empty($order) && isset($order) && !empty($sort) && isset($sort) && !empty($filter) && isset($filter)){
                          
                    $players = $this->modelPlayer->orderSortedAndFiltered($order,$sort,$filter);
                
                    if (empty($players)){
                        $this->view->response("El arreglo esta VACIO a causa de ingresar ID erroneo en el filtrado, revise la documentacion", 400);
                    }
                }
                    //Ordenado por columna
                    else if (!empty($order) && isset($order) && !empty($sort) && isset($sort)){

                        $players = $this->modelPlayer->sortedAndOrder($sort,$order);

                    }
                        //Filtrado
                        else if (!empty($filter) && isset($filter)) {   

                            $players = $this->modelPlayer->filter($filter);

                            if (empty($players)){
                        
                                $this->view->response("El arreglo esta VACIO a causa de ingresar ID erroneo en el filtrado, revise la documentacion", 400);
                            }
                        }
                            //Paginado
                            else if (isset($page) && (!empty($limit)) && isset($limit)) {
                            
                                if(!empty($page==0) || !is_numeric($page)){
                                
                                    return $this->view->response("Page no puede ser 0 ni un STRING, revise la documentacion",400);
                                }
                            
                                $players = $this->modelPlayer->paginated($page,$limit);
                            
                                if (empty($players)){
                                
                                    $this->view->response("El arreglo esta VACIO a causa de ingresar un ID erroneo", 400);
                                }
                            }
                                else {
                                
                                    $players = $this->modelPlayer->getAllPlayers();
                                
                                } 

                    return $this->view->response($players,200);
               
            }
        
            catch (\Throwable $th) {
                $this->view->response("Error no encontrado, revise la documentacion", 500);
            }
        }
            
        //Trae un jugador especifico
        function getPlayer($params = []){
            try{
                $player = $this->modelPlayer->getPlayer($params[':ID']);

                if(!empty($player)){
                    $this->view->response($player,200);
                }else{
                    $this->view->response('El jugador con el id = '.$params[':ID'].' no existe.',404);
                }
            }
            catch (\Throwable $th) {
                $this->view->response("Error no encontrado, revise la documentacion", 500);
            }
        }
        
        //Elimina un jugador pasandole el id
        function deletePlayer($params = []) {
            try{
                $id = $params[':ID'];
                $player = $this->modelPlayer->getPlayer($id);

                if($player) {
                    $this->modelPlayer->deletePlayer($id);
                    $this->view->response('El jugador con id = '.$id.' ha sido borrado.', 200);
                } 
                else {
                    $this->view->response('El jugador con id = '.$id.' no existe.', 404);
                }
            }
            catch (\Throwable $e) {
                $this->view->response("El jugador contiene comentarios, para poder eliminar el jugador debera eliminar los comentarios", 404);
            }   
        }
        
        //Crea un jugador nuevo
        function createPlayer($params = []) {
            try{
                $body = $this->getData();

                $name = $body->name_player;
                $lastname = $body->lastname;
                $age = $body->age;
                $id_team = $body->id_team;
                $profile = $body->profile_player;
                $position = $body->position;
                $goals = $body->goals;

                if (empty($name) || empty($lastname) || empty($age) || empty($id_team) || empty($profile) || empty($position) || empty($goals)) {
                    $this->view->response("Complete los datos", 400);
                }
                else {
                    $id = $this->modelPlayer->insertPlayer($name,$lastname,$age,$id_team,$profile,$position,$goals);

                    $player = $this->modelPlayer->getPlayer($id);
                    $this->view->response($player, 201);
                }
            }
            catch (\Throwable $e) {
                $this->view->response("Error no encontrado", 500);
            }
        }

        //Modifica un jugador
        function updatePlayer($params = []) {
            try{
                $id = $params[':ID'];
                $player = $this->modelPlayer->getPlayer($id);

                if($player) {
                    $body = $this->getData();
                
                    $name = $body->name_player;
                    $lastname = $body->lastname;
                    $age = $body->age;
                    $id_team = $body->id_team;
                    $profile = $body->profile_player;
                    $position = $body->position;
                    $goals = $body->goals;

                    if (empty($name) || empty($lastname) || empty($age) || empty($id_team) || empty($profile) || empty($position) || empty($goals)) {
                        $this->view->response("Complete los datos", 400);
                    }
                    else{
                        $this->modelPlayer->updatePlayer($id,$name,$lastname,$age,$id_team,$profile,$position,$goals);

                        $this->view->response('El jugador con id='.$id.' ha sido modificado.', 200);
                    }
                } 
                else {
                    $this->view->response('El jugador con id='.$id.' no existe.', 404);
                }
            }
            catch (\Throwable $e) {
                $this->view->response("Error no encontrado, revise la documentacion", 500);
            }
        }

    }