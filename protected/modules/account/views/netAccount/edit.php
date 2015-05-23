<link style="text/css" rel="styleSheet" href="<?php echo S_CSS_URL; ?>/form.css" />
<script type="text/javascript" src="<?php echo S_JS_URL; ?>/form.js"></script>
<style type="text/css">
<!--
	.control-public-class{
		width:300px;
	}
-->
</style>
<script type="text/javascript">
<!--
	// window.oImgList
	$(document).ready(function (){
		window.oImgList=new ImageUploadList({});
		
		oImgList.getElement().hoverImage().deleteImage();
	});
//-->
</script>
<?php
	
	/*
		$form = $this->beginWidget('CActiveForm',array(
		    'id'=>'contact-form',
		    'enableAjaxValidation'=>true,    //是否启用ajax验证
		    'enableClientValidation'=>true,  //是否启用客户端验证
		    'clientOptions'=>array(
		        'validateOnSubmit'=>true,     //提交时的验证
		        'validateOnChange'=>true,     //输入框值改变时的验证
		        'validateOnType'=>false,      //键入时验证
		    ),
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		));


		AJAX提交按钮
		<?php echo CHtml::ajaxSubmitButton('提交',
             CHtml::normalizeUrl(array('user/aa','render'=>true)),
                                    array(
                                        'type'=>'post',
                                    'error'=>'js:function(){
                                        alert(\'error\');
                                    }',
                                    'beforeSend'=>'js:function(){
                                        alert(\'beforeSend\');
                                    }',
                                    'success'=>'js:function(){
                                        alert(\'success, data from server: \'+data);
                                    }',
                                    'complete'=>'js:function(){
                                        alert(\'complete\');
                                    }',
                                    //'update'=>'#where_to_put_the_response',
                                    ),array(
                                        'class' => 'web_buttonIn fb f14 ml20 per-quxiao',
                                    ))?>
	*/


	$oForm=$this->beginWidget('CActiveForm',array(
		'action'=>'javascript:void(0);',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
		'clientOptions'=>array(
			'validateOnChange'=>true,
			'validateOnSubmit'=>true,
		),
		'htmlOptions'=>array(
			'autocomplete'=>'off',
			'spellcheck'=>'false',
		),
	));
?>
<!-- 账号用户名 s -->
<div class="input-list-wrap">
	<div class="input-wrap">
		<?php
			echo $oForm->labelEx($oModel,'account_user_name',array(
				'class'=>'input-label-title',
			)); // 账号的用户名
		?>

		<div class="input-control-wrap control-public-class input-control-wrap-public-no-style">
			<!-- <label class="input-placeholder-label">用户名</label> -->
			<?php
				echo $oForm->label($oModel,'account_user_name',array(
					'class'=>'input-placeholder-label input-placeholder-public-no-style',
				));
				echo $oForm->textField($oModel,'account_user_name',array(
					'class'=>'input-control control-public-class input-control-public-no-style',
				));
			?>
		</div>

	</div>
	<div class="error-or-tips-wrap">
		<?php echo $oForm->error($oModel,'account_user_name'); ?>
	</div>
</div>
<!-- 账号用户名 e -->


<!-- 账号密码 s -->
<div class="input-list-wrap">
	<div class="input-wrap">
		<?php
			echo $oForm->labelEx($oModel,'account_password',array(
				'class'=>'input-label-title',
			)); // 账号的用户名
			// echo $oForm->textField($oModel,'account_password');
		?>

		<div class="input-control-wrap control-public-class input-control-wrap-public-no-style">
			<!-- <label class="input-placeholder-label">账号密码</label> -->
			<?php
				echo $oForm->label($oModel,'account_password',array(
					'class'=>'input-placeholder-label input-placeholder-public-no-style',
				));
				echo $oForm->textField($oModel,'account_password',array(
					'class'=>'input-control control-public-class input-control-public-no-style',
				));
			?>
		</div>

	</div>
	<div class="error-or-tips-wrap">
		<?php echo $oForm->error($oModel,'account_password'); ?>
	</div>
</div>
<!-- 账号密码 e -->

