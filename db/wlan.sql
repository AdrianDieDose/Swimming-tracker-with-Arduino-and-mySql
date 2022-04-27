/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.22-MariaDB : Database - wlan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wlan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `wlan`;

/*Table structure for table `data` */

DROP TABLE IF EXISTS `data`;

CREATE TABLE `data` (
  `rfid` int(11) NOT NULL,
  `laeufer_name` varchar(10) NOT NULL,
  `rundenanzahl` varchar(10) DEFAULT NULL,
  `letzte_rundenzeit` time DEFAULT NULL,
  `bestzeit` time DEFAULT NULL,
  `anfang_runde` time DEFAULT NULL,
  PRIMARY KEY (`rfid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `data` */

/*Table structure for table `rundenzeiten` */

DROP TABLE IF EXISTS `rundenzeiten`;

CREATE TABLE `rundenzeiten` (
  `rfid` int(11) NOT NULL,
  `rundenzeit` varchar(255) NOT NULL,
  `runde` int(11) NOT NULL,
  PRIMARY KEY (`rfid`,`runde`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `rundenzeiten` */

insert  into `rundenzeiten`(`rfid`,`rundenzeit`,`runde`) values 
(1,'00:00:00',1),
(1,'06:48:56',2),
(1,'00:00:13',3),
(3,'00:00:00',1),
(3,'00:02:49',2),
(3,'00:00:11',3),
(4,'00:00:00',1),
(4,'00:00:38',2),
(5,'00:00:00',1),
(6,'00:00:00',1),
(6,'00:00:21',2),
(8,'00:00:00',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
