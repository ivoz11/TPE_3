<?php

    require_once 'app/controllers/api.controller.php';
    require_once 'app/models/user.api.model.php';
    require_once 'app/helpers/auth.api.helper.php';

class UserApiController extends ApiController {
        private $model;

        function __construct() {
            parent::__construct();
            $this->model = new UserModel();

        }

        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders(); // Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'
           
            if(empty($basic)) {
                $this->view->response('No envio encabezados de autenticacion.', 401);
                return;
            }

            $basic = explode(" ", $basic); // ["Basic", "base64(usr:pass)"]

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticacion son incorrectos.', 401);
                return;
            }

            $userpass = base64_decode($basic[1]); // usr:pass
            
            $userpass = explode(":", $userpass); // ["usr", "pass"]

            $user = $userpass[0];
            $password = $userpass[1];


            $userData = $this->model->getByUser($user);

                
            if ($userData && password_verify($password, $userData->password)) {

                $token = $this->authHelper->createToken($userData);
                $this->view->response($token,200);
                return;
            } else {
                    $this->view->response('El usuario o contraseña son incorrectos.', 401);
            }
        }
    }