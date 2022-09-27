/*
SQLyog Ultimate
MySQL - 10.4.17-MariaDB : Database - db_cuti_pegawai
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_cuti_pegawai` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_cuti_pegawai`;

/*Table structure for table `aplikasi` */

DROP TABLE IF EXISTS `aplikasi`;

CREATE TABLE `aplikasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `aplikasi` */

insert  into `aplikasi`(`id`,`nama_owner`,`alamat`,`tlp`,`title`,`nama_aplikasi`,`logo`,`copy_right`,`versi`,`tahun`) values 
(1,'BNN Kota Kediri','JL. Selomangleng No.3 Kel. Pojok Kec. Mojoroto Kota Kediri','0354-777333','Web Cuti Pegawai','Web Cuti Pegawai','logobnn.png','Copy Right &copy;','1.0.0.0',2022);

/*Table structure for table `tbl_akses_menu` */

DROP TABLE IF EXISTS `tbl_akses_menu`;

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_akses_menu` */

insert  into `tbl_akses_menu`(`id`,`id_level`,`id_menu`,`view_level`) values 
(1,1,1,'Y'),
(2,1,2,'Y'),
(3,1,3,'Y'),
(4,1,4,'Y'),
(5,2,1,'Y'),
(6,2,3,'Y'),
(7,2,4,'Y'),
(8,3,1,'Y'),
(9,3,5,'Y'),
(10,4,1,'Y'),
(11,4,6,'Y');

/*Table structure for table `tbl_akses_submenu` */

DROP TABLE IF EXISTS `tbl_akses_submenu`;

CREATE TABLE `tbl_akses_submenu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  `add_level` enum('Y','N') DEFAULT 'N',
  `edit_level` enum('Y','N') DEFAULT 'N',
  `delete_level` enum('Y','N') DEFAULT 'N',
  `print_level` enum('Y','N') DEFAULT 'N',
  `upload_level` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_akses_submenu` */

insert  into `tbl_akses_submenu`(`id`,`id_level`,`id_submenu`,`view_level`,`add_level`,`edit_level`,`delete_level`,`print_level`,`upload_level`) values 
(1,1,1,'Y','Y','Y','Y','Y','Y'),
(2,1,2,'Y','Y','Y','Y','Y','Y'),
(3,1,3,'Y','Y','Y','Y','Y','Y'),
(4,1,4,'Y','Y','Y','Y','Y','Y'),
(5,1,5,'Y','Y','Y','Y','Y','Y'),
(6,1,6,'Y','Y','Y','Y','Y','Y'),
(7,1,7,'Y','N','N','N','Y','N'),
(8,1,8,'Y','N','N','N','Y','N'),
(9,1,9,'Y','N','N','N','N','N'),
(10,1,10,'Y','N','Y','N','N','N'),
(11,2,6,'Y','N','N','N','N','N'),
(12,2,7,'Y','N','N','N','N','N'),
(13,2,8,'Y','N','N','N','N','N'),
(14,3,9,'Y','Y','Y','Y','Y','Y'),
(15,4,10,'Y','Y','Y','Y','Y','Y');

/*Table structure for table `tbl_data_pegawai` */

DROP TABLE IF EXISTS `tbl_data_pegawai`;

