/*
SQLyog Ultimate v10.42 
MySQL - 5.6.26 : Database - eza
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
  PRIMARY KEY (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`sku`,`nm`,`hrg`,`stk`,`uom`) values ('1','JJ&W SPARK PINK COCKTAIL 750MLS',70000,100,'KG'),('2','GREEN SANDS CAN 330ML',42000,21,'PCS'),('3','NICE TOILET TISSUE 10`S',26000,100,'PCS'),('4','PRINGLES BBQ USA 169GR',15000,22,'PCS'),('5','GRANOLA CINNAMON&SNAKE FRUIT 480GR',44000,36,'KG'),('6','ANGGUR HITAM',25000,25,'PCS'),('7','IKAN BAKAR',340000,20,'PCS');

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

insert  into `master_user`(`kd_user`,`nm_user`,`pass`,`nm_lengkap`,`level`) values (1,'reza','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Fachreza Maulana','Admin'),(2,'robby','8d05dd2f03981f86b56c23951f3f34d7','Robby Prihandaya','Biasa'),(3,'dewi','ed1d859c50262701d92e5cbf39652792','Dewi Safitri','Biasa'),(4,'udin','202cb962ac59075b964b07152d234b70','Udin Sedunia','Biasa'),(5,'amelia','202cb962ac59075b964b07152d234b70','Amel Amelia Jaya','Biasa'),(13,'okter','40bd001563085fc35165329ea1ff5c5ecbdbbeef','oktertej','Admin'),(7,'victor','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Victor DJ','Admin'),(8,'risman','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Risman','Admin'),(9,'bei','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Bei Lesmana','Admin'),(10,'debby','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Debby Oktaviani','Admin'),(14,'dani','b96dbf74436b3f73db2f27c2fb7c966eb1f47360','Dani Aja','Biasa');

/*Table structure for table `pos_dt` */

DROP TABLE IF EXISTS `pos_dt`;

CREATE TABLE `pos_dt` (
  `id` varchar(25) DEFAULT NULL,
  `id_barang` varchar(11) NOT NULL,
  `hrg` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `tot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pos_dt` */

insert  into `pos_dt`(`id`,`id_barang`,`hrg`,`qty`,`uom`,`tot`) values ('170725/reza/001','1',70000,1,'PCS',70000),('170725/reza/001','2',42000,2,'PCS',84000),('170731/reza/002','1',70000,1,'KG',70000),('170731/reza/002','2',42000,12,'PCS',504000),('170731/reza/003','3',26000,1,'PCS',26000),('170731/reza/003','2',42000,3,'PCS',126000);

/*Table structure for table `pos_hd` */

DROP TABLE IF EXISTS `pos_hd`;

CREATE TABLE `pos_hd` (
  `id` varchar(25) NOT NULL,
  `tgl` date DEFAULT NULL,
  `tm` time DEFAULT NULL,
  `byr` float DEFAULT NULL,
  `upd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pos_hd` */

insert  into `pos_hd`(`id`,`tgl`,`tm`,`byr`,`upd`) values ('170725/reza/001','2017-07-31','10:00:00',50000,'reza'),('170731/reza/002','2017-07-31','21:51:35',574000,'reza'),('170731/reza/003','2017-07-31','21:53:17',152000,'reza');

/*Table structure for table `pos_tmp` */

DROP TABLE IF EXISTS `pos_tmp`;

CREATE TABLE `pos_tmp` (
  `id` varchar(25) DEFAULT NULL,
  `id_barang` varchar(11) NOT NULL,
  `hrg` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `tot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pos_tmp` */

/*Table structure for table `_pos_dt` */

DROP TABLE IF EXISTS `_pos_dt`;

/*!50001 DROP VIEW IF EXISTS `_pos_dt` */;
/*!50001 DROP TABLE IF EXISTS `_pos_dt` */;

/*!50001 CREATE TABLE  `_pos_dt`(
 `id` varchar(25) ,
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
 `id` varchar(25) ,
 `id_barang` varchar(11) ,
 `nm` varchar(150) ,
 `hrg` float ,
 `qty` float ,
 `uom` varchar(20) ,
 `tot` float 
)*/;

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
