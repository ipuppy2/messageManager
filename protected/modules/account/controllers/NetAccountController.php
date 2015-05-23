<?php
	/**
	 * 上网账号
	 */
	class NetAccountController extends AccountController{
		private $_oModel; // 当前的模型
		public $defaultAction='edit';

		/**
		 * 编辑上网账号
		 * @return [type] [description]
		 */
		public function actionEdit(){

			$this->_oModel=new NetAccount();

			$this->render('edit',array('oModel'=>$this->_oModel));
		}

		public function actionUploadImage(){
			define('B_USE_IFRAME',true);
			$this->uploadImage(array(
				'oModel'=>new NetAccount(),
			));
		}
	}