CREATE TABLE `tbl_data_pegawai` (
  `id_pegawai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nrpnip` char(20) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `masa_kerja` varchar(20) DEFAULT NULL,
  `unit_kerja` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_data_pegawai` */

insert  into `tbl_data_pegawai`(`id_pegawai`,`nrpnip`,`nama`,`jabatan`,`masa_kerja`,`unit_kerja`,`image`) values 
(1,'2130131','Yuliana Ika Dewi','P2M','5 tahun','P2M','2130131.jpg'),
(8,'7657','afasfsa','vcvx','ddfasdsahhhhh','3 dgdg','7657.png'),
(11,'43','rtetteeeee','fd6jhh','cds','fgdf','43.jpg');

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(`id_menu`,`nama_menu`,`link`,`icon`,`urutan`,`is_active`,`parent`) values 
(1,'Dashboard','dashboard','fas fa-tachometer-alt',1,'Y','Y'),
(2,'System','#','fas fa-cogs',2,'Y','Y'),
(3,'Master Data','#','fas fa-tachometer-alt',3,'Y','Y'),
(4,'Pengajuan Pegawai','#','fas fa-edit',4,'Y','Y'),
(5,'Pengajuan Pegawai Pelaksana','#','fas fa-edit',5,'Y','Y'),
(6,'Pengajuan Pegawai Kontrak','#','fas fa-edit',6,'Y','Y');

/*Table structure for table `tbl_pengajuan_pns` */

DROP TABLE IF EXISTS `tbl_pengajuan_pns`;

CREATE TABLE `tbl_pengajuan_pns` (
  `id_pns` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nrpnip` char(20) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `masa_kerja` varchar(20) DEFAULT NULL,
  `unit_kerja` varchar(20) DEFAULT NULL,
  `jenis_cuti` enum('Cuti Tahunan','Cuti Besar','Cuti Sakit','Cuti Melahirkan','Cuti Karena Alasan Penting','Cuti di Luar Tanggunan Negara') DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `jmlh_cuti` varchar(10) DEFAULT NULL,
  `sisa_cuti` varchar(10) DEFAULT NULL,
  `alamat_cuti` varchar(50) DEFAULT NULL,
  `telp` char(20) DEFAULT NULL,
  `status` enum('Disetujui','Perubahan','Ditangguhkan','Tidak Disetujui','Belum Dikonfirmasi') NOT NULL DEFAULT 'Belum Dikonfirmasi',
  PRIMARY KEY (`id_pns`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_pengajuan_pns` */

insert  into `tbl_pengajuan_pns`(`id_pns`,`nrpnip`,`nama`,`jabatan`,`masa_kerja`,`unit_kerja`,`jenis_cuti`,`alasan`,`tgl_awal`,`tgl_akhir`,`jmlh_cuti`,`sisa_cuti`,`alamat_cuti`,`telp`,`status`) values 
(1,'432','eqw','wewq','dsda','dasda','Cuti Karena Alasan Penting','cxzxzxasda','2022-08-25','2022-08-29','3 Hari','43','dadafaf','0884326428','Ditangguhkan'),
(2,'65464','dsdf','gg','32ff','ffs','Cuti Melahirkan','sfsfrew','2022-09-01','2022-09-10','9 Hari','30','deew','08233914141','Disetujui'),
(3,'314','sda','htg','gdg','fgdf','Cuti di Luar Tanggunan Negara','fsfsgeeee','2022-09-05','2022-09-10','10 Hari','564','fsdada','08421523412','Perubahan');

/*Table structure for table `tbl_pengajuan_ppnpn` */

DROP TABLE IF EXISTS `tbl_pengajuan_ppnpn`;

CREATE TABLE `tbl_pengajuan_ppnpn` (
  `id_ppnpn` int(11) NOT NULL AUTO_INCREMENT,
  `nrpnip` char(20) DEFAULT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `unit_kerja` varchar(20) DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `status` enum('Disetujui','Perubahan','Ditangguhkan','Tidak Disetujui','Belum Dikonfirmasi') NOT NULL DEFAULT 'Belum Dikonfirmasi',
  PRIMARY KEY (`id_ppnpn`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_pengajuan_ppnpn` */

insert  into `tbl_pengajuan_ppnpn`(`id_ppnpn`,`nrpnip`,`nama`,`unit_kerja`,`keperluan`,`tgl_awal`,`tgl_akhir`,`status`) values 
(1,'3343','Indah','Rehab','Acara Keluarga','2022-08-19','2022-08-22','Disetujui'),
(2,'112','Sabto Pamungkas','P2M','Ijin','2022-08-10','2022-08-10','Belum Dikonfirmasi'),
(3,'111111','sfhs','sss','gssgsj','2022-08-11','2022-08-11','Disetujui'),
(4,'24363556','Sabto Pamungkas','P2M','Ijin','2022-08-11','2022-08-11','Ditangguhkan'),
(5,'3131','rdwfsdf','sad','daddasdasd','2022-08-12','2022-08-16','Ditangguhkan'),
(6,'24363530','Ina Anisa P','P2M','Ijin Sakit','2022-08-11','2022-08-11','Perubahan'),
(7,'424','ewe','rwer','ewrw','2022-08-15','2022-08-31','Tidak Disetujui');

/*Table structure for table `tbl_submenu` */

DROP TABLE IF EXISTS `tbl_submenu`;

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_submenu`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_submenu` */

insert  into `tbl_submenu`(`id_submenu`,`nama_submenu`,`link`,`icon`,`id_menu`,`is_active`) values 
(1,'Menu','menu','far fa-circle',2,'Y'),
(2,'SubMenu','submenu','far fa-circle',2,'Y'),
(3,'Aplikasi','aplikasi','far fa-circle',2,'Y'),
(4,'User','user','far fa-circle',2,'Y'),
(5,'User Level','userlevel','far fa-circle',2,'Y'),
(6,'Data Pegawai','datapegawai','far fa-circle',3,'Y'),
(7,'Pengajuan Cuti PNS','pengajuancutipns','far fa-circle',4,'Y'),
(8,'Pengajuan Cuti PPNPN','pengajuancutippnpn','far fa-circle',4,'Y'),
(9,'Pengajuan Cuti Pelaksana','pengajuancutipelaksana','far fa-circle',5,'Y'),
(10,'Pengajuan Cuti Kontrak','pengajuancutikontrak','far fa-circle',6,'Y');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`username`,`full_name`,`password`,`id_level`,`image`,`is_active`) values 
(1,'subbag','Sub Bagian Umum','$2y$05$fmkX4cGuH3Bq76fVNgluve0L/h9R580H9MrqL20Dv36BfyoYGs6Li',1,'admin1.jpg','Y'),
(2,'kepala','Kepala BNN Kota Kediri','$2y$05$5ZJ6O7oDsfPmN7LMfJHRYepyjBZT/SOInT3gphzR8uUwqxzBHp7mO',2,'bunawar.png','Y'),
(3,'pns','Pegawai PNS','$2y$05$5wmeZ1BAXAbqQ7Tou5ofKughM5fXGLBmsa1U.kQUOg.5UxodXPww2',3,'p2m.jpg','Y'),
(4,'ppnpn','Pegawai PPNPN','$2y$05$8nqnu9alJc0fRMxBsP8QpeoYMI0JEEynpbdkNWelTy8W0v.DjX9eG',4,'ppnpn.jpg','Y');

/*Table structure for table `tbl_userlevel` */

DROP TABLE IF EXISTS `tbl_userlevel`;

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_userlevel` */

insert  into `tbl_userlevel`(`id_level`,`nama_level`) values 
(1,'subbag'),
(2,'kepala'),
(3,'pns'),
(4,'ppnpn');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
