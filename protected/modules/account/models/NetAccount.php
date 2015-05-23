<?php
	/**
	 * 上网账号
	 */
	class NetAccount extends AccountModel{

		const S_TABLE='{{net_account}}'; // 表名


		public static function model($sClass=__CLASS__){
			return parent::model($sClass);
		}

		public function tableName(){
			return self::S_TABLE;
		}

		public function attributeLabels(){
			return array(
				'account_user_name'=>'账号用户名',
				'account_password'=>'账号密码',
				'account_web_url'=>'账号的网址',
				'account_register_date'=>'账号注册的时间',
				'account_link_email'=>'关联的邮箱',
				'account_link_qq'=>'关联的QQ',
				'account_other_describe'=>'其它说明',
				'sImgUploadTitle'=>'附加的图片',
			);
		}

		public function rules(){
			return array(
				array('account_user_name','required','message'=>'请输入账号用户名'),
			);
		}
	}