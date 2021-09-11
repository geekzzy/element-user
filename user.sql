/*
 Navicat Premium Data Transfer

 Source Server         : phpenv
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : localhost:3306
 Source Schema         : element

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 10/09/2021 22:47:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `sex` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '张美玉', '2000-01-01', '女', '黑龙江');
INSERT INTO `user` VALUES (2, '冯双双', '2000-01-01', '女', '黑龙江');
INSERT INTO `user` VALUES (3, '景宇彤', '2000-01-01', '女', '黑龙江');
INSERT INTO `user` VALUES (4, '李佳静', '2000-01-01', '女', '黑龙江');
INSERT INTO `user` VALUES (5, '范歆岄', '2000-01-01', '女', '黑龙江');
INSERT INTO `user` VALUES (6, '宋文静', '2000-01-01', '女', '黑龙江');

SET FOREIGN_KEY_CHECKS = 1;
