/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.1.38-MariaDB : Database - bano
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bano` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bano`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`username`,`password`,`nama_lengkap`) values 
(1,'EBrenk','123456','EBrenk Admin');

/*Table structure for table `ongkir` */

DROP TABLE IF EXISTS `ongkir`;

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  PRIMARY KEY (`id_ongkir`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ongkir` */

insert  into `ongkir`(`id_ongkir`,`nama_kota`,`tarif`) values 
(1,'Jakarta',20000),
(2,'Surabaya',10000);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`email_pelanggan`,`password_pelanggan`,`nama_pelanggan`) values 
(3,'idabrw20@gmail.com','111111','Gusge'),
(4,'brenksuser@ddd.com','123456','Ebrenk User'),
(5,'bagas@123.com','123456','bagas'),
(6,'asdasd@asdasd.com','123456','asdasd'),
(7,'jonmin@gmail.com','jonmin123','jonmin'),
(8,'ibubapak@gmail.com','jonmin123','bapak');

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`id_pembayaran`,`id_pembelian`,`nama`,`bank`,`jumlah`,`tanggal`,`bukti`) values 
(2,13,'gusgay','mandiri',16850000,'2018-12-19','20181219224532'),
(3,15,'gusge','mandiri',8300000,'2018-12-20','20181220054113hp2.jpg'),
(4,16,'saya sendiri','mandiri',25400000,'2018-12-20','20181220055839hp1.jpg'),
(5,17,'bagas','mandiri',8300000,'2018-12-20','20181220065428hp1.jpg'),
(6,19,'hgyyug','y7hgyyuguyg',1000000,'2019-03-06','20190306164027'),
(7,20,'bhjggbhh','nuuh',1000000,'2019-03-06','20190306164334');

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian` */

insert  into `pembelian`(`id_pembelian`,`id_pelanggan`,`id_ongkir`,`tanggal_pembelian`,`total_pembelian`,`status_pembelian`,`resi_pengiriman`) values 
(1,2,1,'2018-12-19',20000000,'pending',''),
(2,2,1,'2018-12-17',9000000,'pending',''),
(5,2,1,'2018-12-19',25990000,'pending',''),
(6,2,1,'2018-12-19',25990000,'pending',''),
(7,2,2,'2018-12-19',25990000,'pending',''),
(8,2,1,'2018-12-19',25990000,'pending',''),
(9,2,1,'2018-12-19',16998000,'pending',''),
(10,2,1,'2018-12-19',17690000,'pending',''),
(11,2,0,'2018-12-19',8300000,'pending',''),
(12,1,1,'2018-12-19',8300000,'pending',''),
(13,3,0,'2018-12-19',16850000,'lunas','uy6t67t7'),
(14,4,2,'2018-12-20',25990000,'pending',''),
(15,3,2,'2018-12-20',8300000,'barang dikirim','T3ST2'),
(16,3,1,'2018-12-20',25400000,'barang dikirim','T3ST2'),
(17,5,1,'2018-12-20',8300000,'barang dikirim','T3ST2'),
(18,6,1,'2019-02-19',8300000,'pending',''),
(19,7,1,'2019-03-06',9390000,'barang dikirim','olkmmomklk'),
(20,7,1,'2019-03-06',8300000,'lunas','jknhjvfcvhgbj'),
(21,8,1,'2019-05-20',9390000,'pending','');

/*Table structure for table `pembelian_produk` */

DROP TABLE IF EXISTS `pembelian_produk`;

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_pembelian_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `pembelian_produk` */

insert  into `pembelian_produk`(`id_pembelian_produk`,`id_pembelian`,`id_produk`,`jumlah`) values 
(1,1,1,1),
(2,1,2,1),
(3,0,2,1),
(4,0,1,2),
(5,7,2,1),
(6,7,1,2),
(7,8,2,1),
(8,8,1,2),
(9,9,1,1),
(10,9,3,1),
(11,10,1,1),
(12,10,2,1),
(13,11,1,1),
(14,12,1,1),
(15,13,1,1),
(16,13,4,1),
(17,14,1,2),
(18,14,2,1),
(19,15,1,1),
(20,16,1,1),
(21,16,4,2),
(22,17,1,1),
(23,18,1,1),
(24,19,2,1),
(25,20,1,1),
(26,21,2,1);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(5) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

insert  into `produk`(`id_produk`,`nama_produk`,`harga_produk`,`foto_produk`,`deskripsi_produk`,`stok_produk`) values 
(1,'Samsung Galaxy',8300000,'hp1.jpg','Galaxy S9, bukan kaleng-kaleng		',0),
(2,'Google Pixel 2',9390000,'hp2.jpg','Google Pixel 2',3),
(3,'HTC U11',8698000,'hp3.jpg','HTC U11',5),
(4,'OnePlus 5T',8550000,'hp4.jpg','OnePlus 5T',3),
(5,'Razer Phone',9000000,'hp5.jpg','			MAHAL BOI		',5);

/* Function  structure for function  `jumlah_pelanggan` */

/*!50003 DROP FUNCTION IF EXISTS `jumlah_pelanggan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `jumlah_pelanggan`() RETURNS int(11)
BEGIN 
	DECLARE jml_pelanggan INT;
	
	SELECT COUNT(id_pelanggan) INTO jml_pelanggan FROM pelanggan;
	RETURN jml_pelanggan; 
END */$$
DELIMITER ;

/* Function  structure for function  `jumlah_transaksi` */

/*!50003 DROP FUNCTION IF EXISTS `jumlah_transaksi` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `jumlah_transaksi`() RETURNS int(11)
BEGIN 
	DECLARE jml_transaksi INT;
	
	SELECT COUNT(id_pembelian) INTO jml_transaksi FROM pembelian;
	RETURN jml_transaksi; 
END */$$
DELIMITER ;

/* Function  structure for function  `potongan_harga_oneplus` */

/*!50003 DROP FUNCTION IF EXISTS `potongan_harga_oneplus` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `potongan_harga_oneplus`() RETURNS int(11)
    DETERMINISTIC
BEGIN 
 DECLARE harga_plus5T INT;
 
 SELECT harga_produk INTO harga_plus5T FROM produk WHERE nama_produk = 'OnePlus 5T';
 RETURN harga_plus5T - 100000; 
END */$$
DELIMITER ;

/* Function  structure for function  `potongan_harga_razer` */

/*!50003 DROP FUNCTION IF EXISTS `potongan_harga_razer` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `potongan_harga_razer`() RETURNS int(11)
    DETERMINISTIC
BEGIN 
 DECLARE harga_potong_razer INT;
 
 SELECT harga_produk INTO harga_potong_razer FROM produk WHERE nama_produk = 'Razer Phone';
 RETURN harga_potong_razer * 0.97; 
END */$$
DELIMITER ;

/* Function  structure for function  `potongan_harga_samsung` */

/*!50003 DROP FUNCTION IF EXISTS `potongan_harga_samsung` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `potongan_harga_samsung`() RETURNS int(11)
BEGIN 
	DECLARE harga_samsung INT;
	
	SELECT harga_produk INTO harga_samsung FROM produk WHERE nama_produk = 'Samsung Galaxy';
	RETURN harga_samsung - 100000; 
END */$$
DELIMITER ;

/* Function  structure for function  `ratarata_pembayaran` */

/*!50003 DROP FUNCTION IF EXISTS `ratarata_pembayaran` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `ratarata_pembayaran`() RETURNS int(11)
    DETERMINISTIC
BEGIN 
 DECLARE ratarata_bayar INT;
 
 SELECT AVG(jumlah) INTO ratarata_bayar FROM pembayaran;
 RETURN ratarata_bayar; 
END */$$
DELIMITER ;

/* Function  structure for function  `selisih_harga` */

/*!50003 DROP FUNCTION IF EXISTS `selisih_harga` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `selisih_harga`() RETURNS int(11)
BEGIN 
	DECLARE harga_oneplus INT;
	DECLARE harga_razer INT;
	SELECT harga_produk INTO harga_oneplus FROM produk WHERE nama_produk = 'OnePlus 5T';
	SELECT harga_produk INTO harga_razer FROM produk WHERE nama_produk = 'Razer Phone';
	RETURN harga_razer - harga_oneplus; 
END */$$
DELIMITER ;

/* Function  structure for function  `tambah_ongkir` */

/*!50003 DROP FUNCTION IF EXISTS `tambah_ongkir` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `tambah_ongkir`() RETURNS int(11)
BEGIN 
	DECLARE ongkir_jkt INT;
	
	SELECT tarif INTO ongkir_jkt FROM ongkir WHERE nama_kota = 'Jakarta';
	RETURN ongkir_jkt + 10000; 
END */$$
DELIMITER ;

/* Function  structure for function  `tambah_ongkirsby` */

/*!50003 DROP FUNCTION IF EXISTS `tambah_ongkirsby` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `tambah_ongkirsby`() RETURNS int(11)
    DETERMINISTIC
BEGIN 
 DECLARE ongkir_sby INT;
 
 SELECT tarif INTO ongkir_sby FROM ongkir WHERE nama_kota = 'Surabaya';
 RETURN ongkir_sby * 0.9; 
END */$$
DELIMITER ;

/* Function  structure for function  `total_barang_dikirim` */

/*!50003 DROP FUNCTION IF EXISTS `total_barang_dikirim` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `total_barang_dikirim`() RETURNS int(11)
BEGIN 
	DECLARE total_dikirim INT;
	
	SELECT COUNT(id_pembelian) INTO total_dikirim FROM pembelian WHERE status_pembelian = 'barang dikirim';
	RETURN total_dikirim; 
END */$$
DELIMITER ;

/* Function  structure for function  `total_lunas` */

/*!50003 DROP FUNCTION IF EXISTS `total_lunas` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `total_lunas`() RETURNS int(11)
BEGIN 
	DECLARE total_lns INT;
	
	SELECT COUNT(id_pembelian) INTO total_lns FROM pembelian WHERE status_pembelian = 'lunas';
	RETURN total_lns; 
END */$$
DELIMITER ;

/* Function  structure for function  `total_pembayaran` */

/*!50003 DROP FUNCTION IF EXISTS `total_pembayaran` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `total_pembayaran`() RETURNS int(11)
BEGIN 
	DECLARE total_bayar INT;
	
	SELECT SUM(jumlah) INTO total_bayar FROM pembayaran;
	RETURN total_bayar; 
END */$$
DELIMITER ;

/* Function  structure for function  `total_pending` */

/*!50003 DROP FUNCTION IF EXISTS `total_pending` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `total_pending`() RETURNS int(11)
BEGIN 
	DECLARE total_pdg INT;
	
	SELECT COUNT(id_pembelian) INTO total_pdg FROM pembelian WHERE status_pembelian = 'pending';
	RETURN total_pdg; 
END */$$
DELIMITER ;

/* Function  structure for function  `total_terjual` */

/*!50003 DROP FUNCTION IF EXISTS `total_terjual` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `total_terjual`() RETURNS int(11)
BEGIN 
	DECLARE total_jual INT;
	
	SELECT SUM(jumlah) INTO total_jual FROM pembelian_produk;
	RETURN total_jual; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `diskon` */

/*!50003 DROP PROCEDURE IF EXISTS  `diskon` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `diskon`(produk_id INT)
BEGIN
	DECLARE total_diskon INT;
	UPDATE produk
	SET harga_produk = harga_produk * 0.95
	WHERE id_produk = produk_id;
END */$$
DELIMITER ;

/*Table structure for table `v_admin` */

DROP TABLE IF EXISTS `v_admin`;

/*!50001 DROP VIEW IF EXISTS `v_admin` */;
/*!50001 DROP TABLE IF EXISTS `v_admin` */;

/*!50001 CREATE TABLE  `v_admin`(
 `id_admin` int(11) ,
 `username` varchar(100) ,
 `password` varchar(100) ,
 `nama_lengkap` varchar(100) 
)*/;

/*Table structure for table `v_ongkir` */

DROP TABLE IF EXISTS `v_ongkir`;

/*!50001 DROP VIEW IF EXISTS `v_ongkir` */;
/*!50001 DROP TABLE IF EXISTS `v_ongkir` */;

/*!50001 CREATE TABLE  `v_ongkir`(
 `id_ongkir` int(5) ,
 `nama_kota` varchar(100) ,
 `tarif` int(11) 
)*/;

/*Table structure for table `v_pelanggan` */

DROP TABLE IF EXISTS `v_pelanggan`;

/*!50001 DROP VIEW IF EXISTS `v_pelanggan` */;
/*!50001 DROP TABLE IF EXISTS `v_pelanggan` */;

/*!50001 CREATE TABLE  `v_pelanggan`(
 `id_pelanggan` int(11) ,
 `email_pelanggan` varchar(100) ,
 `password_pelanggan` varchar(50) ,
 `nama_pelanggan` varchar(100) 
)*/;

/*Table structure for table `v_pembayaran` */

DROP TABLE IF EXISTS `v_pembayaran`;

/*!50001 DROP VIEW IF EXISTS `v_pembayaran` */;
/*!50001 DROP TABLE IF EXISTS `v_pembayaran` */;

/*!50001 CREATE TABLE  `v_pembayaran`(
 `id_pembayaran` int(11) ,
 `id_pembelian` int(11) ,
 `nama` varchar(255) ,
 `bank` varchar(255) ,
 `jumlah` int(11) ,
 `tanggal` date ,
 `bukti` varchar(255) 
)*/;

/*Table structure for table `v_pembelian` */

DROP TABLE IF EXISTS `v_pembelian`;

/*!50001 DROP VIEW IF EXISTS `v_pembelian` */;
/*!50001 DROP TABLE IF EXISTS `v_pembelian` */;

/*!50001 CREATE TABLE  `v_pembelian`(
 `id_pembelian` int(11) ,
 `id_pelanggan` int(11) ,
 `id_ongkir` int(11) ,
 `tanggal_pembelian` date ,
 `total_pembelian` int(11) ,
 `status_pembelian` varchar(100) ,
 `resi_pengiriman` varchar(50) 
)*/;

/*Table structure for table `v_pembelian_produk` */

DROP TABLE IF EXISTS `v_pembelian_produk`;

/*!50001 DROP VIEW IF EXISTS `v_pembelian_produk` */;
/*!50001 DROP TABLE IF EXISTS `v_pembelian_produk` */;

/*!50001 CREATE TABLE  `v_pembelian_produk`(
 `id_pembelian_produk` int(11) ,
 `id_pembelian` int(11) ,
 `id_produk` int(11) ,
 `jumlah` int(11) 
)*/;

/*Table structure for table `v_produk` */

DROP TABLE IF EXISTS `v_produk`;

/*!50001 DROP VIEW IF EXISTS `v_produk` */;
/*!50001 DROP TABLE IF EXISTS `v_produk` */;

/*!50001 CREATE TABLE  `v_produk`(
 `id_produk` int(11) ,
 `nama_produk` varchar(100) ,
 `harga_produk` int(11) ,
 `foto_produk` varchar(100) ,
 `deskripsi_produk` text ,
 `stok_produk` int(5) 
)*/;

/*View structure for view v_admin */

/*!50001 DROP TABLE IF EXISTS `v_admin` */;
/*!50001 DROP VIEW IF EXISTS `v_admin` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_admin` AS select `admin`.`id_admin` AS `id_admin`,`admin`.`username` AS `username`,`admin`.`password` AS `password`,`admin`.`nama_lengkap` AS `nama_lengkap` from `admin` */;

/*View structure for view v_ongkir */

/*!50001 DROP TABLE IF EXISTS `v_ongkir` */;
/*!50001 DROP VIEW IF EXISTS `v_ongkir` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ongkir` AS select `ongkir`.`id_ongkir` AS `id_ongkir`,`ongkir`.`nama_kota` AS `nama_kota`,`ongkir`.`tarif` AS `tarif` from `ongkir` */;

/*View structure for view v_pelanggan */

/*!50001 DROP TABLE IF EXISTS `v_pelanggan` */;
/*!50001 DROP VIEW IF EXISTS `v_pelanggan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pelanggan` AS select `pelanggan`.`id_pelanggan` AS `id_pelanggan`,`pelanggan`.`email_pelanggan` AS `email_pelanggan`,`pelanggan`.`password_pelanggan` AS `password_pelanggan`,`pelanggan`.`nama_pelanggan` AS `nama_pelanggan` from `pelanggan` */;

/*View structure for view v_pembayaran */

/*!50001 DROP TABLE IF EXISTS `v_pembayaran` */;
/*!50001 DROP VIEW IF EXISTS `v_pembayaran` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembayaran` AS select `pembayaran`.`id_pembayaran` AS `id_pembayaran`,`pembayaran`.`id_pembelian` AS `id_pembelian`,`pembayaran`.`nama` AS `nama`,`pembayaran`.`bank` AS `bank`,`pembayaran`.`jumlah` AS `jumlah`,`pembayaran`.`tanggal` AS `tanggal`,`pembayaran`.`bukti` AS `bukti` from `pembayaran` */;

/*View structure for view v_pembelian */

/*!50001 DROP TABLE IF EXISTS `v_pembelian` */;
/*!50001 DROP VIEW IF EXISTS `v_pembelian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian` AS select `pembelian`.`id_pembelian` AS `id_pembelian`,`pembelian`.`id_pelanggan` AS `id_pelanggan`,`pembelian`.`id_ongkir` AS `id_ongkir`,`pembelian`.`tanggal_pembelian` AS `tanggal_pembelian`,`pembelian`.`total_pembelian` AS `total_pembelian`,`pembelian`.`status_pembelian` AS `status_pembelian`,`pembelian`.`resi_pengiriman` AS `resi_pengiriman` from `pembelian` */;

/*View structure for view v_pembelian_produk */

/*!50001 DROP TABLE IF EXISTS `v_pembelian_produk` */;
/*!50001 DROP VIEW IF EXISTS `v_pembelian_produk` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian_produk` AS select `pembelian_produk`.`id_pembelian_produk` AS `id_pembelian_produk`,`pembelian_produk`.`id_pembelian` AS `id_pembelian`,`pembelian_produk`.`id_produk` AS `id_produk`,`pembelian_produk`.`jumlah` AS `jumlah` from `pembelian_produk` */;

/*View structure for view v_produk */

/*!50001 DROP TABLE IF EXISTS `v_produk` */;
/*!50001 DROP VIEW IF EXISTS `v_produk` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_produk` AS select `produk`.`id_produk` AS `id_produk`,`produk`.`nama_produk` AS `nama_produk`,`produk`.`harga_produk` AS `harga_produk`,`produk`.`foto_produk` AS `foto_produk`,`produk`.`deskripsi_produk` AS `deskripsi_produk`,`produk`.`stok_produk` AS `stok_produk` from `produk` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
