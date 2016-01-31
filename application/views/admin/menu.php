<!DOCTYPE html>
<html lang="en">

<body>

<div style="margin-left:5%; margin-top:5%;">
<span><a href="<?php echo site_url('admin/create/menu'); ?>">Create New</a> </span>
</div>

<div class="container">
  <h2>SHMYDE MENUS</h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Menu Name</th>
        <th>Links</th>
      </tr>
    </thead>
    <tbody>
    
    <?php foreach ($menus->result() as $row) {?>
    	
    	<tr>
    		<td><?php echo $row->name; ?></td>
    		<td>
    			<a href="<?php echo site_url('admin/edit/menu/'.$row->id); ?>">Edit</a> | 
    			<a href="<?php echo site_url('admin/delete/menu/'.$row->id); ?>">Delete</a>
    		</td>
    	</tr>
    
    <?php }?>
    </tbody>
  </table>
</div>

</body>
</html>