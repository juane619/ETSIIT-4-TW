/* Database export results for db juane6191819 */

/* Preserve session variables */
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS=0;

/* Export data */

drop table if exists `comentarios`;

/* Table structure for comentarios */
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incidencia` int(11) NOT NULL,
  `usuario` int(11) NOT NULL DEFAULT '6',
  `comentario` varchar(300) DEFAULT NULL,
  `hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_comentarios_usuario_idx` (`usuario`),
  KEY `fk_comentarios_incidencia_idx` (`incidencia`),
  CONSTRAINT `fk_comentarios_incidencia` FOREIGN KEY (`incidencia`) REFERENCES `incidencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_comentarios_usuario` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table comentarios */

drop table if exists `incidencias`;

/* Table structure for incidencias */
CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tabla sobre incidencias',
  `titulo` varchar(75) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `tags` varchar(45) DEFAULT NULL,
  `fotos` varchar(45) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('Pendiente de comprobacion','Comprobada','Tramitada','Irresoluble','Resuelta') NOT NULL DEFAULT 'Pendiente de comprobacion',
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_incidencias_usuario_idx` (`usuario`),
  CONSTRAINT `fk_incidencias_usuario` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table incidencias */

drop table if exists `users`;

/* Table structure for users */
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf8 NOT NULL,
  `password` varbinary(255) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `foto` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT '1',
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT 'activo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table users */
INSERT INTO `users` VALUES (NULL,"admin","¸&‰FDg‰;Kô:÷»ç’ê","juan emilio","garcia martinez","c santa clara","958669490","admin@hotmail.com",NULL,0,"activo");
INSERT INTO `users` VALUES (NULL,"anonimous","","anonimous","anonimous","anonimous","","",NULL,2,"activo");
INSERT INTO `users` VALUES (NULL,"juane","¸&‰FDg‰;Kô:÷»ç’ê",NULL,NULL,NULL,NULL,"juane@hotmail.com",NULL,1,"acrivo");

drop table if exists `valoraciones`;

/* Table structure for valoraciones */
CREATE TABLE `valoraciones` (
  `id_valoracion` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `valoracion_pos` int(11) DEFAULT '0',
  `valoracion_neg` int(11) DEFAULT '0',
  `usuario` int(11) NOT NULL,
  `incidencia` int(11) NOT NULL,
  PRIMARY KEY (`id_valoracion`),
  UNIQUE KEY `uk_user_incidencia` (`usuario`,`incidencia`),
  KEY `fk_valoraciones_usuarios_idx` (`usuario`),
  KEY `fk_valoraciones_incidencia_idx` (`incidencia`),
  CONSTRAINT `fk_valoraciones_incidencia` FOREIGN KEY (`incidencia`) REFERENCES `incidencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_valoraciones_usuarios` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/* data for Table valoraciones */

/* Restore session variables to original values */
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
