<!DOCTYPE html>
<html lang="en">
<head>
  <title>SHMYDE PRODUCTS PAGE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>



<div class="container">
  <h2><?php echo $title; ?> SUB MENU</h2>

<script type="text/javascript">

$(document).ready(function() {

    $("#type option[value='<?php if(isset($submenu)) echo $submenu->type; else echo 0; ?>']").prop('selected', true);
    
    $("#product option[value='<?php if(isset($submenu)) echo $submenu->shmyde_product_id; else echo 0; ?>']").prop('selected', true);
    
    $("#menu option[value='<?php if(isset($submenu)) echo $submenu->shmyde_design_main_menu_id; else echo 0; ?>']").prop('selected', true);
});

        
</script>

  <form action="<?php if($title == 'CREATE') echo site_url('admin/create/submenu'); else echo site_url('admin/edit/submenu/'.$submenu->id);  ?>" role="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php  if(isset($submenu)) echo $submenu->name; ?>">
    </div>
        <div class="form-group">
  		<label for="type">Type:</label>
  		<select class="form-control" id="type" name="type">
    		<option value="0">Visual</option>
		    <option value="1">Measurement</option>
  		</select>
	</div>
    <div class="form-group">
  		<label for="menu">Menu:</label>
  		<select class="form-control" id="menu" name="menu">
  			<?php foreach ($menus->result() as $row) {?>
    		<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
		    <?php } ?>
  		</select>
	</div>
	<div class="form-group">
  		<label for="product">Product:</label>
  		<select class="form-control" id="product" name="product">
  			<?php foreach ($products->result() as $row) {?>
    		<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
		    <?php } ?>
  		</select>
	</div>
	<button type="submit" class="btn btn-primary btn-block"><?php echo $title; ?></button>
  </form>
</div>

</body>
</html>