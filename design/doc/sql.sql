CREATE DATABASE `chu_message` DEFAULT CHARACTER SET utf8;

/**
 * 上网账号表
 */
CREATE TABLE `chu_net_account`(
	`account_id` INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	`user_id` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
	`user_name` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '用户名(这是一个预留字段,因为用户不可以修改,所以可以保存到这里)',
	`account_user_name` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '账号的用户名',
	`account_password` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '账号的密码',
	`account_web_url` VARCHAR(2048) NOT NULL DEFAULT '' COMMENT '账号注册的网址',
	`account_register_date` INT(11) NOT NULL DEFAULT '' COMMENT '注册时间',
	`account_link_email` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '账号关联的邮箱',
	`account_link_qq` VARCHAR(16) NOT NULL DEFAULT '' COMMENT '账号关联的qq',
	`account_other_describe` VARCHAR(4096) NOT NULL DEFAULT '' COMMENT '其它的说明',
	`accountc_add_date` INT(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账号添加的日期',
	`account_refresh_date` INT(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '账号信息更新的日期'
) DEFAULT CHARACTER SET utf8 ENGINE MYISAM;