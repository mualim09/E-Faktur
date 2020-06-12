/*
SQLyog Ultimate v10.42 
MySQL - 5.6.26 : Database - piksi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`piksi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `piksi`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `sku` varchar(11) NOT NULL,
  `nm` varchar(150) DEFAULT NULL,
  `hrg` float DEFAULT NULL,
  `stk` float DEFAULT NULL,
  `uom` varchar(50) DEFAULT NULL,
  `bar` varchar(50) DEFAULT NULL,
  `ppn` char(1) DEFAULT NULL,
  PRIMARY KEY (`sku`),
  UNIQUE KEY `BARCODE MUST UNIQUE` (`bar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`sku`,`nm`,`hrg`,`stk`,`uom`,`bar`,`ppn`) values ('1','MIXAGRIB',5000,46,'PCS','1234','N'),('2','SANAFLUE',10000,7,'PCS','5324','Y'),('3','OSKADON',20000,10,'PCS','2345','N');

/*Table structure for table `master_user` */

DROP TABLE IF EXISTS `master_user`;

CREATE TABLE `master_user` (
  `kd_user` int(11) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `nm_lengkap` varchar(150) NOT NULL,
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `master_user` */

insert  into `master_user`(`kd_user`,`nm_user`,`pass`,`nm_lengkap`,`level`) values (1,'reza','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Fachreza Maulana','Admin'),(2,'robby','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Robby Prihandaya','Biasa'),(3,'dewi','ed1d859c50262701d92e5cbf39652792','Dewi Safitri','Biasa'),(4,'udin','202cb962ac59075b964b07152d234b70','Udin Sedunia','Biasa'),(5,'amelia','202cb962ac59075b964b07152d234b70','Amel Amelia Jaya','Biasa'),(13,'okter','40bd001563085fc35165329ea1ff5c5ecbdbbeef','oktertej','Admin'),(7,'victor','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Victor DJ','Admin'),(8,'risman','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Risman','Admin'),(9,'bei','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Bei Lesmana','Admin'),(10,'debby','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Debby Oktaviani','Admin'),(14,'dani','b96dbf74436b3f73db2f27c2fb7c966eb1f47360','Dani Aja','Biasa');

/*Table structure for table `pos_dt` */

DROP TABLE IF EXISTS `pos_dt`;

CREATE TABLE `pos_dt` (
  `id` varchar(30) DEFAULT NULL,
  `id_barang` varchar(11) NOT NULL,
  `hrg` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `tot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pos_dt` */

insert  into `pos_dt`(`id`,`id_barang`,`hrg`,`qty`,`uom`,`tot`) values ('170822/reza/001','1',5000,1,'PCS',5000),('170823/reza/001','2',10000,1,'PCS',10000),('170823/reza/002','1',5000,1,'PCS',5000),('170823/risman/001','2',10000,1,'PCS',10000),('170823/reza/003','1',5000,1,'PCS',5000),('170823/reza/003','2',10000,1,'PCS',10000),('170823/reza/004','1',5000,1,'PCS',5000);

/*Table structure for table `pos_hd` */

DROP TABLE IF EXISTS `pos_hd`;

CREATE TABLE `pos_hd` (
  `id` varchar(30) NOT NULL,
  `tgl` date DEFAULT NULL,
  `tm` time DEFAULT NULL,
  `byr` float DEFAULT NULL,
  `upd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pos_hd` */

insert  into `pos_hd`(`id`,`tgl`,`tm`,`byr`,`upd`) values ('170822/reza/001','2017-08-23','18:37:04',5000,'reza'),('170823/reza/001','2017-08-23','18:58:30',10000,'reza'),('170823/reza/002','2017-08-23','19:01:24',5000,'reza'),('170823/reza/003','2017-08-23','19:08:10',15000,'reza'),('170823/reza/004','2017-08-23','19:09:27',5000,'reza'),('170823/risman/001','2017-08-23','19:01:53',10000,'risman');

/*Table structure for table `pos_tmp` */

DROP TABLE IF EXISTS `pos_tmp`;

CREATE TABLE `pos_tmp` (
  `id` varchar(30) DEFAULT NULL,
  `id_barang` varchar(11) NOT NULL,
  `hrg` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `tot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pos_tmp` */

/* Trigger structure for table `pos_dt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `out_brg` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `out_brg` AFTER INSERT ON `pos_dt` FOR EACH ROW UPDATE barang SET stk = stk - new.qty WHERE sku = new.id_barang */$$


DELIMITER ;

/*Table structure for table `_lap` */

DROP TABLE IF EXISTS `_lap`;

/*!50001 DROP VIEW IF EXISTS `_lap` */;
/*!50001 DROP TABLE IF EXISTS `_lap` */;

/*!50001 CREATE TABLE  `_lap`(
 `id` varchar(30) ,
 `id_barang` varchar(11) ,
 `nm` varchar(150) ,
 `hrg` float ,
 `qty` float ,
 `uom` varchar(20) ,
 `tot` float ,
 `tgl` date ,
 `tm` time 
)*/;

/*Table structure for table `_pos_dt` */

DROP TABLE IF EXISTS `_pos_dt`;

/*!50001 DROP VIEW IF EXISTS `_pos_dt` */;
/*!50001 DROP TABLE IF EXISTS `_pos_dt` */;

/*!50001 CREATE TABLE  `_pos_dt`(
 `id` varchar(30) ,
 `id_barang` varchar(11) ,
 `nm` varchar(150) ,
 `hrg` float ,
 `qty` float ,
 `uom` varchar(20) ,
 `tot` float 
)*/;

/*Table structure for table `_pos_tmp` */

DROP TABLE IF EXISTS `_pos_tmp`;

/*!50001 DROP VIEW IF EXISTS `_pos_tmp` */;
/*!50001 DROP TABLE IF EXISTS `_pos_tmp` */;

/*!50001 CREATE TABLE  `_pos_tmp`(
 `id` varchar(30) ,
 `id_barang` varchar(11) ,
 `nm` varchar(150) ,
 `hrg` float ,
 `qty` float ,
 `uom` varchar(20) ,
 `tot` float 
)*/;

/*View structure for view _lap */

/*!50001 DROP TABLE IF EXISTS `_lap` */;
/*!50001 DROP VIEW IF EXISTS `_lap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_lap` AS select `_pos_dt`.`id` AS `id`,`_pos_dt`.`id_barang` AS `id_barang`,`_pos_dt`.`nm` AS `nm`,`_pos_dt`.`hrg` AS `hrg`,`_pos_dt`.`qty` AS `qty`,`_pos_dt`.`uom` AS `uom`,`_pos_dt`.`tot` AS `tot`,`pos_hd`.`tgl` AS `tgl`,`pos_hd`.`tm` AS `tm` from (`pos_hd` join `_pos_dt` on((`pos_hd`.`id` = `_pos_dt`.`id`))) */;

/*View structure for view _pos_dt */

/*!50001 DROP TABLE IF EXISTS `_pos_dt` */;
/*!50001 DROP VIEW IF EXISTS `_pos_dt` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_pos_dt` AS select `pos_dt`.`id` AS `id`,`pos_dt`.`id_barang` AS `id_barang`,`barang`.`nm` AS `nm`,`pos_dt`.`hrg` AS `hrg`,`pos_dt`.`qty` AS `qty`,`pos_dt`.`uom` AS `uom`,`pos_dt`.`tot` AS `tot` from (`barang` join `pos_dt` on((`barang`.`sku` = `pos_dt`.`id_barang`))) */;

/*View structure for view _pos_tmp */

/*!50001 DROP TABLE IF EXISTS `_pos_tmp` */;
/*!50001 DROP VIEW IF EXISTS `_pos_tmp` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_pos_tmp` AS select `pos_tmp`.`id` AS `id`,`pos_tmp`.`id_barang` AS `id_barang`,`barang`.`nm` AS `nm`,`pos_tmp`.`hrg` AS `hrg`,`pos_tmp`.`qty` AS `qty`,`pos_tmp`.`uom` AS `uom`,`pos_tmp`.`tot` AS `tot` from (`barang` join `pos_tmp` on((`barang`.`sku` = `pos_tmp`.`id_barang`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
