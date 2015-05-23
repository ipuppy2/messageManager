<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title><?php echo $this->sPageTitle; ?></title>
		<?php
			Yii::app()->clientScript->registerCssFile(S_CSS_URL.'/chu.css')->registerCoreScript('jquery')->registerScriptFile(S_JS_URL.'/chu.js');
		?>

	</head>
	<body>
		<?php echo $content; ?>
	</body>
</html>