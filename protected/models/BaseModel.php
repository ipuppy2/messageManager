<?php
	/**
	 * 基模型
	 * 所有的模型都继承它
	 */
	class BaseModel extends CActiveRecord{
		public $sImgUploadTitle; // 附加的图片
		public $aUploadImageFileFieldListName; // 图片上传的表单名称
		public $aUploadedImageListName; // 已经上传的图片表单名称(隐藏域)

	}