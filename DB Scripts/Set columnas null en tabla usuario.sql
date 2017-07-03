USE petfacepw2;
ALTER TABLE `usuario` CHANGE `telefono` `telefono` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `usuario` CHANGE `Ubicacion` `Ubicacion` VARCHAR(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `usuario` CHANGE `latitud` `latitud` DOUBLE NULL;
ALTER TABLE `usuario` CHANGE `longitud` `longitud` DOUBLE NULL;