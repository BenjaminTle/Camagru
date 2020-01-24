<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= $title ?></title>
		<link href="style/header.css" rel="stylesheet">
		<link rel="stylesheet" 
		href="style/bulma.css">
		<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
		<script type="text/javascript" src="script/header.js"></script>
		<?php foreach ($css as $key => $value) { ?>
			<link href="style/<?php echo $value ?>" rel="stylesheet" /> 
		<?php } ?>
    </head>
    <body>
		<?= $header ?>
		<?= $content ?>
		<?php foreach ($script as $key => $value) { ?>
			<script type="text/javascript" src="script/<?php echo $value ?>"></script>
		<?php } ?>
	</body>
	
</html>
