<?php
	class CX {
		public static function p(){
			$aArgList=func_get_args();
			echo '<pre>';
			foreach($aArgList as $aArg):
				print_r($aArg);
			endforeach;
			echo '</pre>';
		}

		/**
		 * 删除文件
		 * @param  [type] $mixFile [description]
		 * @return [type]          [description]
		 */
		public static function unlinkFile($mixFile){
			if(is_string($mixFile)){
				file_exists($mixFile) and unlink($mixFile);
			}else{
				foreach($mixFile as $file){
					file_exists($file) and unlink($file);
				}
			}
		}

		/**
		 * 返回当前使用的用户 id
		 * @return [type] [description]
		 */
		public static function getUserId(){
			return 1;
		}

		/**
		 * 返回当前登录的用户名
		 * @return [type] [description]
		 */
		public static function getUserName(){
			return 'puppy';
		}
	}