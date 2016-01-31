<!DOCTYPE html>
<html lang="en">

<body>

<div style="margin-left:5%; margin-top:5%;">
<span><a href="<?php echo site_url('admin/view/menu'); ?>">View All</a> </span>
</div>



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