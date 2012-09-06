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

/*Table structure for table `principal` */

DROP TABLE IF EXISTS `principal`;

CREATE TABLE `principal` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) DEFAULT NULL,
  `descripcion` VARCHAR(100) DEFAULT NULL,
  `contenido` TEXT,
  `imagen` VARCHAR(50) DEFAULT NULL,
  `fecha` DATE DEFAULT NULL,
   `estado` CHAR(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `principal` */

INSERT  INTO `principal`(`id`,`titulo`,`descripcion`,`contenido`,`imagen`,`fecha`) VALUES (1,'Historia','Nuestros Orígenes','El año 2000, se creó el Departamento de Ingeniería Informática y Ciencias de la Computación, a partir de la separación de las áreas de Computación e Industria del Departamento de Matemáticas y Ciencias de la Computación. ','Jellyfish.jpg','2012-03-13'),(2,'Mision/Vision','Lineamientos Estrategicos',' El Departamento de Ingeniería Informática y Ciencias de la Computación pertenece a la Facultad de Ingeniería de la Universidad de Atacama y\r\n comparte con ellas su filosofia centrada en la ética, cultura, desarrollo sustentable y equidad social.\r\n Nuestra misión consiste en cultivar las Ciencias de la Computación y la Ingeniería Informática, a través de la\r\n investigación, divulgación, aplicación y formación de profesionales, contribuyendo de esta forma, al progreso de nuestro país.\r\n <h2>Vision del Departamento</h2>\r\n Ser una unidad académica de excelencia en investigación, docencia y extensión, reconocida a nivel nacional e \r\n internacional en el ámbito de las ciencias de la computación e informática.','Desert1.jpg','2012-05-08'),(3,'Carreras','Ingeniería Civil en Computación e Informatica','La carrera de Ingeniería Civil en Computación e Informática tiene como objetivo crear un ingeniero que\neste orientado a diseñar, desarrollar y gestionar soluciones computacionales integradas, \nesto incluye: \ndesarrollo de sistemas, elaboración de planes informáticos y adaptación de nuevas tecnologías en su campo de acción.','3.jpg','2011-11-28'),(4,'Áreas','Areas de Desarrollo Profesional','<h2>Desarrollo de Sistemas</h2>\n Comprende asignaturas que incorporan el uso de herramientas de desarrollo, metodologías y técnicas para la construcción de sistemas de información.\n   <h2>Comunicación</h2>\n   Comprende asignaturas que entregan conocimientos para la implementación, administración y gestión de \n   redes de información.\n  <h2>Gestión Informática</h2>\n   Comprende asignaturas que incorporan herramientas y metodologías del área de gestión para administrar \n   recursos informáticos e incorporar tecnologías de la información en las organizaciones.\n  <h2>Gestión Empresarial</h2>\n  Comprende asignaturas que incorporan conocimientos y metodologías para la \n  gestión y creación de empresas, principalmente incorporando tecnologías de la información.','4.jpg','2012-05-01'),(6,'Acreditacion','Nuevo Proceso de Acreditacion','El DIICC nuevamente enfrenta un proceso de acreditacion para certificar la calidad en la educacion que entrega a sus alumnos como tambien, en gestion interna, investigacion e infraestructura, la meta para esta oportunidad sera lograr un periodo de acreditacion mucho mas extenso que el anterior','Lighthouse1.jpg','2012-05-30');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
