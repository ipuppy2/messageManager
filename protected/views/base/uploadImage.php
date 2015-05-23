<?php
	// echo $this->id;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link type="text/css" rel="styleSheet" href="<?php echo S_CSS_URL; ?>/chu.css" />
		<script type="text/javascript" src="<?php echo S_JS_URL; ?>/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="<?php echo S_JS_URL; ?>/chu.js"></script>
		<style type="text/css">
		<!--
			/*单个图片的外围*/
			div.signle-image-wrap{
				width:120px;
				height:120px;
				float:left;
				border-radius:5px;
				position:relative;
				overflow:hidden;
				display:inline;
			}


			
			/*当前的图片*/
			div.image-current-wrap{
				width:100%;
				height:100%;
				overflow:hidden;
			}

			div.image-current-wrap img{
				width:100%;
			}

			/*加载,加载完成*/
			div.image-loadding-wrap,div.image-has-loaded-wrap{
				position:absolute;
				left:0px;
				top:0px;
				width:100%;
				height:100%;
				z-index:0;
			}

			/*加载中*/
			div.image-loadding-wrap{
				/*background-color:#ccc;*/
				z-index:3;
				display:none;
				border-radius:5px;
			}

			div.image-loadding-wrap img{
				display:inline-block;
				width:100%;
				/*height:*/
			}

			/*图片上传域*/
			div.image-upload-field-ico-wrap{
				background-image:url(<?php echo S_IMG_URL; ?>/static/img_upload.png);
				border-radius:5px;
				background-repeat:no-repeat;
				background-position:0px 0px;
				cursor:pointer;
				/*overflow:auto;*/
			}

			input.image-upload-file-field-input{
				display:block;
				position:absolute;

				left:0px;
				top:0px;
				_left:-5px; /*IE6*/
				*left:-5px; /*IE7*/
				width:100%;
				height:100%;
				font-size:40px;
				line-height:120px;
				cursor:pointer;
				opacity:0;
				filter:alpha(opacity:0);
			}

			input.image-upload-file-field-input:focus{
				outline:none;
				blr:expression(this.onFocus=this.blur());
			}
		-->
		</style>
	</head>
	<body>
		<?php
			$oForm=$this->beginWidget('CActiveForm',array(
				'action'=>array('toUploadImage'),
				'htmlOptions'=>array(
					'target'=>'upload_image_iframe',
					'id'=>'image_upload_form',
					'enctype'=>'multipart/form-data',
				),
			));
		?>
		<!-- 上传域 s -->
		<div class="signle-image-wrap image-upload-filed-wrap">

			

			<!-- 当图片还没有加载完成显示的内容 s -->
			<div class="image-loadding-wrap" id="upload_loadding_wrap">
				<img src="<?php echo S_IMG_URL; ?>/static/image_loadding.gif" />
			</div>
			<!-- 当图片还没有加载完成显示的内容 e -->


			<!-- 当图片加载完成后,显示的内容 -->
			<div class="image-has-loaded-wrap" id="image_has_loaded_wrap">

				<!-- 当前图片 s -->
				<div class="image-current-wrap image-upload-field-ico-wrap">
					<?php
						echo $oForm->fileField($oModel,'aUploadImageFileFieldListName[]',array(
							'class'=>'image-upload-file-field-input',
							'id'=>'image_upload_file_field',
							'accept'=>'image/*',
							'multiple'=>'multiple',
						));
					?>
				</div>
				<!-- 当前图片 e -->

			</div>
		</div>
		<!-- 上传域 e -->
		<?php
			$this->endWidget();
		?>

		<iframe src="" name="upload_image_iframe" style="width:900px;height:1000px;"></iframe>
		<script type="text/javascript">
		<!--
			var oForm=$('#image_upload_form'),
			oUploadLoaddingWrap=$('#upload_loadding_wrap'), // 显示现在上传
			oHasLoadedWrap=$('#image_has_loaded_wrap'),
			oParentWin=window.top, // 父窗口
			oUploadFileField=$('li.image-upload-filed-wrap:eq(0)',oParentWin.document), // 存放图片列表

			oFileField=$('#image_upload_file_field').change(function (){
				oForm.submit();
			});

			/**
			 * 上传前
			 * @return {[type]} [description]
			 */
			function beforeUpload(){
				oUploadLoaddingWrap.fadeIn();
				oHasLoadedWrap.hide();
			}

			/**
			 * 上传完成后
			 * @param  {[type]} aImgList [description]
			 * @return {[type]}          [description]
			 */
			function afterUpload(aImgList){

				// 清空上传域的值
				oFileField.val('');

				oUploadLoaddingWrap.fadeOut();
				oHasLoadedWrap.show();

				var sImgListTag='',oImg;
				
				for(var i=0,iLen=aImgList.length;i<iLen;i++){
					oImg=aImgList[i];
					sImgListTag+='<li class="signle-image-wrap signle-image-public-wrap-no-style-for-js image-has-loaded">';
					
					// <!-- 隐藏域 s -->
					sImgListTag+='<input type="hidden" name="<?php echo get_class($oModel); ?>[aUploadedImageListName][]" value="'+oImg.name+'" class="upload-image-hidden-name" />'; 
					// <!-- 隐藏域 e -->
					
					// <!-- 当图片还没有加载完成显示的内容 s -->
					sImgListTag+='<div class="image-loadding-wrap">	';
					sImgListTag+='<img src="<?php echo S_IMG_URL; ?>/static/image_loadding.gif" />';
					sImgListTag+='</div>';
					// <!-- 当图片还没有加载完成显示的内容 e -->

					// <!-- 当图片加载完成后,显示的内容 -->
					sImgListTag+='<div class="image-has-loaded-wrap">';
						// <!-- 遮罩 s -->
					sImgListTag+='<div class="image-hide-layer"></div>';
						// <!-- 遮罩 e -->

						// <!-- 当前图片 s -->
					sImgListTag+='<div class="image-current-wrap">';
					sImgListTag+='<img class="uploaded-image" data-src="'+oImg.src+'" />';
					sImgListTag+='</div>';
						// <!-- 当前图片 e -->

						// <!-- 按钮 s -->
					sImgListTag+='<div class="image-btn-wrap">';

							// <!-- 按钮的背景 s -->
					sImgListTag+='<div class="image-btn-wrap-bg"></div>';
							// <!-- 按钮的背景 e -->

							// <!-- 顶部按钮 s -->
					sImgListTag+='<div class="image-top-btn-wrap image-btn-wrap-public">';
								// <!-- 删除按钮 s -->
					sImgListTag+='<a href="javascript:void(0);" class="image-delete-btn"></a>';
								// <!-- 删除按钮 e -->
					sImgListTag+='</div>';
							// <!-- 顶部按钮 e -->

							// <!-- 底部按钮 s -->
					sImgListTag+='<div class="image-bottom-btn-wrap image-btn-wrap-public"></div>';
							// <!-- 底部按钮 e -->
					sImgListTag+='</div>';
						// <!-- 按钮 e -->
					sImgListTag+='</div>';
					sImgListTag+='</li>';
				}

				var oNewImaList=$(sImgListTag);//.hide(); //.css('opacity',0);
				oUploadFileField.before(oNewImaList.fadeIn()); // 把新上传的图片追加到存放列表
				

				oParentWin.oImgList.afterAddImage(oNewImaList.find('div.image-hide-layer').css('opacity',0),oNewImaList.find('div.image-btn-wrap').css('opacity',0));
				
				// 加载图片
				loadImg(oNewImaList).toLoad({
					/**
					 * 加载前
					 * @param  {[type]} iIndex [description]
					 * @return {[type]}        [description]
					 */
					beforeLoad : function (iIndex){

					},

					/**
					 * 返回图片路径
					 * @param  {[type]} iIndex [description]
					 * @return {[type]}        [description]
					 */
					getSrc : function (iIndex){
						return $(this).find('img.uploaded-image:first').attr('data-src');
					},

					/**
					 * 加载完成
					 * @param  {[type]} oImg   [description]
					 * @param  {[type]} iIndex [description]
					 * @return {[type]}        [description]
					 */
					complete : function (oImg,iIndex){
						// image-loadding-wrap
						// image-has-loaded-wrap
						
						$(this).find('div.image-loadding-wrap:first').fadeOut(); // 隐藏加载状态
						$(this).find('div.image-has-loaded-wrap:first').fadeIn().find('img.uploaded-image:first').prop('src',oImg.src);
					}
				});
			}
		//-->
		</script>
	</body>
</html>
