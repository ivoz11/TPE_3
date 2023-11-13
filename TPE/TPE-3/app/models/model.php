<?php

    require_once 'config.php';

    class Model {
        
        protected $db;

        function __construct() {
            $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
        }

        function deploy() {
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END
                --
                -- Estructura de tabla para la tabla `equipos`
                --
                
                CREATE TABLE `equipos` (
                  `id_team` int(11) NOT NULL,
                  `name_team` varchar(45) NOT NULL,
                  `league` varchar(45) NOT NULL,
                  `technical_director` varchar(45) NOT NULL,
                  `cups` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                
                --
                -- Volcado de datos para la tabla `equipos`
                --
                
                INSERT INTO `equipos` (`id_team`, `name_team`, `league`, `technical_director`, `cups`) VALUES
                (1, 'River Plate', 'Argentina', 'Martin Demichelis', 70),
                (3, 'Boca Juniors', 'Argentina', 'Jorge Almiron', 73),
                (4, 'Independiente', 'Argentina', 'Carlos Tevez', 20),
                (6, 'Velez Sarfield', 'Argentina', 'Sebastian Mendez', 16);
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `jugadores`
                --
                
                CREATE TABLE `jugadores` (
                  `id_player` int(11) NOT NULL,
                  `name_player` varchar(45) NOT NULL,
                  `lastname` varchar(45) NOT NULL,
                  `age` int(11) NOT NULL,
                  `id_team` int(11) NOT NULL,
                  `profile_player` varchar(45) NOT NULL,
                  `position` varchar(45) NOT NULL,
                  `goals` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                
                --
                -- Volcado de datos para la tabla `jugadores`
                --
                
                INSERT INTO `jugadores` (`id_player`, `name_player`, `lastname`, `age`, `id_team`, `profile_player`, `position`, `goals`) VALUES
                (1, 'Enzo', 'Perez', 37, 1, 'Diestro', 'Volante', 47),
                (2, 'Edison', 'Cavani', 36, 3, 'Derecho', 'Delantero', 381),
                (3, 'Ivan', 'Marcone', 33, 4, 'Diestro', 'Centrocampista', 3),
                (4, 'Franco', 'Armani', 36, 1, 'Diestro', 'Arquero', 1),
                (6, 'Ramiro', 'Funes Mori', 32, 1, 'Izquierda', 'Defensor', 19),
                (7, 'Dario ', 'Benedetto', 33, 3, 'Diestro', 'Delantero', 164);
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `usuarios`
                --
                
                CREATE TABLE `usuarios` (
                  `id` int(11) NOT NULL,
                  `user` varchar(25) NOT NULL,
                  `password` varchar(250) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                
                --
                -- Volcado de datos para la tabla `usuarios`
                --
                
                INSERT INTO `usuarios` (`id`, `user`, `password`) VALUES
                (1, 'webadmin', '$2y$10$Un..KkCCbwRqySpa2hSqBuIwzEXUu9W5gwTJ7JjvY5/JsqO7GnFW.');
                
                --
                -- Índices para tablas volcadas
                --
                
                --
                -- Indices de la tabla `equipos`
                --
                ALTER TABLE `equipos`
                  ADD PRIMARY KEY (`id_team`);
                
                --
                -- Indices de la tabla `jugadores`
                --
                ALTER TABLE `jugadores`
                  ADD PRIMARY KEY (`id_player`),
                  ADD KEY `FK_jugadores_equipos` (`id_team`);
                
                --
                -- Indices de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                  ADD PRIMARY KEY (`id`);
                
                --
                -- AUTO_INCREMENT de las tablas volcadas
                --
                
                --
                -- AUTO_INCREMENT de la tabla `equipos`
                --
                ALTER TABLE `equipos`
                  MODIFY `id_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
                
                --
                -- AUTO_INCREMENT de la tabla `jugadores`
                --
                ALTER TABLE `jugadores`
                  MODIFY `id_player` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
                
                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
                
                --
                -- Restricciones para tablas volcadas
                --
                
                --
                -- Filtros para la tabla `jugadores`
                --
                ALTER TABLE `jugadores`
                  ADD CONSTRAINT `FK_jugadores_equipos` FOREIGN KEY (`id_team`) REFERENCES `equipos` (`id_team`);
                COMMIT;
                
                END;
                $this->db->query($sql);
            }
            
        }
    }
