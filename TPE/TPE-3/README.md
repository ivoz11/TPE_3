Hola bienvenidos a la documentacion de nuestra API. Creada por Iván Zárate y Valentín Fonseca, para la materia WEB 2 de la carrera TUDAI.


## Se recomienda usar POSTMAN para que sea mas facil de utilizar y manipular la API.

El ENDPOINT es: ` http://localhost/TPE/TPE-3/api/ `


## TABLA JUGADORES:

# METODO POST:
 `$router->addRoute('players','POST','PlayerApiController','createPlayer');`
 `http://localhost/TPE/TPE-3/api/players`

 Para insertar un nuevo jugador se utiliza el formato JSON de la siguiente manera:
 
 {
 "name_player": "Manuel",
 "lastname": "Lanzini",
 "age": 30,
 "id_team": 1,
 "profile_player": "Diestro",
 "position": "Enganche",
 "goals": 58,
 }
 
 Los id_team disponibles son los siguientes: (Se debe poner el numero de id del equipo que quieras seleccionar para el jugador)
 - River Plate: 1
 - Boca Juniors: 3
 - Independiente: 4
 - Santamarina: 6
 
 Si el id_team es incorrecto se informara un Error.

# METODO PUT:
 `$router->addRoute('players/:ID','PUT','PlayerApiController','updatePlayer');`
 `http://localhost/TPE/TPE-3/api/players/1`

 Sirve para modificar un jugador, se debe poner la id del jugador a modificar en la URL y utilizar tambien el formato JSON de la siguiente manera:

 {
 "name_player": "Manuel",
 "lastname": "Lanzini",
 "age": 30,
 "id_team": 1,
 "profile_player": "Diestro",
 "position": "Enganche",
 "goals": 58,
 }

 Los id_team disponibles son los siguientes: (Se debe poner el numero de id del equipo que quieras seleccionar para el jugador)
 - River Plate: 1
 - Boca Juniors: 3
 - Independiente: 4
 - Santamarina: 6
 
 Si el id_team es incorrecto se informara un Error.

# METODO DELETE:
 `$router->addRoute('players/:ID','DELETE','PlayerApiController','deletePlayer');`
 `http://localhost/TPE/TPE-3/api/players/12`
 
 Para eliminar un jugador se debe seguir la URL de arriba, poniendo la ID del jugador que queremos eliminar. Hay que tener en cuenta que el jugador a eliminar no debe tener comentarios puestos si no primero va a tener que eliminar los comentarios del mismo, para luego poder eliminarlo. Si el jugador tiene comentarios le saldra un aviso de ese respectivo error.

# METODO GET por ID.
 `$router->addRoute('players/:ID','GET','PlayerApiController','getPlayer');`
 `http://localhost/TPE/TPE-3/api/players/1`
 
 Si nosotros queremos traer un jugador por su respectiva ID tenemos que seguir la idea de la URL de arriba. Hay que estar seguros que la ID exista, si no saldra su respectivo aviso.

# METODO GETALL con sus parametros: `$router->addRoute('players','GET','PlayerApiController','getPlayers');`
 # Parametros:
  - orderby = ASC o DESC.
  - sort = Columna existente. id_player, name_player, lastname, age, id_team, profile_player, position, goals.	
  - filter: Filtrado por id_team, los id_team son los siguientes: 
    |River Plate: 1
    |Boca Juniors: 3
    |Independiente: 4
    |Santamarina: 6
  - page, limit: Cantidad para omitir y mostrar, tienen que pasar INT por parametros, nunca un string, ni 0 en el parametro page.

 🛑🛑 EJEMPLOS de getALL 🛑🛑
 
  `http://localhost/TPE/TPE-3/api/players` Este es el getALL basico para traer todos los jugadores de la tabla.
  
  `http://localhost/TPE/TPE-3/api/players?orderby=ASC&sort=goals&filter=1` Ordeno de manera ASC(ascendente), por la columna goals y filtrando por el equipo con id_team = 1 (River Plate).
  
  `http://localhost/TPE/TPE-3/api/players?orderby=DESC&sort=name_player` Jugadores mostrados por orden DESC y por alguna columna, en este caso name_player.
  
  `http://localhost/TPE/TPE-3/api/players?filter=4` filtrado de los jugadores por la id_team, en este caso nos va a traer los jugadores con id_team = 4 (Independiente).

  `http://localhost/TPE/TPE-3/api/players?page=1&limit=3` Paginado de la tabla de jugadores.

