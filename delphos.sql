/*
SQLyog Ultimate v8.61 
MySQL - 5.5.16 : Database - sidcad1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sidcad1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sidcad1`;

/*Table structure for table `administrador` */

DROP TABLE IF EXISTS `administrador`;

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` varchar(45) DEFAULT NULL,
  `pass_admin` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `administrador` */

insert  into `administrador`(`id`,`id_admin`,`pass_admin`) values (1,'admin','admin');

/*Table structure for table `comprobante` */

DROP TABLE IF EXISTS `comprobante`;

CREATE TABLE `comprobante` (
  `correlativo` int(11) NOT NULL,
  `iddocumento` int(11) NOT NULL,
  `tipo_comprobante` varchar(45) DEFAULT NULL,
  `glosa_comprobante` varchar(45) DEFAULT NULL,
  `factura_id` int(11) NOT NULL,
  `fecha_comprobante` date DEFAULT NULL,
  PRIMARY KEY (`correlativo`),
  KEY `fk_Comprobante_Documento1` (`iddocumento`),
  KEY `fk_comprobante_factura1` (`factura_id`),
  CONSTRAINT `fk_Comprobante_Documento1` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobante_factura1` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `comprobante` */

/*Table structure for table `documento` */

DROP TABLE IF EXISTS `documento`;

