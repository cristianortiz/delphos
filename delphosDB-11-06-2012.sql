/*
SQLyog Ultimate v9.63 
MySQL - 5.5.16 : Database - delphos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`delphos` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `delphos`;

/*Table structure for table `academico` */

DROP TABLE IF EXISTS `academico`;

CREATE TABLE `academico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellido_paterno` varchar(45) DEFAULT NULL,
  `apellido_materno` varchar(45) DEFAULT NULL,
  `grado_academico` varchar(45) DEFAULT NULL,
  `titulo_profesional` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `perfil_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_academico_perfil1` (`perfil_id`),
  CONSTRAINT `fk_academico_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `academico` */

insert  into `academico`(`id`,`rut`,`username`,`password`,`nombres`,`apellido_paterno`,`apellido_materno`,`grado_academico`,`titulo_profesional`,`email`,`perfil_id`) values (1,'23537656-0','jcrojas','jcrojas','juan carlos','rojas','thomas','magister en ciencias de la computacion','ingeniero civil informatico','juancarlos.rojas@uda.cl','coordinador'),(2,'1345389-0','drojas','drojas','dario','rojas','diaz','magister en ciencias de la computacion','ingeniero civil informatico','dfrojas@gmail.com','coordinador'),(3,'1356776-9','hcornide','hcornide','hector','cornide','reyes','licenciado en ciencias de la ingenieria','ingeniero civil en computacion e informatica','hector.cornide@uda.cl','coordinador');

/*Table structure for table `administrador` */

DROP TABLE IF EXISTS `administrador`;

CREATE TABLE `administrador` (
  `id_admin` varchar(45) NOT NULL,
  `pass_admin` varchar(45) DEFAULT NULL,
  `perfil_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `fk_administrador_perfil1` (`perfil_id`),
  CONSTRAINT `fk_administrador_perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `administrador` */

insert  into `administrador`(`id_admin`,`pass_admin`,`perfil_id`) values ('admin','jcrojas','administrador');

/*Table structure for table `footer` */

DROP TABLE IF EXISTS `footer`;

CREATE TABLE `footer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` text,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `footer` */

insert  into `footer`(`id`,`contenido`,`fecha`) values (47,'Se suspende la clase de Sistemas Operativos de hoy martes a las 11:30','2012-04-11'),(48,'Reunion de el CEAL DIICC jueves 25 a las 13:00 no faltar','2012-04-11'),(50,'Seminario de Incorporacion de TI martes 23 a las 17:00 Auditorio edificio de Minas','2012-04-11'),(51,'Prueba de Teoria Economica mañana viernes a las 11:30 sala DIIC-2 veamos hasta donde','2012-04-14'),(52,'Inscripciones abiertas para Ayudantes DIICC dejar datos en Secretaria','2012-04-14');

/*Table structure for table `lateral` */

DROP TABLE IF EXISTS `lateral`;

CREATE TABLE `lateral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` text,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `lateral` */

insert  into `lateral`(`id`,`contenido`,`fecha`) values (2,'Nuevas publicaciones hechas por los academicos DIICC son seleccionadas para ser expuestas en diversos congresos internacionales.','2012-01-10'),(5,'Parte la seleccion del equipo DIICC para participar en la competencia de programacion de la ASM interesados hablar con el profesor Dante Carrizo a ve','2012-03-15'),(6,'proximo a iniciar proyecto para transformar al DIICC en eficio inteligente, charla informativa jueves 15 a las 12:30 hr sala DIICC-1','2012-04-09'),(7,'Se inicia proceso de postulacion a becas de magister  y doctorado en el extranjero del programa Becas Chile mas detalles en www.becaschile.cl','2012-04-09');

/*Table structure for table `perfil` */

DROP TABLE IF EXISTS `perfil`;

CREATE TABLE `perfil` (
  `id_perfil` varchar(45) NOT NULL,
  PRIMARY KEY (`id_perfil`),
  UNIQUE KEY `id_perfil_UNIQUE` (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perfil` */

