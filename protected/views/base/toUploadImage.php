<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link type="text/css" rel="styleSheet" href="<?php echo S_CSS_URL; ?>/chu.css" />
		<script type="text/javascript" src="<?php echo S_JS_URL; ?>/jquery-1.11.1.js"></script>
		<!--<script type="text/javascript" src="<?php echo S_JS_URL; ?>/form.js"></script>-->
		<script type="text/javascript">
		<!--
			(function (){
				var oTopWin=window.top, // 获取最顶层的 window
				oParentWin=window.parent; // 获取当前 window 的父 window
				
				// 上传前
				oParentWin.beforeUpload();

				setTimeout(function (){
					oParentWin.afterUpload([<?php
						$aImg=array();
						for($i=0;$i<4;$i++){
							$aImg[]='{src:"'.S_IMG_URL.'/test/'.$i.'.jpg",name:"'.$i.'.jpg"}';
						}
						echo join(',',$aImg);
					?>]);
				},3000);
			})();
		//-->
		</script>
	</head>
	<body>
		<?php
			CX::p($_FILES);
		?>
	</body>
</html>