<!-- 账号的网址 s -->
<div class="input-list-wrap">
	<div class="input-wrap">
		<?php
			echo $oForm->labelEx($oModel,'account_web_url',array(
				'class'=>'input-label-title',
			)); // 账号的用户名
			// echo $oForm->textField($oModel,'account_web_url');
		?>

		<div class="input-control-wrap control-public-class input-control-wrap-public-no-style">
			<!-- <label class="input-placeholder-label">账号网址</label> -->
			<?php
				echo $oForm->label($oModel,'account_web_url',array(
					'class'=>'input-placeholder-label input-placeholder-public-no-style',
				));
				echo $oForm->textField($oModel,'account_web_url',array(
					'class'=>'input-control control-public-class input-control-public-no-style',
				));
			?>
		</div>
	</div>
	<div class="error-or-tips-wrap">
		<?php echo $oForm->error($oModel,'account_web_url'); ?>
	</div>
</div>
<!-- 账号的网址 e -->

<!-- 注册时间 s -->
<div class="input-list-wrap">
	<div class="input-wrap">
		<?php
			echo $oForm->labelEx($oModel,'account_register_date',array(
				'class'=>'input-label-title',
			)); // 账号的用户名
			// echo $oForm->textField($oModel,'account_register_date');
		?>

		<div class="input-control-wrap control-public-class input-control-wrap-public-no-style">
			<!-- <label class="input-placeholder-label">注册时间</label> -->
			<?php
				echo $oForm->label($oModel,'account_register_date',array(
					'class'=>'input-placeholder-label input-placeholder-public-no-style',
				));
				echo $oForm->textField($oModel,'account_register_date',array(
					'class'=>'input-control control-public-class input-control-public-no-style',
				));
			?>
		</div>
	</div>
	<div class="error-or-tips-wrap">
		<?php echo $oForm->error($oModel,'account_register_date'); ?>
	</div>
</div>
<!-- 注册时间 e -->

<!-- 账号关联的 qq s -->
<div class="input-list-wrap">
	<div class="input-wrap">
		<?php
			echo $oForm->labelEx($oModel,'account_link_qq',array(
				'class'=>'input-label-title',
			)); // 账号的用户名
			// echo $oForm->textField($oModel,'account_link_qq');
		?>
		<div class="input-control-wrap control-public-class input-control-wrap-public-no-style">
			<!-- <label class="input-placeholder-label">关联的QQ</label> -->
			<?php
				echo $oForm->label($oModel,'account_link_qq',array(
					'class'=>'input-placeholder-label input-placeholder-public-no-style',
				));
				echo $oForm->textField($oModel,'account_link_qq',array(
					'class'=>'input-control control-public-class input-control-public-no-style',
				));
			?>
		</div>
	</div>
	<div class="error-or-tips-wrap">
		<?php echo $oForm->error($oModel,'account_link_qq'); ?>
	</div>
</div>
<!-- 账号关联的 qq e -->

<!-- 账号关联的 邮箱 s -->
<div class="input-list-wrap">
	<div class="input-wrap">
		<?php
			echo $oForm->labelEx($oModel,'account_link_email',array(
				'class'=>'input-label-title',
			)); // 账号的用户名
			// echo $oForm->textField($oModel,'account_link_email');
		?>
		<div class="input-control-wrap control-public-class input-control-wrap-public-no-style">
			<!-- <label class="input-placeholder-label">关联的邮箱</label> -->
			<?php
				echo $oForm->label($oModel,'account_link_email',array(
					'class'=>'input-placeholder-label input-placeholder-public-no-style',
				));
				echo $oForm->textField($oModel,'account_link_email',array(
					'class'=>'input-control control-public-class input-control-public-no-style',
				));
			?>
		</div>
	</div>
	<div class="error-or-tips-wrap">
		<?php echo $oForm->error($oModel,'account_link_email'); ?>
	</div>
</div>
<!-- 账号关联的 邮箱 e -->

