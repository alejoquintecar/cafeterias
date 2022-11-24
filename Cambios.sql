--- --- --- Tabla de usuarios --- --- ---
--- Crear tabla
CREATE TABLE `kna_cafeteria`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(60) NOT NULL,
  `apellidos` VARCHAR(60) NOT NULL,
  `user_name` VARCHAR(24) NOT NULL,
  `password` VARCHAR(400) NOT NULL,
  `roles` VARCHAR(30) NOT NULL,
  `estado` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`)
);
ALTER TABLE `users` ADD UNIQUE(`user_name`);
--- Crear registro
INSERT INTO `users` (`id`, `nombres`, `apellidos`, `user_name`, `password`, `roles`, `estado`)
VALUES( NULL, 'Nestor Alejandro', 'Quintero Cardozo', 'adminnestor.quintero', '', 'ADMIN', '1' );
--- --- END Tabla de usuarios --- --- ---


--- --- --- Tabla de usuarios --- --- ---
CREATE TABLE `kna_cafeteria`.`productos`(
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(180) NOT NULL,
  `referencia` VARCHAR(60) NOT NULL,
  `precio` INT NOT NULL,
  `peso` INT NOT NULL,
  `categoria` VARCHAR(120) NOT NULL,
  `stock` INT NOT NULL,
  `fecha_creación` DATE NOT NULL,
  PRIMARY KEY (`id`)
);

--- --- END Tabla de usuarios --- --- ---
