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
  <h2>SHMYDE PRODUCTS</h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Target</th>
        <th>Links</th>
      </tr>
    </thead>
    <tbody>
    
    <?php foreach ($products->result() as $row) {?>
    	
    	<tr>
    		<td><?php echo $row->name; ?></td>
    		<td><?php 
    		
    		switch($row->target){
    			
    			case 0:
    				echo 'Men';
    				break;
    			case 1:
    				echo 'Women';
    				break;
    			case 2:
    				echo 'Both';
    				break;
    		}    		
    		?></td>
    		<td>
    			<a href="<?php echo site_url('admin/edit/product/'.$row->id); ?>">Edit</a> | 
    			<a href="<?php echo site_url('admin/delete/product/'.$row->id); ?>">Delete</a>
    		</td>
    	</tr>
    
    <?php }?>
    </tbody>
  </table>
</div>

</body>
</html>