<!-- 图片 s -->
<div class="input-list-wrap">
	<div class="img-list-wrap">
		<?php
			echo $oForm->label($oModel,'sImgUploadTitle',array(
				'class'=>'input-label-title textarea-input-label-title',
			));
		?>
		<div class="textarea-control-wrap textarea-control-public upload-image-list-wrap">
			<ul class="">
				<?php for($i=0;$i<2;$i++): ?>
				<li class="signle-image-wrap signle-image-public-wrap-no-style-for-js image-has-loaded">

					<!-- 隐藏域 s -->
					<?php
						echo $oForm->hiddenField($oModel,'aUploadedImageListName[]',array(
							'value'=>'a'.$i.'.jpg',
							'class'=>'upload-image-hidden-name',
						));
					?>
					<!-- 隐藏域 e -->

					<!-- 当图片还没有加载完成显示的内容 s -->
					<div class="image-loadding-wrap">
						<img  src="<?php echo S_IMG_URL; ?>/static/image_loadding.gif" />
					</div>
					<!-- 当图片还没有加载完成显示的内容 e -->


					<!-- 遮罩 s -->
					<div class="image-hide-layer"></div>
					<!-- 遮罩 e -->

					<!-- 按钮 s -->
					<div class="image-btn-wrap">

						<!-- 按钮的背景 s -->
						<div class="image-btn-wrap-bg"></div>
						<!-- 按钮的背景 e -->

						<!-- 顶部按钮 s -->
						<div class="image-top-btn-wrap image-btn-wrap-public">
							<!-- 删除按钮 s -->
							<a href="javascript:void(0);" class="image-delete-btn"></a>
							<!-- 删除按钮 e -->
						</div>
						<!-- 顶部按钮 e -->

						<!-- 底部按钮 s -->
						<div class="image-bottom-btn-wrap image-btn-wrap-public"></div>
						<!-- 底部按钮 e -->
					</div>
					<!-- 按钮 e -->


					<!-- 当图片加载完成后,显示的内容 -->
					<div class="image-has-loaded-wrap">
						<!-- 当前图片 s -->
						<div class="image-current-wrap">
							<img data-size="475*300" class="uploaded-image" data-src="<?php echo S_IMG_URL; ?>/test/3.jpg" />

							<!-- <img data-size="300*450" class="uploaded-image" data-src="<?php echo S_IMG_URL; ?>/test/2.png" /> -->

							<!-- <img data-size="247*246" class="uploaded-image" data-src="<?php echo S_IMG_URL; ?>/test/d.jpg" /> -->

							<!-- sprite -->
							<!-- <img data-size="30*9" class="uploaded-image" data-src="<?php echo S_IMG_URL; ?>/test/sprite.png" /> -->

							<!-- <img data-size="20*21" class="uploaded-image" data-src="<?php echo S_IMG_URL; ?>/test/l.gif" /> -->




						</div>
						<!-- 当前图片 e -->
						
					</div>
				</li>
				<?php endfor; ?>

				<!-- 上传域 s -->
				<li class="signle-image-wrap image-upload-filed-wrap">
					<iframe class="upload-image-frame" src="<?php echo $this->createUrl('uploadImage'); ?>" scrolling="no" frameborder="0"></iframe>
					<!-- <iframe class="upload-image-frame" src="https://www.baidu.com/" scrolling="no" frameborder="0"></iframe> -->

				</li>
				<!-- 上传域 e -->

			</ul>
		</div>
	</div>
</div>
<!-- 图片 e -->

<!-- 其它说明 s -->
<div class="input-list-wrap">
	<div class="input-wrap textarea-input-wrap">
		<?php
			echo $oForm->labelEx($oModel,'account_other_describe',array(
				'class'=>'input-label-title textarea-input-label-title',
			)); // 账号的用户名
		?>

		<div class="textarea-control-wrap textarea-control-public input-control-wrap-public-no-style">
			<?php
				echo $oForm->label($oModel,'account_other_describe',array(
					'class'=>'textarea-input-placeholder input-placeholder-public-no-style',
				));
				echo $oForm->textArea($oModel,'account_other_describe',array(
					'class'=>'textarea-control textarea-control-public input-control-public-no-style',
				));
			?>
		</div>

	</div>
	<div class="error-or-tips-wrap">
		<?php echo $oForm->error($oModel,'account_other_describe'); ?>
	</div>
</div>
<!-- 其它说明 e -->

<!-- 按钮 s -->
<div>
	<?php
		echo CHtml::submitButton('保存');
	?>
</div>
<!-- 按钮 e -->

<?php
	$this->endWidget();
?>

<script type="text/javascript">
<!--
	// image-has-loaded
	// var oImgList=$('img.uploaded-image'); // 加载的图片列表
	loadImg('li.signle-image-public-wrap-no-style-for-js').toLoad({
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

	// alert($('.image-current-wrap').width());
	// 设置图片尺寸
	setImageSize($('img.uploaded-image'));
//-->
</script>