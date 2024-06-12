/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.4.32-MariaDB : Database - sistema_medidores
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sistema_medidores` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `sistema_medidores`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`cliente_id`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`cliente_id`,`cedula`,`nombre`,`apellido`,`direccion`,`telefono`,`email`,`fecha_registro`) values (1,'0939834034','Daniel','Foyain','10 de Agosto','09306223456','ejemplo@gmail.com','2024-06-11');

/*Table structure for table `lecturas` */

DROP TABLE IF EXISTS `lecturas`;

CREATE TABLE `lecturas` (
  `lectura_id` int(11) NOT NULL AUTO_INCREMENT,
  `medidor_id` int(11) NOT NULL,
  `fecha_lectura` date NOT NULL,
  `lectura_anterior` int(11) DEFAULT 0,
  `lectura_actual` int(11) NOT NULL,
  `consumo` int(11) GENERATED ALWAYS AS (`lectura_actual` - `lectura_anterior`) STORED,
  PRIMARY KEY (`lectura_id`),
  KEY `medidor_id` (`medidor_id`),
  CONSTRAINT `lecturas_ibfk_1` FOREIGN KEY (`medidor_id`) REFERENCES `medidores` (`medidor_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `lecturas` */

/*Table structure for table `medidores` */

DROP TABLE IF EXISTS `medidores`;

CREATE TABLE `medidores` (
  `medidor_id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_medidor` varchar(20) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  PRIMARY KEY (`medidor_id`),
  UNIQUE KEY `numero_medidor` (`numero_medidor`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `medidores_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `medidores` */

/* Trigger structure for table `lecturas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `before_insert_lectura` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `before_insert_lectura` BEFORE INSERT ON `lecturas` FOR EACH ROW BEGIN
    DECLARE ultimo_valor INT;
    -- Obtener la lectura_actual anterior del mismo medidor
    SELECT lectura_actual INTO ultimo_valor
    FROM Lecturas
    WHERE medidor_id = NEW.medidor_id
    ORDER BY fecha_lectura DESC
    LIMIT 1;
    -- Asignar la lectura anterior al nuevo registro
    SET NEW.lectura_anterior = IFNULL(ultimo_valor, 0);
END */$$


DELIMITER ;

/* Procedure structure for procedure `registrar_lectura` */

/*!50003 DROP PROCEDURE IF EXISTS  `registrar_lectura` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_lectura`(
    IN p_medidor_id INT,
    IN p_lectura_actual INT,
    IN p_fecha_lectura DATE
)
BEGIN
    DECLARE p_lectura_anterior INT DEFAULT 0;
    DECLARE p_consumo INT;
    -- Obtener la última lectura_actual para el medidor
    SELECT lectura_actual INTO p_lectura_anterior
    FROM Lecturas
    WHERE medidor_id = p_medidor_id
    ORDER BY fecha_lectura DESC
    LIMIT 1;
    -- Calcular el consumo
    SET p_consumo = p_lectura_actual - IFNULL(p_lectura_anterior, 0);
    -- Insertar la nueva lectura
    INSERT INTO Lecturas (medidor_id, fecha_lectura, lectura_anterior, lectura_actual, consumo)
    VALUES (p_medidor_id, p_fecha_lectura, p_lectura_anterior, p_lectura_actual, p_consumo);
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
