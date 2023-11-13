<?php
    require_once 'config.php';
    
    require_once 'libs/router.php';

    require_once 'app/controllers/player.api.controller.php';
    require_once 'app/controllers/comment.api.controller.php';
    require_once 'app/controllers/team.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
   


    //Se crea el router
    $router = new Router();

    // Jugadores
    //                 endpoint      verbo         controller          metodo
    $router->addRoute('players',     'GET',    'PlayerApiController','getPlayers');
    $router->addRoute('players',     'POST',   'PlayerApiController', 'createPlayer');
    $router->addRoute('players/:ID', 'GET',    'PlayerApiController','getPlayer');
    $router->addRoute('players/:ID', 'DELETE', 'PlayerApiController', 'deletePlayer');
    $router->addRoute('players/:ID', 'PUT',    'PlayerApiController', 'updatePlayer');

    // Comentarios
    //                 endpoint                         verbo        controller          metodo
    $router->addRoute('comments',                       'GET',   'CommentApiController', 'get');    
    $router->addRoute('comments/:ID',                   'GET',   'CommentApiController', 'get');
    $router->addRoute('players/:ID/comments',           'GET',   'CommentApiController', 'getPlayerComments');
    $router->addRoute('players/:ID/comments',           'POST',  'CommentApiController', 'createComment');
    $router->addRoute('players/:ID/comments/:commentID','DELETE','CommentApiController', 'deleteComment');    

     // Equipos
    //                 endpoint     verbo        controller        metodo
    $router->addRoute('teams',     'GET',    'TeamApiController','getTeams');
    $router->addRoute('teams',     'POST',   'TeamApiController', 'createTeam');
    $router->addRoute('teams/:ID', 'GET',    'TeamApiController','getTeam');
    $router->addRoute('teams/:ID', 'DELETE', 'TeamApiController', 'deleteTeam');
    $router->addRoute('teams/:ID', 'PUT',    'TeamApiController', 'updateTeam');

    //Token
    //                 endpoint     verbo        controller         metodo
    $router->addRoute('user/token', 'GET',    'UserApiController', 'getToken');

    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);