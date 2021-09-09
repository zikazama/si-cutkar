/*
 Navicat Premium Data Transfer

 Source Server         : xampp mysql
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : si_cuti

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 09/09/2021 21:41:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'fauzi190198@gmail.com', '123456', 'fauzi', NULL, NULL);

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id_karyawan` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_karyawan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `posisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (1, 'aji@gmail.com', '123456', 'Aji Sanjaya', '1998-08-08', 'Teknisi', NULL, NULL);
INSERT INTO `karyawan` VALUES (2, 'taufik@gmail.com', '123456', 'Taufik M', '2001-05-02', 'Software', NULL, '2021-09-09 12:13:30.000000');

-- ----------------------------
-- Table structure for konfig_cuti
-- ----------------------------
DROP TABLE IF EXISTS `konfig_cuti`;
CREATE TABLE `konfig_cuti`  (
  `id_konfig_cuti` int NOT NULL AUTO_INCREMENT,
  `tahun` int NULL DEFAULT NULL,
  `jumlah_cuti` int NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_konfig_cuti`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of konfig_cuti
-- ----------------------------
INSERT INTO `konfig_cuti` VALUES (1, 2021, 20, NULL, NULL);
INSERT INTO `konfig_cuti` VALUES (2, 2022, 40, NULL, '2021-09-09 12:20:32.000000');
INSERT INTO `konfig_cuti` VALUES (4, 2023, 10, '2021-09-09 12:49:24.000000', '2021-09-09 12:49:24.000000');

-- ----------------------------
-- Table structure for pengajuan_cuti
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan_cuti`;
CREATE TABLE `pengajuan_cuti`  (
  `id_pengajuan_cuti` int NOT NULL AUTO_INCREMENT,
  `id_karyawan` int NULL DEFAULT NULL,
  `tanggal_pengajuan` date NULL DEFAULT NULL,
  `lama_cuti` int NULL DEFAULT 1 COMMENT 'dalam hari',
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('verifikasi','disetujui','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'verifikasi',
  `verifikasi_oleh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan_cuti`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuan_cuti
-- ----------------------------
INSERT INTO `pengajuan_cuti` VALUES (1, 1, '2021-09-17', 2, NULL, 'disetujui', 'fauzi', NULL, '2021-09-09 13:00:21.000000');
INSERT INTO `pengajuan_cuti` VALUES (3, 2, '2021-09-10', 1, 'top up', 'disetujui', 'Ayi Putri', '2021-09-09 13:31:17.000000', '2021-09-09 14:34:37.000000');

-- ----------------------------
-- Table structure for staf_hr
-- ----------------------------
DROP TABLE IF EXISTS `staf_hr`;
CREATE TABLE `staf_hr`  (
  `id_staf_hr` int NOT NULL AUTO_INCREMENT,
  `nama_staf_hr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_staf_hr`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of staf_hr
-- ----------------------------
INSERT INTO `staf_hr` VALUES (2, 'Ayi Putri', 'ayi@gmail.com', '123456', NULL, NULL);

-- ----------------------------
-- View structure for sisa_cuti
-- ----------------------------
DROP VIEW IF EXISTS `sisa_cuti`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `sisa_cuti` AS SELECT
	karyawan.id_karyawan,
	karyawan.nama_karyawan,
	konfig_cuti.tahun,
	konfig_cuti.jumlah_cuti,
	(
		select IFNULL(sum(pc.lama_cuti),0) from pengajuan_cuti pc where 
		pc.id_karyawan = karyawan.id_karyawan
		AND SUBSTR(pc.tanggal_pengajuan,1,4) = konfig_cuti.tahun
		AND pc.status = 'disetujui'
	) as cuti_terpakai,
	konfig_cuti.jumlah_cuti - (
		select IFNULL(sum(pc.lama_cuti),0) from pengajuan_cuti pc where 
		pc.id_karyawan = karyawan.id_karyawan
		AND SUBSTR(pc.tanggal_pengajuan,1,4) = konfig_cuti.tahun
		AND pc.status = 'disetujui'
	) as sisa_cuti
FROM
	pengajuan_cuti
	RIGHT JOIN karyawan ON karyawan.id_karyawan = pengajuan_cuti.id_karyawan 
	JOIN konfig_cuti
GROUP BY
	karyawan.id_karyawan, 
	konfig_cuti.tahun 
	ORDER BY karyawan.nama_karyawan , konfig_cuti.tahun ;

SET FOREIGN_KEY_CHECKS = 1;
