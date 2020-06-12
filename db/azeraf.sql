/*
SQLyog Ultimate v10.42 
MySQL - 5.6.26 : Database - azeraf
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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

insert  into `barang`(`sku`,`nm`,`hrg`,`stk`,`uom`,`bar`,`ppn`) values ('1','MIXAGRIB',5000,35,'PCS','8993334230989','Y'),('2','SANAFLUE',10000,1,'PCS','8993334230941','Y'),('3','OSKADON',20000,-3,'PCS','8993334230965','Y');

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
  `qty` float DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `hrg` float DEFAULT NULL,
  `brt` float DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `discA` float DEFAULT NULL,
  `ppn` float DEFAULT NULL,
  `tot` float DEFAULT NULL,
  `upd` varchar(50) DEFAULT NULL,
  KEY `fk_trans` (`id`),
  KEY `fk_sku` (`id_barang`),
  CONSTRAINT `fk_sku` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`sku`),
  CONSTRAINT `fk_trans` FOREIGN KEY (`id`) REFERENCES `pos_hd` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pos_dt` */

insert  into `pos_dt`(`id`,`id_barang`,`qty`,`uom`,`hrg`,`brt`,`disc`,`discA`,`ppn`,`tot`,`upd`) values ('170828/reza/001','3',2,'PCS',22000,44000,10,4400,4400,39600,'reza'),('170828/reza/002','2',2,'PCS',11000,22000,0,0,2200,22000,'reza'),('170828/reza/002','3',1,'PCS',22000,22000,10,2000,2000,20000,'reza');

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

insert  into `pos_hd`(`id`,`tgl`,`tm`,`byr`,`upd`) values ('170828/reza/001','2017-08-28','14:29:46',40000,'reza'),('170828/reza/002','2017-08-28','15:12:11',42000,'reza');

/*Table structure for table `pos_tmp` */

DROP TABLE IF EXISTS `pos_tmp`;

CREATE TABLE `pos_tmp` (
  `id` varchar(30) DEFAULT NULL,
  `id_barang` varchar(11) NOT NULL,
  `qty` float DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `hrg` float DEFAULT NULL,
  `brt` float DEFAULT NULL,
  `disc` float DEFAULT NULL,
  `discA` float DEFAULT NULL,
  `ppn` float DEFAULT NULL,
  `tot` float DEFAULT NULL,
  `upd` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pos_tmp` */

/*Table structure for table `promo_dt` */

DROP TABLE IF EXISTS `promo_dt`;

CREATE TABLE `promo_dt` (
  `id` varchar(30) DEFAULT NULL,
  `id_barang` varchar(11) DEFAULT NULL,
  `perc` float DEFAULT NULL,
  `amt` float DEFAULT NULL,
  `tip` varchar(20) DEFAULT NULL,
  KEY `fk_barang` (`id_barang`),
  KEY `fk_promo` (`id`),
  CONSTRAINT `fk_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`sku`),
  CONSTRAINT `fk_promo` FOREIGN KEY (`id`) REFERENCES `promo_hd` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `promo_dt` */

insert  into `promo_dt`(`id`,`id_barang`,`perc`,`amt`,`tip`) values ('PROMO-01','3',0,2000,'AMOUNT');

/*Table structure for table `promo_hd` */

DROP TABLE IF EXISTS `promo_hd`;

CREATE TABLE `promo_hd` (
  `id` varchar(30) NOT NULL,
  `tgl1` date DEFAULT NULL,
  `tgl2` date DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `promo_hd` */

insert  into `promo_hd`(`id`,`tgl1`,`tgl2`,`ket`) values ('PROMO-01','2017-08-27','2017-08-28','DISKON PROMO OSKADON 20 %');

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
 `brt` float ,
 `disc` float ,
 `discA` float ,
 `ppn` float ,
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
 `qty` float ,
 `uom` varchar(20) ,
 `hrg` float ,
 `brt` float ,
 `disc` float ,
 `discA` float ,
 `ppn` float ,
 `tot` float ,
 `upd` varchar(50) 
)*/;

/*Table structure for table `_pos_tmp` */

DROP TABLE IF EXISTS `_pos_tmp`;

/*!50001 DROP VIEW IF EXISTS `_pos_tmp` */;
/*!50001 DROP TABLE IF EXISTS `_pos_tmp` */;