insert  into `perfil`(`id_perfil`) values ('administrador'),('coordinador');

/*Table structure for table `principal` */

DROP TABLE IF EXISTS `principal`;

CREATE TABLE `principal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `contenido` text,
  `imagen` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `principal` */

insert  into `principal`(`id`,`titulo`,`descripcion`,`contenido`,`imagen`,`fecha`) values (1,'Historia','Nuestros Orígenes','El año 2000, se creó el Departamento de Ingeniería Informática y Ciencias de la Computación, a partir de la separación de las áreas de Computación e Industria del Departamento de Matemáticas y Ciencias de la Computación. ','Jellyfish.jpg','2012-03-13'),(2,'Mision/Vision','Lineamientos Estrategicos',' El Departamento de Ingeniería Informática y Ciencias de la Computación pertenece a la Facultad de Ingeniería de la Universidad de Atacama y\r\n comparte con ellas su filosofia centrada en la ética, cultura, desarrollo sustentable y equidad social.\r\n Nuestra misión consiste en cultivar las Ciencias de la Computación y la Ingeniería Informática, a través de la\r\n investigación, divulgación, aplicación y formación de profesionales, contribuyendo de esta forma, al progreso de nuestro país.\r\n <h2>Vision del Departamento</h2>\r\n Ser una unidad académica de excelencia en investigación, docencia y extensión, reconocida a nivel nacional e \r\n internacional en el ámbito de las ciencias de la computación e informática.','Desert1.jpg','2012-05-08'),(3,'Carreras','Ingeniería Civil en Computación e Informatica','La carrera de Ingeniería Civil en Computación e Informática tiene como objetivo crear un ingeniero que\neste orientado a diseñar, desarrollar y gestionar soluciones computacionales integradas, \nesto incluye: \ndesarrollo de sistemas, elaboración de planes informáticos y adaptación de nuevas tecnologías en su campo de acción.','3.jpg','2011-11-28'),(4,'Áreas','Areas de Desarrollo Profesional','<h2>Desarrollo de Sistemas</h2>\n Comprende asignaturas que incorporan el uso de herramientas de desarrollo, metodologías y técnicas para la construcción de sistemas de información.\n   <h2>Comunicación</h2>\n   Comprende asignaturas que entregan conocimientos para la implementación, administración y gestión de \n   redes de información.\n  <h2>Gestión Informática</h2>\n   Comprende asignaturas que incorporan herramientas y metodologías del área de gestión para administrar \n   recursos informáticos e incorporar tecnologías de la información en las organizaciones.\n  <h2>Gestión Empresarial</h2>\n  Comprende asignaturas que incorporan conocimientos y metodologías para la \n  gestión y creación de empresas, principalmente incorporando tecnologías de la información.','4.jpg','2012-05-01'),(6,'Acreditacion','Nuevo Proceso de Acreditacion','El DIICC nuevamente enfrenta un proceso de acreditacion para certificar la calidad en la educacion que entrega a sus alumnos como tambien, en gestion interna, investigacion e infraestructura, la meta para esta oportunidad sera lograr un periodo de acreditacion mucho mas extenso que el anterior','Lighthouse1.jpg','2012-05-30');

/*Table structure for table `video` */

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `url` text,
  `tipo` varchar(40) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `video` */

insert  into `video`(`id`,`nombre`,`descripcion`,`url`,`tipo`,`fecha`) values (27,'video.mp4','video mp4 de prueba','http://localhost/delphos/recursos/videos/video.mp4','video/mp4','2012-05-03'),(29,'video online','video online','http://www.youtube.com/watch?v=wXE2pn_s818','video/youtube','2012-05-01');

/*Table structure for table `visualizar` */

DROP TABLE IF EXISTS `visualizar`;

CREATE TABLE `visualizar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desplegar` varchar(20) DEFAULT NULL,
  `tiempo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `visualizar` */

insert  into `visualizar`(`id`,`desplegar`,`tiempo`) values (1,'video',50000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