CREATE TABLE `documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_recep` date DEFAULT NULL,
  `nombre_documento` varchar(45) DEFAULT NULL,
  `nombre_archivo` varchar(100) DEFAULT NULL,
  `idempresa` int(11) NOT NULL,
  `tipo_documento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Documento_Empresa1` (`idempresa`),
  CONSTRAINT `fk_Documento_Empresa1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

/*Data for the table `documento` */

insert  into `documento`(`id`,`fecha_recep`,`nombre_documento`,`nombre_archivo`,`idempresa`,`tipo_documento`) values (1,'2012-04-06','pba waaa','csi_facturas_pba_waaa_2012-04-06_74006.pdf',1,NULL),(2,'2012-04-06','waaaaaa loko','csi_facturas_waaaaaa_loko_2012-04-06_99801.pdf',1,NULL),(3,'2012-04-06','waaaaaa loko222','csi_facturas_waaaaaa_loko222_2012-04-06_46351.pdf',1,NULL),(4,'2012-04-06','waaaaaa loko2223333','csi_facturas_waaaaaa_loko2223333_2012-04-06_97517.pdf',1,NULL),(5,'2012-04-06','waaaaaa loko2223333','csi_facturas_waaaaaa_loko2223333_2012-04-06_40334.pdf',1,NULL),(7,'2012-04-06','waaaaaa loko22233335555666','csi_facturas_waaaaaa_loko22233335555666_2012-04-06_12381.pdf',1,NULL),(8,'2012-04-07','pba','Comercial_San_Ignacio_facturas_pba_2012-04-07_58471.pdf',1,NULL),(9,'2012-04-09','factura a BD','archivo.png',3,'factura'),(10,'2012-04-10','factura a bd2','src_facturas_factura_a_bd2_2012-04-10_43964.pdf',3,''),(11,'2012-04-09','pba gabriel','csi_facturas_pba_gabriel_2012-04-09_58381.pdf',1,''),(12,'2012-04-09','pba el regreso','csi_facturas_pba_el_regreso_2012-04-09_96017.pdf',1,''),(13,'2012-04-10','pba con email','__pba_con_email_2012-04-10_31724.pdf',2,'otros'),(14,'2012-04-10','pba con emial de gmail','__pba_con_emial_de_gmail_2012-04-10_73486.pdf',2,'otros'),(15,'2012-04-10','pba con sesion y weas raras llala','__pba_con_sesion_y_weas_raras_llala_2012-04-10_85458.pdf',2,'otros'),(16,'2012-04-10','pba del panamericano','pnm__pba_del_panamericano_2012-04-10_18983.pdf',4,'otros'),(17,'2012-04-10','pba del panamericano reloaded','pnm__pba_del_panamericano_reloaded_2012-04-10_71529.pdf',4,'otros'),(18,'2012-04-10','lalallaldajkdfjkadklsfjkasdfnkjasd','pnm__lalallaldajkdfjkadklsfjkasdfnkjasd_2012-04-10_63818.pdf',4,'otros'),(19,'2012-04-10','el pico','pnm__el_pico_2012-04-10_21653.pdf',4,'otros'),(20,'2012-04-10','ahhhh nada funciona','pnm__ahhhh_nada_funciona_2012-04-10_83473.pdf',4,'otros'),(21,'2012-04-10','el diablo','csi_facturas_el_diablo_2012-04-10_28609.pdf',1,''),(22,'2012-04-10','el que sabe','pnm_otros_el_que_sabe_2012-04-10_91863.pdf',4,'otros'),(23,'2012-04-10','pba del cristian','src_facturas_pba_del_cristian_2012-04-10_09398.pdf',3,''),(24,'2012-04-10','lalala','sac_facturas_lalala_2012-04-10_53431.pdf',2,''),(25,'2012-04-10','factura de pba 1','pba1.pdf',2,'facturas'),(26,'2012-04-10','factura de pba 2','pba2.pdf',1,'facturas'),(27,'2012-04-10','factura de pba 3','pba3.pdf',3,'facturas'),(28,'2012-04-10','factura de pba 4','pba4.pdf',1,'facturas'),(29,'2012-04-12',NULL,NULL,1,'factura'),(30,'2012-04-12',NULL,NULL,1,'factura'),(31,'2012-04-12',NULL,NULL,1,'factura'),(33,'2012-04-12',NULL,NULL,1,'factura'),(34,'2012-04-12',NULL,NULL,1,'factura'),(35,'2012-04-12',NULL,NULL,1,'factura'),(36,'2012-04-12',NULL,NULL,1,'factura'),(37,'2012-04-12',NULL,NULL,1,'factura'),(38,'2012-04-12',NULL,NULL,1,'factura'),(39,'2012-04-12',NULL,NULL,2,'factura'),(40,'2012-04-12',NULL,NULL,2,'factura'),(41,'2012-04-12',NULL,NULL,2,'factura'),(42,'2012-04-12',NULL,NULL,1,'factura'),(43,'2012-04-12',NULL,NULL,1,'factura'),(44,'2012-04-12',NULL,NULL,1,'factura'),(45,'2012-04-12',NULL,NULL,1,'factura'),(46,'2012-04-12',NULL,NULL,1,'factura'),(47,'2012-04-12',NULL,NULL,1,'nota'),(48,'2012-04-12',NULL,NULL,3,'nota'),(49,'2012-04-12',NULL,NULL,1,'factura'),(50,'2012-04-12',NULL,NULL,1,'factura'),(51,'2012-04-12',NULL,NULL,1,'nota'),(52,'2012-04-12',NULL,NULL,1,'nota'),(53,'2012-04-12',NULL,NULL,2,'nota'),(54,'2012-04-13','pico pal que lee','csi_factura_pico_pal_que_lee_2012-04-13_20887.pdf',1,'factura'),(55,'2012-04-13','pico pal que lee1','sac_nota_pico_pal_que_lee1_2012-04-13_38539.pdf',2,'nota'),(56,'2012-04-13','pico pal que lee2','src_nota_pico_pal_que_lee2_2012-04-13_17924.pdf',3,'nota'),(57,'2012-04-15',NULL,NULL,1,'factura'),(58,'2012-04-15','perico los paltes','src_factura_perico_los_paltes_2012-04-15_60934.pdf',3,'factura'),(59,'2012-04-15','prico plates','sac_factura_prico_plates_2012-04-15_09539.pdf',2,'factura'),(60,'2012-04-16','pba lalala lalal','csi_nota_pba_lalala_lalal_2012-04-16_33361.pdf',1,'nota'),(61,'2012-04-16',NULL,NULL,3,'factura'),(62,'2012-04-16','pba gabriel','src_nota_pba_gabriel_2012-04-16_04928.pdf',3,'nota'),(63,'2012-04-13','hola','sac_factura_hola_2012-04-13_82989.pdf',2,'factura'),(64,'2012-04-16','pba mafo1','src_nota_pba_mafo1_2012-04-16_99372.pdf',3,'nota'),(65,'2012-04-16','pba mafo','src_nota_pba_mafo_2012-04-16_19796.pdf',3,'nota'),(66,'2012-04-16',NULL,NULL,2,'factura'),(67,'2012-04-16',NULL,NULL,1,'nota'),(68,NULL,NULL,NULL,1,'factura'),(69,NULL,'otrapruebamas','csi_factura_otrapruebamas__71065.pdf',1,'factura'),(70,NULL,NULL,NULL,1,'factura'),(71,NULL,NULL,NULL,1,'factura'),(72,NULL,NULL,NULL,1,'factura'),(73,NULL,NULL,NULL,1,'factura');

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `rut_empleado` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `departamento` varchar(45) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `idperfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Empleado_perfil1` (`idperfil`),
  CONSTRAINT `fk_Empleado_perfil1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `empleado` */

