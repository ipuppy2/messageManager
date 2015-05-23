<?php
	/**
	 * 基控制器
	 * 所有的控制都继承它
	 */
	class BaseController extends Controller{
		public $sPageTitle='页面标题';
		public $layout='//layouts/message';


		/**
		 * 载入上传图片的视图
		 * @param  array  $aData [description]
		 * @return [type]        [description]
		 */
		protected function uploadImage($aData=array()){
			// if(!defined('B_USE_IFRAME'))  throw new CHttpException('404');
			$this->renderPartial('//base/uploadImage',$aData);
		}

		/**
		 * 上传图片
		 * @return [type] [description]
		 */
		public function actionToUploadImage(){
			$this->renderPartial('//base/toUploadImage');
		}
	}

	/*
		1, 判断是否为 ajax 请求
			Yii::app()->request->isAjaxRequest;
			http://www.111cn.net/phper/php-mb/62573.htm
	 */