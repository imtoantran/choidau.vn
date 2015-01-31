/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50622
Source Host           : localhost:3306
Source Database       : db_choidau

Target Server Type    : MYSQL
Target Server Version : 50622
File Encoding         : 65001

Date: 2015-01-30 17:12:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `location_user`
-- ----------------------------
DROP TABLE IF EXISTS `location_user`;
CREATE TABLE `location_user` (
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_type` varchar(255) NOT NULL COMMENT 'luu các loại tương tác của người dùng với location{like.dislike,báo cáo xấu, checkin}',
  PRIMARY KEY (`location_id`,`user_id`,`action_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of location_user
-- ----------------------------
INSERT INTO `location_user` VALUES ('1', '1', 'checkin');
INSERT INTO `location_user` VALUES ('1', '1', 'like');
INSERT INTO `location_user` VALUES ('1', '2', 'checkin');
INSERT INTO `location_user` VALUES ('1', '2', 'like');
INSERT INTO `location_user` VALUES ('2', '1', 'checkin');
