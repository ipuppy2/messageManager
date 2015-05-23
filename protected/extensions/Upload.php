<?php
	/**
	 * 文件上传
	 * 1, 表单域的 name
	 * 2, 上传的类型
	 * 3, 最大大小
	 * 4, 保存的目录
	 * 5, 当目录不存在时,是否创建目录(默认自动创建)
	 */
	class Upload{
		public static $multiArray=false; // 表示多维数组
		public static $multiFileName; // 如果是多维数组,则要再提供索引表单名

		private $_sFileName; // 表单名称
		private $_mixType='*';  //文件类型
		private $_iMaxSize=0; // 最大大小
		private $_sSaveDir='./'; // 保存的目录
		private $_bMakeDir=true; // 是否自动创建目录
		private $_iMaxCount; // 最大的上传数(如果是多文件上传)

		private $_sErrorMsg=''; // 错误的信息
		private $_aFiles; // 上传的文件
		private $_aErrorCode; // 
		private $_sAcceptImageType='/(?:\.jpg|\.jpeg|\.png|\.gif)$/i'; // 如果是其中的指定的图片类型,则要

		/**
		 * 构造方法
		 * @param [type]  $sFileName [表单名称]
		 * @param string  $sSaveDir  [保存的目录]
		 * @param string  $mixType     [文件的类型]
		 * @param integer $iMaxSize  [最大的大小(单位:m)]
		 * @param [type]  $bMakeDir  [当目录不存在时,是否创建]
		 */
		public function __construct($sFileName,$sSaveDir='./',$mixType='*',$iMaxSize=0,$bMakeDir=true){
			$this->_sFileName=$sFileName;
			$this->_sSaveDir=$sSaveDir;
			$this->_mixType=$mixType;
			$this->_iMaxSize=$iMaxSize>0?1024*1024*$this->_iMaxSize:2147483247; // 最大
			$this->_bMakeDir=rtrim(preg_replace(array('/\\\\+/','/\/+/'),array('/','/'),$bMakeDir),'/').'/';
		}

		/**
		 * 多文件上传
		 * @param  integer $iMaxCount [最大上传数]
		 * @return [type]             [description]
		 */
		public function multiUpload($iMaxCount=0){
			$this->_iMaxCount=$iMaxCount; // 最大上传数
			
			if(!$this->getMultiPostData()) return false;

			// 在这里上传
			return $this->mainUpload();

		}

		/**
		 * 单文件上传
		 * @return [type] [description]
		 */
		public function toUpload(){}

		/**
		 * 过滤空白的项
		 * @param  [type] $iErrorCode [description]
		 * @return [type]          [description]
		 */
		public function filterEmpty($iErrorCode){
			return 4!=$iErrorCode;
		}

		/**
		 * 检测提交的数据
		 * @return [type] [description]
		 */
		private function getMultiPostData(){
			if(self::$multiArray):
				// 如果是多维数组
				
				if(!isset($_FILES[$this->_sFileName]) or !isset($_FILES[$this->_sFileName]['name'][self::$multiFileName])):
					$this->_sErrorMsg='没有上传的文件';
					// echo 111;
					return false;
				endif;

				// 重构上传数据
				// name
				$aFileName=$_FILES[$this->_sFileName]['name'][self::$multiFileName]; // 文件名
				$aFileType=$_FILES[$this->_sFileName]['type'][self::$multiFileName];

				foreach($_FILES[$this->_sFileName] as $sKey=>$aFileParam):
					foreach($aFileParam[self::$multiFileName] as $sUpData):
						$this->_aFiles[$sKey][]=$sUpData;
					endforeach;
				endforeach;

			else:
				// 判断表单是否存在 并且 判断是否为数组
				if(!isset($_FILES[$this->_sFileName]) or !is_array($_FILES[$this->_sFileName])):
					$this->_sErrorMsg='没有上传的文件';
					return false;
				endif;

				$this->_aFiles=$_FILES[$this->_sFileName];
			endif;

			$this->_aErrorCode=array_filter($this->_aFiles['error'],array($this,'filterEmpty'));
			


			// 如果没有内容,则代表没有上传的文件
			if(empty($this->_aErrorCode)):
				$this->_sErrorMsg='没有上传的文件';
				return false;
			endif;

			// 如果有上传数量限制
			// if($this->_iMaxCount>0 and count($this->_aErrorCode)):

			// endif;

			return true;
		}

		/**
		 * 主上传方法
		 * @return [type] [description]
		 */
		private function mainUpload(){
			CX::p($this->_aFiles,$this->_aErrorCode);




			// 创建目录
			$this->_bMakeDir and !is_dir($this->_sSaveDir) and mkdir($this->_sSaveDir,0777,true);

			$aError=array(); // 上传失败的文件
			$aSuccess=array(); // 上传成功的文件

			$aName=$this->_aFiles['name']; // 文件名
			$aType=$this->_aFiles['type']; // 文件类型
			$aTmpName=$this->_aFiles['tmp_name']; // 临时路径
			$aSize=$this->_aFiles['size']; // 大小

			// _mixType
			if(is_string($this->_mixType)){

				$this->_mixType='*'==trim($this->_mixType)?true:explode(',',str_replace(' ','',$this->_mixType));

			}

			if(true!==$this->_mixType):
				// $aTmpType=$this->_mixType;
				// $this->_mixType=array();
				foreach($this->_mixType as $iKey=>$sType):
					$this->_mixType[$iKey]='.'.strtolower($sType);
				endforeach;
			endif;



			// 如果有上传限制
			if($this->_iMaxCount>0):
				$iUploadedCount=0; // 已经上传的数量
				$aOverFile=array(); // 超过的文件
				foreach($this->_aErrorCode as $iKey=>$sVal):
					
					// 检测上传数量
					if($iUploadedCount>=$this->_iMaxCount){
						$aOverFile[]=array(
							'name'=>$aName[$iKey],
							'error'=>'超出上传数量',
							'errorCode'=>3,
						);
						continue;
					}

					// 检测大小
					// $this->_iMaxSize
					if($aSize[$iKey]>$this->_iMaxSize){
						$aError[]=array(
							'name'=>$aName[$iKey],
							'error'=>'文件过大',
							'errorCode'=>1,
						);

						continue;
					}

					$sFileExtension=strtolower(strrchr($aName[$iKey],'.')); // 文件扩展名

					// 检测类型
					if(true===$this->_mixType){
						// 代表有指定类型
						if(!in_array($sFileExtension,$this->_mixType)){
							$aError[]=array(
								'name'=>$aName[$iKey],
								'error'=>'文件类型不对',
								'errorCode'=>2,
							);
							continue;
						}
					}

					if(!is_uploaded_file($aTmpName[$iKey])){

						$aError[]=array(
							'name'=>$aName[$iKey],
							'error'=>'非上传的文件',
							'errorCode'=>4,
						);
						continue;
					}


					$sSaveName=self::generateFileName().$sFileExtension; // 文件名
					$sSavePath=$this->_bMakeDir.$sSaveName; // 保存路径
					if(move_uploaded_file($aTmpName[$iKey],$sSavePath)){
						$aSuccess[]=array(
							'oriName'=>$aName[$iKey], // 原文件名
							'saveName'=>$sSaveName, // 保存的文件名
							'savePath'=>$sSavePath, // 保存的路径
							'fileSize'=>$aSize[$iKey], // 文件大小
						);
					}else{
						$aError[]=array(
							'name'=>$aName[$iKey],
							'error'=>'文件上传失败',
							'errorCode'=>5,
						);
					}

				endforeach;
			else:
			endif;
			
		}

		/**
		 * 生成文件名
		 * @return [type] [description]
		 */
		private static function generateFileName(){
			return md5(microtime(true).mt_rand(0,2147483247));
		}

		// private static function 
	}