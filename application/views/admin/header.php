<!DOCTYPE html>
<html lang="en">
<head>
  <title>SHMYDE ADMIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="<?php echo ASSETS_PATH; ?>color-picker/css/bootstrap-colorpicker.css" rel="stylesheet">
  <script src="<?php echo ASSETS_PATH; ?>color-picker/js/bootstrap-colorpicker.js"></script>

</head>
<body>

<div style="margin-left:1%; margin-top:2%;">
	<span>
		<a href="<?php echo site_url('admin/view/product'); ?>">PRODUCTS</a> |
 		<a href="<?php echo site_url('admin/view/menu'); ?>">MENUS</a> |
  		<a href="<?php echo site_url('admin/view/submenu'); ?>">SUBMENUS</a> |
  		<a href="<?php echo site_url('admin/view/option'); ?>">OPTIONS</a>  
  	</span>
</div>

</body>
</html>