/*!50001 CREATE TABLE  `_pos_tmp`(
 `id` varchar(30) ,
 `id_barang` varchar(11) ,
 `nm` varchar(150) ,
 `qty` float ,
 `uom` varchar(20) ,
 `hrg` float ,
 `brt` float ,
 `disc` float ,
 `discA` float ,
 `ppn` float ,
 `tot` float ,
 `upd` varchar(50) 
)*/;

/*Table structure for table `_promo` */

DROP TABLE IF EXISTS `_promo`;

/*!50001 DROP VIEW IF EXISTS `_promo` */;
/*!50001 DROP TABLE IF EXISTS `_promo` */;

/*!50001 CREATE TABLE  `_promo`(
 `id` varchar(30) ,
 `tgl1` date ,
 `tgl2` date ,
 `ket` text ,
 `id_barang` varchar(11) ,
 `perc` float ,
 `amt` float ,
 `tip` varchar(20) 
)*/;

/*View structure for view _lap */

/*!50001 DROP TABLE IF EXISTS `_lap` */;
/*!50001 DROP VIEW IF EXISTS `_lap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_lap` AS select `_pos_dt`.`id` AS `id`,`_pos_dt`.`id_barang` AS `id_barang`,`_pos_dt`.`nm` AS `nm`,`_pos_dt`.`hrg` AS `hrg`,`_pos_dt`.`qty` AS `qty`,`_pos_dt`.`uom` AS `uom`,`_pos_dt`.`brt` AS `brt`,`_pos_dt`.`disc` AS `disc`,`_pos_dt`.`discA` AS `discA`,`_pos_dt`.`ppn` AS `ppn`,`_pos_dt`.`tot` AS `tot`,`pos_hd`.`tgl` AS `tgl`,`pos_hd`.`tm` AS `tm` from (`pos_hd` join `_pos_dt` on((`pos_hd`.`id` = `_pos_dt`.`id`))) */;

/*View structure for view _pos_dt */

/*!50001 DROP TABLE IF EXISTS `_pos_dt` */;
/*!50001 DROP VIEW IF EXISTS `_pos_dt` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_pos_dt` AS select `pos_dt`.`id` AS `id`,`pos_dt`.`id_barang` AS `id_barang`,`barang`.`nm` AS `nm`,`pos_dt`.`qty` AS `qty`,`pos_dt`.`uom` AS `uom`,`pos_dt`.`hrg` AS `hrg`,`pos_dt`.`brt` AS `brt`,`pos_dt`.`disc` AS `disc`,`pos_dt`.`discA` AS `discA`,`pos_dt`.`ppn` AS `ppn`,`pos_dt`.`tot` AS `tot`,`pos_dt`.`upd` AS `upd` from (`barang` join `pos_dt` on((`barang`.`sku` = `pos_dt`.`id_barang`))) */;

/*View structure for view _pos_tmp */

/*!50001 DROP TABLE IF EXISTS `_pos_tmp` */;
/*!50001 DROP VIEW IF EXISTS `_pos_tmp` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_pos_tmp` AS select `pos_tmp`.`id` AS `id`,`pos_tmp`.`id_barang` AS `id_barang`,`barang`.`nm` AS `nm`,`pos_tmp`.`qty` AS `qty`,`pos_tmp`.`uom` AS `uom`,`pos_tmp`.`hrg` AS `hrg`,`pos_tmp`.`brt` AS `brt`,`pos_tmp`.`disc` AS `disc`,`pos_tmp`.`discA` AS `discA`,`pos_tmp`.`ppn` AS `ppn`,`pos_tmp`.`tot` AS `tot`,`pos_tmp`.`upd` AS `upd` from (`barang` join `pos_tmp` on((`barang`.`sku` = `pos_tmp`.`id_barang`))) */;

/*View structure for view _promo */

/*!50001 DROP TABLE IF EXISTS `_promo` */;
/*!50001 DROP VIEW IF EXISTS `_promo` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_promo` AS select `promo_hd`.`id` AS `id`,`promo_hd`.`tgl1` AS `tgl1`,`promo_hd`.`tgl2` AS `tgl2`,`promo_hd`.`ket` AS `ket`,`promo_dt`.`id_barang` AS `id_barang`,`promo_dt`.`perc` AS `perc`,`promo_dt`.`amt` AS `amt`,`promo_dt`.`tip` AS `tip` from (`promo_dt` join `promo_hd` on((`promo_dt`.`id` = `promo_hd`.`id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
