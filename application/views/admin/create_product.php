<!DOCTYPE html>
<html lang="en">

<body>

<div style="margin-left:5%; margin-top:5%;">
<span><a href="<?php echo site_url('admin/view/product'); ?>">View All</a> </span>
</div>

<div class="container">
  <h2><?php echo $title; ?> PRODUCT</h2>

<script type="text/javascript">

$(document).on('change', 'input', function() {
  
  if (this.files && this.files[0]) {
            
                var reader = new FileReader();
				
				if(this.id == "front_view"){
                	reader.onload = function (e) {
                    	$('#front_view_image')
                        	.attr('src', e.target.result)
                        	.width(304)
                        	.height(236);
                	};
                }
                else{
                	
                	reader.onload = function (e) {
                    	$('#back_view_image')
                        	.attr('src', e.target.result)
                        	.width(304)
                        	.height(236);
                	};
                }

                reader.readAsDataURL(this.files[0]);
            }
  	
});




$(document).ready(function() {

    $("#target option[value='<?php if(isset($product)) echo $product->target; else echo 0; ?>']").prop('selected', true);
});

        
</script>

  <form action="<?php if($title == 'CREATE') echo site_url('admin/create/product'); else echo site_url('admin/edit/product/'.$product->id);  ?>" role="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php  if(isset($product)) echo $product->name; ?>">
    </div>
	<div class="form-group">
      <label for="name">URL Name:</label>
      <input type="text" class="form-control" id="url_name" name="url_name" value="<?php  if(isset($product)) echo $product->url_name; ?>">
    </div>
	<div class="form-group">
      <label for="name">Price (FCFA):</label>
      <input type="text" class="form-control" id="price" name="price" value="<?php  if(isset($product)) echo $product->base_price; ?>">
    </div>
    <div class="form-group">
  		<label for="target">Target:</label>
  		<select class="form-control" id="target" name="target">
    		<option value="0">Men</option>
		    <option value="1">Women</option>
		    <option value="2">Both</option>
  		</select>
	</div>
	<div class="form-group">
    	<label for="front_image">Front View: </label>
    	<input type="file" id="front_view" name="front_view" >
    	<img id="front_view_image" src="<?php if(isset($front_view_image)) echo ASSETS_PATH.'images/products/'.$front_view_image; ?>" class="img-responsive" alt="" width="304" height="236"> 
  	</div>
  	<div class="form-group">
    	<label for="back_image">Back View: </label>
    	<input type="file" id="back_view" name="back_view">
    	<img id="back_view_image" src="<?php if(isset($back_view_image)) echo ASSETS_PATH.'images/products/'.$back_view_image; ?>" class="img-responsive" alt="" width="304" height="236"> 
  	</div>
	<button type="submit" class="btn btn-primary btn-block"><?php echo $title; ?></button>
  </form>
</div>

</body>
</html>