<!DOCTYPE html>
<html lang="en">

<body>

<div style="margin-left:5%; margin-top:5%;">
<span><a href="<?php echo site_url('admin/create/product'); ?>">Create New</a> </span>
</div>

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