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
  <h2><?php echo $title; ?> MENU</h2>

  <form action="<?php if($title == 'CREATE') echo site_url('admin/create/menu'); else echo site_url('admin/edit/menu/'.$menu->id);  ?>" role="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php  if(isset($menu)) echo $menu->name; ?>">
    </div>
	<button type="submit" class="btn btn-primary btn-block"><?php echo $title; ?></button>
  </form>
</div>

</body>
</html>