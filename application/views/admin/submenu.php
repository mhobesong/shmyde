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
  <h2>SHMYDE SUB MENUS</h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Menu</th>
        <th>Product</th>
        <th>Links</th>
      </tr>
    </thead>
    <tbody>
    
    <?php foreach ($submenus->result() as $row) {?>
    	
    	<tr>
    		<td><?php echo $row->name; ?></td>
    		<td><?php 
    		
    		switch($row->type){
    			
    			case 0:
    				echo 'Visual';
    				break;
    			case 1:
    				echo 'Measurment';
    				break;

    		}    		
    		?></td>
    		<td><?php echo $row->menu_name; ?></td>
    		<td><?php echo $row->product_name; ?></td>

    		<td>
    			<a href="<?php echo site_url('admin/edit/submenu/'.$row->id); ?>">Edit</a> | 
    			<a href="<?php echo site_url('admin/delete/submenu/'.$row->id); ?>">Delete</a>
    		</td>
    	</tr>
    
    <?php }?>
    </tbody>
  </table>
</div>

</body>
</html>