## TABLA COMENTARIOS:

# METODO POST:
 `$router->addRoute('players/:ID/comments','POST','CommentApiController','createComment');`
 `http://localhost/TPE/TPE-3/api/players/8/comments`

 Al querer hacer un comentario en un jugador, necesitamos traer la ID del jugador y hacer el POST en formato JSON de la siguiente manera:

 {
 "comment": "Enzo quedate toda la vida",
 "id_player": 8
 }

 Las id_player disponibles son:
 
  - Enzo Perez : 1
  - Edison Cavani : 2
  - Ivan Marcone : 3
  - Franco Armani : 4
  - Ramiro Funes Mori : 6
  - Enzo Fernandez : 8
  - Dario Benedetto : 9
  - Frank Fabra : 10
  - Alexis Canelo : 11
  - Rodrigo Marquez : 12

# Metodo DELETE
 `$router->addRoute('players/:ID/comments/:commentID','DELETE','CommentApiController','deleteComment');`
 `http://localhost/TPE/TPE-3/api/players/1/comments/9`
 
 Para eliminar un comentario tengo que poner la ID del jugador, con la ID del comentario a eliminar, como en el ejemplo mostrado.
 
# Metodo GET - Traer un comentario por ID.
 `$router->addRoute('comments/:ID','GET','CommentApiController', 'get');`
 `http://localhost/TPE/TPE-3/api/comments/1`
 
 Pongo la ID del comentario a traer. Si no existe un comentario con esa ID sera informado.

## Metodo GET - Para traer todos los comentarios de un jugador.
 `$router->addRoute('players/:ID/comments','GET','CommentApiController', 'getPlayerComments');`
 `http://localhost/TPE/TPE-3/api/players/2/comments`
 
 Traigo todos los comentarios de un jugador poniendo la ID del mismo, si ese jugador no tiene comentarios será informado.

## Metodo GET - Para traer todos los comentarios de todos los jugadores.
 `$router->addRoute('comments','GET','CommentApiController','get');`
 `http://localhost/TPE/TPE-3/api/comments`


## TABLA EQUIPOS:

# METODO POST:
 `$router->addRoute('teams','POST','TeamApiController','createTeam');`
 ` http://localhost/TPE/TPE-3/api/teams`

 Para insertar un nuevo equipo se utiliza el formato JSON de la siguiente manera:

 {
 "name_team": "Argentinos Juniors",
 "league": "Argentina",
 "technical_director": "Pablo Guede",
 "cups": 5
 }

# METODO PUT:
 `$router->addRoute('teams/:ID','PUT','TeamApiController','updateTeam');`
 `http://localhost/TPE/TPE-3/api/teams/1`

 Sirve para modificar un equipo, se debe poner la id del equipo a modificar en la URL y utilizar tambien el formato JSON de la siguiente manera:

 {
 "name_team": "River Plate",
 "league": "Argentina",
 "technical_director": "Martin Demichelis",
 "cups": 70
 }

# METODO DELETE:
 `$router->addRoute('teams/:ID','DELETE','TeamApiController','deleteTeam');`
 `http://localhost/TPE/TPE-3/api/teams/6`

 Para eliminar un equipo se debe seguir la URL de arriba, poniendo la ID del equipo que queremos eliminar. Hay que tener en cuenta que el equipo a eliminar no debe tener estar asignado en ningun jugador, si no primero va a tener que asignarle otro equipo a los jugadores, para luego poder eliminarlo. Si el equipo esta asignado en algun jugador saldra su respectivo error.

 # METODO GET por ID.
 `$router->addRoute('teams/:ID','GET','TeamApiController','getTeam');`
 `http://localhost/TPE/TPE-3/api/teams/1`
 
 Si nosotros queremos traer un equipo por su respectiva ID tenemos que seguir la idea de la URL de arriba. Hay que estar seguros que la ID exista, si no saldra su respectivo aviso.

## Metodo GET - Para taer todos los equipos.
 `$router->addRoute('teams','GET','TeamApiController','getTeams');`
 `http://localhost/TPE/TPE-3/api/teams`

 Este metodo nos sirve para traer todos los equipos.




