/*
SQLyog Ultimate v8.61 
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `footer` */

insert  into `footer`(`id`,`contenido`,`fecha`) values (3,'Reunion del centro de alumnos DIICC dia miercoles 17 a las 15:30 en la sala del CEAL, editando',NULL),(6,'Incripciones para Infonor 2012, abiertas, hablar con el profesor Dario Rojas',NULL),(27,'Seminario de Innovacion en TI martes 14 11:30 HR Auditorio Edificio Minas.','2012-01-10'),(28,'creo este nuevo aviso de pruebam edaito','2012-01-30');

/*Table structure for table `lateral` */

DROP TABLE IF EXISTS `lateral`;

CREATE TABLE `lateral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` text,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `lateral` */

insert  into `lateral`(`id`,`contenido`,`fecha`) values (2,'Nuevas publicaciones hechas por los academicos DIICC son seleccionadas para ser expuestas en diversos congresos internacionales relacionados\r\na las ciencias de la computacion, los acadaemicos daario rojas y dante carrizo fueron invtador a europa y EEUU respectivamente a exponer sus trabajos','2012-01-10'),(4,'Se acerca la fecha limita para la acreditacion de las carreras DIICC. edaitadao','2012-01-10');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `principal` */

insert  into `principal`(`id`,`titulo`,`descripcion`,`contenido`) values (1,'Historia','Nuestros Orígenes','El año 2000, se creó el Departamento de Ingeniería Informática y Ciencias de la Computación, a partir de la separación de las áreas de Computación e Industria del Departamento de Matemáticas y Ciencias de la Computación. Paralelamente, ese mismo año se crearon los nuevos planes de estudios de la carrera de Ingenierá Civil en Computación e Informática, la que comienza a recibir sus primeros alumnos a partir del año 2001. Actualmente, el DIICC dicta las carreras de IngenieríaCivil en Computación e Informática, presta servicios a otras unidades académicas de la Universidad, realiza actividades de extensión y se está incorporando a las actividades de investigación. '),(2,'Mision/Vision','Lineamientos Estrategicos',' El Departamento de Ingeniería Informática y Ciencias de la Computación pertenece a la Facultad de Ingeniería de la Universidad de Atacama y\r\n comparte con ellas su filosofia centrada en la ética, cultura, desarrollo sustentable y equidad social.\r\n Nuestra misión consiste en cultivar las Ciencias de la Computación y la Ingeniería Informática, a través de la\r\n investigación, divulgación, aplicación y formación de profesionales, contribuyendo de esta forma, al progreso de nuestro país.\r\n <h2>Vision del Departamento</h2>\r\n Ser una unidad académica de excelencia en investigación, docencia y extensión, reconocida a nivel nacional e \r\n internacional en el ámbito de las ciencias de la computación e informática.'),(3,'Carreras','Ingeniería Civil en Computación e Informatica','La carrera de Ingeniería Civil en Computación e Informática tiene como objetivo crear un ingeniero que\neste orientado a diseñar, desarrollar y gestionar soluciones computacionales integradas, \nesto incluye: \ndesarrollo de sistemas, elaboración de planes informáticos y adaptación de nuevas tecnologías en su campo de acción.'),(4,'Áreas','Areas de Desarrollo Profesional','<h2>Desarrollo de Sistemas</h2>\n Comprende asignaturas que incorporan el uso de herramientas de desarrollo, metodologías y técnicas para la construcción de sistemas de información.\n   <h2>Comunicación</h2>\n   Comprende asignaturas que entregan conocimientos para la implementación, administración y gestión de \n   redes de información.\n  <h2>Gestión Informática</h2>\n   Comprende asignaturas que incorporan herramientas y metodologías del área de gestión para administrar \n   recursos informáticos e incorporar tecnologías de la información en las organizaciones.\n  <h2>Gestión Empresarial</h2>\n  Comprende asignaturas que incorporan conocimientos y metodologías para la \n  gestión y creación de empresas, principalmente incorporando tecnologías de la información.');

/*Table structure for table `video` */

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `url` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `video` */

insert  into `video`(`id`,`nombre`,`descripcion`,`url`) values (2,'sintel.webm','fundacion blender','application/third_party/mediafront/playlist/playlists/videos/track1/sintel.webm'),(3,'video.mp4','video promocional DIICC','application/third_party/mediafront/playlist/playlists/videos/track2/video.mp4');

/*Table structure for table `visualizar` */

DROP TABLE IF EXISTS `visualizar`;

CREATE TABLE `visualizar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desplegar` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `visualizar` */

insert  into `visualizar`(`id`,`desplegar`) values (1,'texto');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
