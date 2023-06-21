/*
 Navicat Premium Data Transfer

 Source Server         : the Game
 Source Server Type    : MariaDB
 Source Server Version : 100418
 Source Host           : localhost:3306
 Source Schema         : promo

 Target Server Type    : MariaDB
 Target Server Version : 100418
 File Encoding         : 65001

 Date: 08/11/2021 10:51:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for closeReg
-- ----------------------------
DROP TABLE IF EXISTS `closeReg`;
CREATE TABLE `closeReg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of closeReg
-- ----------------------------
BEGIN;
INSERT INTO `closeReg` VALUES (1, 'open');
COMMIT;

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abvr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
BEGIN;
INSERT INTO `countries` VALUES (0, '', '');
INSERT INTO `countries` VALUES (1, 'AL', 'Alabama');
INSERT INTO `countries` VALUES (2, 'AK', 'Alaska');
INSERT INTO `countries` VALUES (3, 'AZ', 'Arizona');
INSERT INTO `countries` VALUES (4, 'AR', 'Arkansas');
INSERT INTO `countries` VALUES (5, 'CA', 'California');
INSERT INTO `countries` VALUES (6, 'CO', 'Colorado');
INSERT INTO `countries` VALUES (7, 'CT', 'Connecticut');
INSERT INTO `countries` VALUES (8, 'DE', 'Delaware');
INSERT INTO `countries` VALUES (9, 'DC', 'District of Columbia');
INSERT INTO `countries` VALUES (10, 'FL', 'Florida');
INSERT INTO `countries` VALUES (11, 'GA', 'Georgia');
INSERT INTO `countries` VALUES (12, 'HI', 'Hawaii');
INSERT INTO `countries` VALUES (13, 'ID', 'Idaho');
INSERT INTO `countries` VALUES (14, 'IL', 'Illinois');
INSERT INTO `countries` VALUES (15, 'IN', 'Indiana');
INSERT INTO `countries` VALUES (16, 'IA', 'Iowa');
INSERT INTO `countries` VALUES (17, 'KS', 'Kansas');
INSERT INTO `countries` VALUES (18, 'KY', 'Kentucky');
INSERT INTO `countries` VALUES (19, 'LA', 'Louisiana');
INSERT INTO `countries` VALUES (20, 'ME', 'Maine');
INSERT INTO `countries` VALUES (21, 'MD', 'Maryland');
INSERT INTO `countries` VALUES (22, 'MA', 'Massachusetts');
INSERT INTO `countries` VALUES (23, 'MI', 'Michigan');
INSERT INTO `countries` VALUES (24, 'MN', 'Minnesota');
INSERT INTO `countries` VALUES (25, 'MS', 'Mississippi');
INSERT INTO `countries` VALUES (26, 'MO', 'Missouri');
INSERT INTO `countries` VALUES (27, 'MT', 'Montana');
INSERT INTO `countries` VALUES (28, 'NE', 'Nebraska');
INSERT INTO `countries` VALUES (29, 'NV', 'Nevada');
INSERT INTO `countries` VALUES (30, 'NH', 'New Hampshire');
INSERT INTO `countries` VALUES (31, 'NJ', 'New Jersey');
INSERT INTO `countries` VALUES (32, 'NM', 'New Mexico');
INSERT INTO `countries` VALUES (33, 'NY', 'New York');
INSERT INTO `countries` VALUES (34, 'NC', 'North Carolina');
INSERT INTO `countries` VALUES (35, 'ND', 'North Dakota');
INSERT INTO `countries` VALUES (36, 'OH', 'Ohio');
INSERT INTO `countries` VALUES (37, 'OK', 'Oklahoma');
INSERT INTO `countries` VALUES (38, 'OR', 'Oregon');
INSERT INTO `countries` VALUES (39, 'PA', 'Pennsylvania');
INSERT INTO `countries` VALUES (40, 'RI', 'Rhode Island');
INSERT INTO `countries` VALUES (41, 'SC', 'South Carolina');
INSERT INTO `countries` VALUES (42, 'SD', 'South Dakota');
INSERT INTO `countries` VALUES (43, 'TN', 'Tennessee');
INSERT INTO `countries` VALUES (44, 'TX', 'Texas');
INSERT INTO `countries` VALUES (45, 'UT', 'Utah');
INSERT INTO `countries` VALUES (46, 'VT', 'Vermont');
INSERT INTO `countries` VALUES (47, 'VA', 'Virginia');
INSERT INTO `countries` VALUES (48, 'WA', 'Washington');
INSERT INTO `countries` VALUES (49, 'WV', 'West Virginia');
INSERT INTO `countries` VALUES (50, 'WI', 'Wisconsin');
INSERT INTO `countries` VALUES (51, 'WY', 'Wyoming');
INSERT INTO `countries` VALUES (52, '', '');
INSERT INTO `countries` VALUES (53, 'out', 'Outside USA');
COMMIT;

-- ----------------------------
-- Table structure for gamePromotion
-- ----------------------------
DROP TABLE IF EXISTS `gamePromotion`;
CREATE TABLE `gamePromotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promotionBody` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of gamePromotion
-- ----------------------------
BEGIN;
INSERT INTO `gamePromotion` VALUES (1, '<p>Not set</p>\n', '');
COMMIT;

-- ----------------------------
-- Table structure for gridStatus
-- ----------------------------
DROP TABLE IF EXISTS `gridStatus`;
CREATE TABLE `gridStatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of gridStatus
-- ----------------------------
BEGIN;
INSERT INTO `gridStatus` VALUES (1, '');
COMMIT;

-- ----------------------------
-- Table structure for gridUniq
-- ----------------------------
DROP TABLE IF EXISTS `gridUniq`;
CREATE TABLE `gridUniq` (
  `grid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of gridUniq
-- ----------------------------
BEGIN;
INSERT INTO `gridUniq` VALUES (1);
COMMIT;

-- ----------------------------
-- Table structure for leftGridLine
-- ----------------------------
DROP TABLE IF EXISTS `leftGridLine`;
CREATE TABLE `leftGridLine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leftGrid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of leftGridLine
-- ----------------------------
BEGIN;
INSERT INTO `leftGridLine` VALUES (0, '', '');
INSERT INTO `leftGridLine` VALUES (1, '', '');
INSERT INTO `leftGridLine` VALUES (2, '', '');
INSERT INTO `leftGridLine` VALUES (3, '', '');
INSERT INTO `leftGridLine` VALUES (4, '', '');
INSERT INTO `leftGridLine` VALUES (5, '', '');
INSERT INTO `leftGridLine` VALUES (6, '', '');
INSERT INTO `leftGridLine` VALUES (7, '', '');
INSERT INTO `leftGridLine` VALUES (8, '', '');
INSERT INTO `leftGridLine` VALUES (9, '', '');
COMMIT;

-- ----------------------------
-- Table structure for quarterWinners
-- ----------------------------
DROP TABLE IF EXISTS `quarterWinners`;
CREATE TABLE `quarterWinners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qtrId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leftValueId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rightValueId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of quarterWinners
-- ----------------------------
BEGIN;
INSERT INTO `quarterWinners` VALUES (1, '', '', '', '');
INSERT INTO `quarterWinners` VALUES (2, '', '', '', '');
INSERT INTO `quarterWinners` VALUES (3, '', '', '', '');
INSERT INTO `quarterWinners` VALUES (4, '', '', '', '');
COMMIT;

-- ----------------------------
-- Table structure for systemSettings
-- ----------------------------
DROP TABLE IF EXISTS `systemSettings`;
CREATE TABLE `systemSettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of systemSettings
-- ----------------------------
BEGIN;
INSERT INTO `systemSettings` VALUES (1, 'bd61ae30ba4be9462a0e596543194439', '01-13-21 02:01');
COMMIT;

-- ----------------------------
-- Table structure for teams
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of teams
-- ----------------------------
BEGIN;
INSERT INTO `teams` VALUES (1, 'TOP1000', '#0033ff');
INSERT INTO `teams` VALUES (2, 'KANSAS CITY', '#ca2430');
COMMIT;

-- ----------------------------
-- Table structure for topGridLine
-- ----------------------------
DROP TABLE IF EXISTS `topGridLine`;
CREATE TABLE `topGridLine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topGrid` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of topGridLine
-- ----------------------------
BEGIN;
INSERT INTO `topGridLine` VALUES (0, '', '');
INSERT INTO `topGridLine` VALUES (1, '', '');
INSERT INTO `topGridLine` VALUES (2, '', '');
INSERT INTO `topGridLine` VALUES (3, '', '');
INSERT INTO `topGridLine` VALUES (4, '', '');
INSERT INTO `topGridLine` VALUES (5, '', '');
INSERT INTO `topGridLine` VALUES (6, '', '');
INSERT INTO `topGridLine` VALUES (7, '', '');
INSERT INTO `topGridLine` VALUES (8, '', '');
INSERT INTO `topGridLine` VALUES (9, '', '');
COMMIT;

-- ----------------------------
-- Table structure for userReg
-- ----------------------------
DROP TABLE IF EXISTS `userReg`;
CREATE TABLE `userReg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPosition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userCompany` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userEmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userRep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gridId` int(11) NOT NULL,
  `squareId` int(11) NOT NULL,
  `regDate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4445 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of userReg
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
