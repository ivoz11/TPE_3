<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/models/team.api.model.php';

    class TeamApiController extends ApiController{

        private $modelTeam;
        

        public function __construct(){
            parent::__construct();
            $this->modelTeam = new TeamModel();
         
        }

        //Trae todos los equipos
        
        function getTeams() {    

            try{    
                
                $teams = $this->modelTeam->getAllTeams();
                return $this->view->response($teams,200);
               
            }
            catch (\Throwable $th) {
                $this->view->response("Error no encontrado, revise la documentacion", 500);
            }
        }
            
        //Trae un equipo especifico
        function getTeam($params = []){
            try{
                $team = $this->modelTeam->getTeam($params[':ID']);

                if(!empty($team)){
                    $this->view->response($team,200);
                }else{
                    $this->view->response('El equipo con el id = '.$params[':ID'].' no existe.',404);
                }
            }
            catch (\Throwable $th) {
                $this->view->response("Error no encontrado, revise la documentacion", 500);
            }
        }
        
        //Elimina un equipo pasandole el id
        function deleteTeam($params = []) {
            try{
                $user = $this->authHelper->currentUser();
                if(!$user) {
                    $this->view->response('Unauthorized', 401);
                    return;
                }

                $id = $params[':ID'];
                $team = $this->modelTeam->getTeam($id);

                if($team) {
                    $this->modelTeam->deleteTeam($id);
                    $this->view->response('El equipo con id = '.$id.' ha sido borrado.', 200);
                } 
                else {
                    $this->view->response('El equipo con id = '.$id.' no existe.', 404);
                }
            }
            catch (\Throwable $e) {
                $this->view->response("El Equipo esta asignado a un jugador/res, para poder eliminar el equipo debera cambiarle el mismo a los jugadores", 404);
            }   
        }
        
        //Crea un equipo nuevo
        function createTeam($params = []) {
            try{
                $user = $this->authHelper->currentUser();
                if(!$user) {
                    $this->view->response('Unauthorized', 401);
                    return;
                }

                $body = $this->getData();

                $name = $body->name_team;
                $league = $body->league;
                $technical_director = $body->technical_director;
                $cups = $body->cups;

                if (empty($name) || empty($league) || empty($technical_director) || empty($cups)) {
                    $this->view->response("Complete los datos", 400);
                }
                else {
                    $id = $this->modelTeam->insertTeam($name,$league,$technical_director,$cups);

                    $team = $this->modelTeam->getTeam($id);
                    $this->view->response($team, 201);
                }
            }
            catch (\Throwable $e) {
                $this->view->response("Error no encontrado", 500);
            }
        }

        //Modifica un equipo
        function updateTeam($params = []) {
            try{
                $user = $this->authHelper->currentUser();
                if(!$user) {
                    $this->view->response('Unauthorized', 401);
                    return;
                }

                $id = $params[':ID'];
                $team = $this->modelTeam->getTeam($id);

                if($team) {
                    $body = $this->getData();
                
                    $name = $body->name_team;
                    $league = $body->league;
                    $technical_director = $body->technical_director;
                    $cups = $body->cups;

                    if (empty($name) || empty($league) || empty($technical_director) || empty($cups)) {
                        $this->view->response("Complete los datos", 400);
                    }
                    else{
                        $this->modelTeam->updateTeam($id,$name,$league,$technical_director,$cups);

                        $this->view->response('El equipo con id='.$id.' ha sido modificado.', 200);
                    }
                } 
                else {
                    $this->view->response('La equipo con id='.$id.' no existe.', 404);
                }
            }
            catch (\Throwable $e) {
                $this->view->response("Error no encontrado, revise la documentacion", 500);
            }
        }

    }