insert  into `empleado`(`id`,`nombres`,`apellidos`,`rut_empleado`,`correo`,`departamento`,`cargo`,`username`,`password`,`idperfil`) values (1,'Gabriel Francisco','Poblete Cuadra','16839237-0','poblete.cuadra@live.cl','partes','secretario','gpc','03012005',1),(3,'Cristian Andres','Ortiz Navia','15030630-8','cristian.ortiz@alumnos.uda.cl','contabilidad','Contador','cortiz','cortiz',2),(7,'Waldemar','Ardiles','16839237-0','waldemar@live.cl','partes','goma','walde','walde',1),(8,'Natalia','Munoz','16839237-0','natalia@live.cl','contabilidad','contadora','natalia','1234',1),(9,'Julio','Poblete','16839237-0','julio@live.cl','tesoreria','tesorero','julio','poblete',1),(10,'Pilar','Cuadra','16839237-0','pilar@live.cl','partes','secretaria','pilar','pili',1),(11,'Maria Isabel','Castillo Rojas','17456890-1','maria.castillo@live.cl','archivo','Encargada Archivos','maria','maria',2);

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(45) DEFAULT NULL,
  `rut_empresa` varchar(45) DEFAULT NULL,
  `rubro_empresa` varchar(45) DEFAULT NULL,
  `descripcion_empresa` varchar(250) DEFAULT NULL,
  `sigla_empresa` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `empresa` */

insert  into `empresa`(`id`,`nombre_empresa`,`rut_empresa`,`rubro_empresa`,`descripcion_empresa`,`sigla_empresa`) values (1,'Comercial San Ignacio','0000-0',NULL,NULL,'csi'),(2,'Sociedad Administrativa Contable','0000-1',NULL,NULL,'sac'),(3,'Sociedad Rent a Car','0000-2',NULL,NULL,'src'),(4,'Sociedad Panamerica','0000-3','I','Restaurant con harta pechuga..','pnm');

/*Table structure for table `factura` */

DROP TABLE IF EXISTS `factura`;

