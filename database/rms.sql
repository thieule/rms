/*
Navicat MySQL Data Transfer

Source Server         : rms
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : rms

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-09 17:17:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for acl_permissions
-- ----------------------------
DROP TABLE IF EXISTS `acl_permissions`;
CREATE TABLE `acl_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ident` varchar(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;



-- ----------------------------
-- Table structure for acl_permission_groups
-- ----------------------------
DROP TABLE IF EXISTS `acl_permission_groups`;
CREATE TABLE `acl_permission_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;


-- ----------------------------
-- Table structure for acl_roles
-- ----------------------------
DROP TABLE IF EXISTS `acl_roles`;
CREATE TABLE `acl_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `agency_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of acl_roles
-- ----------------------------

-- ----------------------------
-- Table structure for acl_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `acl_role_permission`;
CREATE TABLE `acl_role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of acl_role_permission
-- ----------------------------

-- ----------------------------
-- Table structure for acl_user_role
-- ----------------------------
DROP TABLE IF EXISTS `acl_user_role`;
CREATE TABLE `acl_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of acl_user_role
-- ----------------------------

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `skills` text,
  `introduction_short` text,
  `address` text,
  `join_date` date DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `brithday` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `marital_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee
-- ----------------------------

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT 'Nam of Icon',
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project
-- ----------------------------


-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `agency_entity_id` int(11) NOT NULL,
  `agency_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agency_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `agency_parent_id` varchar(59) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('member','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'member',
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `email_confirm` tinyint(4) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('24', 'Thieu Le Quang', 'quangthieuagu@gmail.com', '25d55ad283aa400af464c76d713c07ad', '266', 'Đại Lý bán sỉ IPAD', 'HCM1985', 'HCM123', 'admin', '1', '1', '10', '64eabde55be6fc85d8d930e959d2e9be', '2015-09-17 07:51:00', '2015-09-18 07:19:00');

-- ----------------------------
-- Table structure for user_groups
-- ----------------------------
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `agency_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for user_group_permission
-- ----------------------------
DROP TABLE IF EXISTS `user_group_permission`;
CREATE TABLE `user_group_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