CREATE TABLE `factura` (
  `numero_factura` int(11) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `iddocumento` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_factura` varchar(45) DEFAULT NULL,
  `correlativo_manager` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_Factura_Proveedor1` (`idproveedor`),
  KEY `fk_Factura_Documento` (`iddocumento`),
  CONSTRAINT `fk_Factura_Documento` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Proveedor1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Data for the table `factura` */

insert  into `factura`(`numero_factura`,`fecha_emision`,`iddocumento`,`idproveedor`,`id`,`tipo_factura`,`correlativo_manager`) values (1,'2012-04-13',54,5,37,'compra','4849'),(2,'2012-04-13',55,4,38,'debito','4850'),(3,'2012-04-13',56,3,39,'credito','4851'),(4,'2012-04-15',57,2,40,'compra','234'),(5,'2012-04-15',58,1,41,'compra','4850'),(6,'2012-04-13',59,1,42,'compra','4852'),(7,'2012-04-16',60,5,43,'credito','4853'),(8,'2012-04-16',61,5,44,'compra',NULL),(9,'2012-04-16',62,2,45,'debito','4854'),(10,'2012-04-09',63,5,46,'compra','788'),(11,'2012-04-16',64,1,47,'debito','4855'),(12,'2012-04-16',65,1,48,'credito','4856'),(13,'2012-04-16',66,2,49,'compra',NULL),(14,'2012-04-16',67,3,50,'debito',NULL),(15,'2012-04-16',68,3,51,'venta','4856'),(16,'2012-04-16',69,1,52,'venta','4857'),(17,'2012-04-16',70,1,53,'venta','4858'),(19,'2012-04-16',71,3,54,'venta','4859'),(20,'2012-04-16',72,3,55,'venta','4860'),(21,'2012-04-16',73,1,56,'venta','4861');

/*Table structure for table `historial_documento` */

DROP TABLE IF EXISTS `historial_documento`;

CREATE TABLE `historial_documento` (
  `fecha_envio` datetime NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `depto_origen` varchar(45) DEFAULT NULL,
  `depto_destino` varchar(45) DEFAULT NULL,
  `emp_origen` int(11) DEFAULT NULL,
  `emp_destino` int(11) DEFAULT NULL,
  `documento_id` int(11) NOT NULL,
  KEY `fk_historial_documento_documento1` (`documento_id`),
  KEY `FK_historial_emp2` (`emp_origen`),
  CONSTRAINT `FK_historial_emp2` FOREIGN KEY (`emp_origen`) REFERENCES `empleado` (`id`),
  CONSTRAINT `fk_historial_documento_documento1` FOREIGN KEY (`documento_id`) REFERENCES `documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_historial_emp` FOREIGN KEY (`emp_origen`) REFERENCES `empleado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `historial_documento` */

insert  into `historial_documento`(`fecha_envio`,`estado`,`depto_origen`,`depto_destino`,`emp_origen`,`emp_destino`,`documento_id`) values ('2012-04-13 00:00:00','procesado','partes','tesoreria',1,9,54),('2012-04-15 00:00:00','procesado','partes','tesoreria',1,9,55),('2012-04-15 00:00:00','procesado','partes','tesoreria',1,9,56),('2012-04-15 00:00:00','procesado','partes','tesoreria',1,9,57),('2012-04-15 00:00:00','procesado','partes','tesoreria',1,9,58),('2012-04-15 00:00:00','procesado','partes','tesoreria',1,9,59),('2012-04-15 00:00:00','procesado','tesoreria','archivo',9,11,56),('2012-04-15 00:00:00','archivado','tesoreria','archivo',9,11,55),('2012-04-15 00:00:00','procesado','tesoreria','archivo',9,11,54),('2012-04-16 00:00:00','procesado','archivo','contabilidad',11,8,54),('2012-04-16 00:00:00','procesado','tesoreria','archivo',9,11,58),('2012-04-16 00:00:00','enviado','archivo','contabilidad',11,8,58),('2012-04-16 00:00:00','procesado','tesoreria','archivo',9,11,59),('2012-04-16 00:00:00','enviado','archivo','contabilidad',11,8,59),('2012-04-16 00:00:00','procesado','partes','tesoreria',1,9,60),('2012-04-16 00:00:00','procesado','tesoreria','archivo',9,11,60),('2012-04-16 00:00:00','procesado','archivo','contabilidad',11,8,60),('0000-00-00 00:00:00','cola','partes',NULL,1,NULL,61),('2012-04-16 00:00:00','procesado','partes','tesoreria',1,9,62),('2012-04-16 00:00:00','procesado','partes','tesoreria',1,9,63),('2012-04-16 00:00:00','procesado','tesoreria','archivo',9,11,63),('2012-04-16 00:00:00','enviado','archivo','contabilidad',11,8,63),('2012-04-16 00:00:00','procesado','archivo','contabilidad',11,8,56),('2012-04-16 00:00:00','enviado','tesoreria','default',9,0,57),('2012-04-16 00:00:00','procesado','partes','tesoreria',1,9,64),('2012-04-16 00:00:00','procesado','partes','tesoreria',1,9,65),('2012-04-16 00:00:00','enviado','partes','tesoreria',1,9,66),('2012-04-16 00:00:00','enviado','partes','tesoreria',1,9,67),('2012-04-16 00:00:00','procesado','tesoreria','archivo',9,11,64),('2012-04-16 00:00:00','procesado','tesoreria','archivo',9,11,65),('2012-04-16 00:00:00','archivado','tesoreria','archivo',9,11,62),('2012-04-16 00:00:00','procesado','archivo','contabilidad',11,8,64),('2012-04-16 00:00:00','enviado','archivo','contabilidad',11,8,65),('2012-04-16 00:00:00','archivado','contabilidad','archivo',8,11,54),('2012-04-16 00:00:00','archivado','contabilidad','archivo',8,11,60),('2012-04-16 00:00:00','archivado','contabilidad','archivo',8,11,64),('2012-04-16 00:00:00','enviado','contabilidad','archivo',8,11,56),('2012-04-17 00:00:00','enviado','contabilidad','archivo',8,11,68),('2012-04-17 00:00:00','enviado','contabilidad','archivo',8,11,69),('0000-00-00 00:00:00','cola','contabilidad',NULL,8,NULL,70),('0000-00-00 00:00:00','cola','contabilidad',NULL,8,NULL,71),('0000-00-00 00:00:00','cola','contabilidad',NULL,8,NULL,72),('0000-00-00 00:00:00','cola','contabilidad',NULL,8,NULL,73);

/*Table structure for table `nota` */

DROP TABLE IF EXISTS `nota`;

CREATE TABLE `nota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_emision` date DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `iddocumento` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nota_documento1` (`iddocumento`),
  KEY `fk_nota_proveedor1` (`idproveedor`),
  CONSTRAINT `fk_nota_documento1` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nota_proveedor1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nota` */

/*Table structure for table `perfil` */

DROP TABLE IF EXISTS `perfil`;

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `perfil` */

insert  into `perfil`(`id`,`tipo`) values (1,'ADMIN'),(2,'OPT');

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut_proveedor` varchar(45) DEFAULT NULL,
  `nombre_proveedor` varchar(45) DEFAULT NULL,
  `rubro_proveedor` varchar(45) DEFAULT NULL,
  `descripcion_proveedor` varchar(250) DEFAULT NULL,
  `sigla_proveedor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `proveedor` */

insert  into `proveedor`(`id`,`rut_proveedor`,`nombre_proveedor`,`rubro_proveedor`,`descripcion_proveedor`,`sigla_proveedor`) values (1,'1111-1','Cencosud Easy Ltda',NULL,NULL,NULL),(2,'2222-2','Cencosud Jumbo Ltda',NULL,NULL,NULL),(3,'3333-3','Wall-Mart Lider Ltda',NULL,NULL,NULL),(4,'4444-4','Unimarc','H','Empresa de abarrotes',NULL),(5,'5555-5','Santa Isabel Ltda','H','Empresa de abarrotes.','SANIL');

/* Function  structure for function  `ingresar_documento` */

/*!50003 DROP FUNCTION IF EXISTS `ingresar_documento` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `ingresar_documento`(fecha_recep DATE,nombre_documento VARCHAR(45),idempresa INT,tipo_documento VARCHAR(45),
 depto_destino VARCHAR(45), emp_destino VARCHAR(45),nombre_archivo VARCHAR(100) ) RETURNS int(11)
BEGIN
	DECLARE id_documento INT;
 	 INSERT INTO documento (fecha_recep,nombre_documento,nombre_archivo,idempresa,tipo_documento)
 VALUES (fecha_recep,nombre_documento,nombre_archivo,idempresa,tipo_documento);
 	 SELECT MAX(id) INTO id_documento FROM documento;
 	 	 INSERT INTO historial_documento (fecha_envio,estado,depto_origen,depto_destino,emp_origen, emp_destino, documento_id)
 VALUES (fecha_recep,'enviado','partes',depto_destino,'test_user', emp_destino, id_documento);
 	 RETURN 1;
    END */$$
DELIMITER ;

/* Function  structure for function  `ingresar_factura` */

/*!50003 DROP FUNCTION IF EXISTS `ingresar_factura` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `ingresar_factura`(idempresa INT,tipo_documento VARCHAR(45),tipo_factura VARCHAR(45),
idproveedor INT(11),numero_factura INT,fecha_recep DATE, fecha_emi DATE, emp_origen VARCHAR(45), depto_origen VARCHAR(45), estado VARCHAR (45)) RETURNS int(11)
BEGIN
 	 DECLARE id_documento INT;
		INSERT INTO documento (fecha_recep,idempresa,tipo_documento)
		VALUES (fecha_recep,idempresa,tipo_documento);
 	 SELECT MAX(id) INTO id_documento FROM documento;
 	 	 INSERT INTO factura (numero_factura,fecha_emision,iddocumento,idproveedor,tipo_factura)
		 VALUES (numero_factura,fecha_emi,id_documento,idproveedor,tipo_factura);
		 INSERT INTO historial_documento(depto_origen, emp_origen, documento_id, estado)
		 VALUES(depto_origen, emp_origen, id_documento, estado);
 	 RETURN 1;
 		 END */$$
DELIMITER ;

/* Function  structure for function  `ingresar_factura_venta` */

/*!50003 DROP FUNCTION IF EXISTS `ingresar_factura_venta` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `ingresar_factura_venta`(idempresa INT,tipo_documento VARCHAR(45),tipo_factura VARCHAR(45),
idproveedor INT(11),numero_factura INT, fecha_emi DATE, correlativo VARCHAR(45),emp_origen VARCHAR(45), depto_origen VARCHAR(45), estado VARCHAR (45)) RETURNS int(11)
BEGIN
 	 DECLARE id_documento INT;
		INSERT INTO documento (idempresa,tipo_documento)
		VALUES (idempresa,tipo_documento);
 	 SELECT MAX(id) INTO id_documento FROM documento;
 	 	 INSERT INTO factura (numero_factura,fecha_emision,iddocumento,idproveedor,tipo_factura, correlativo_manager)
		 VALUES (numero_factura,fecha_emi,id_documento,idproveedor,tipo_factura, correlativo);
		 INSERT INTO historial_documento(depto_origen, emp_origen, documento_id, estado)
		 VALUES(depto_origen, emp_origen, id_documento, estado);
 	 RETURN 1;
 		 END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
