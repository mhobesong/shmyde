<!DOCTYPE html>
<html lang="en">

<body>

<div style="margin-left:5%; margin-top:5%;">
<span><a href="<?php echo site_url('admin/view/option'); ?>">View All</a> </span>
</div>

<div class="container">
  <h2><?php echo $title; ?> OPTION</h2>

<script type="text/javascript">
    
    function MenuChanged(){
	
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		
                
                
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			                      
                        $("#submenu").empty();
                        
			var json_array =  JSON.parse(xmlhttp.responseText);
						
			for (var key in json_array) {
                            
                            $('#submenu').append($("<option/>", {
        			value: json_array[key]['id'],
        			text:  json_array[key]['name']
                            }));
				
			}
                                                                       
		}
	};
	
	var site_url = "<?php echo site_url('admin/get_submenus') ?>";
	
	site_url = site_url.concat("/").concat($( "#product" ).val()).concat("/").concat($( "#menu" ).val());
		
	xmlhttp.open("GET", site_url, true);
	
	xmlhttp.send();
}  


$(document).on('change', 'input', function() {
  
  if (this.files && this.files[0]) {
            
                var reader = new FileReader();
				
				if(this.id == "option_image"){
				
                	reader.onload = function (e) {
                    	$('#image')
                        	.attr('src', e.target.result)
                        	.width(304)
                        	.height(236);
                	};
                }
				
				if(this.id == "caption"){
				
                	reader.onload = function (e) {
                    	$('#caption_image')
                        	.attr('src', e.target.result)
                        	.width(100)
                        	.height(100);
                	};
                }
                

                reader.readAsDataURL(this.files[0]);
            }
  	
});




$(document).ready(function() {

    $("#product option[value='<?php if(isset($option)) echo $option->product_id; else echo 0; ?>']").prop('selected', true);
    $("#menu option[value='<?php if(isset($option)) echo $option->menu_id; else echo 0; ?>']").prop('selected', true);
    $("#submenu option[value='<?php if(isset($option)) echo $option->submenu_id; else echo 0; ?>']").prop('selected', true);
    
    $("#type option[value='<?php if(isset($option)) echo $option->type; else echo 0; ?>']").prop('selected', true);
    $("#applied_to option[value='<?php if(isset($option)) echo $option->applied_to; else echo 0; ?>']").prop('selected', true);
    
        
    MenuChanged();
    
});





        
</script>

  <form action="<?php if($title == 'CREATE') echo site_url('admin/create/option'); else echo site_url('admin/edit/option/'.$option->id);  ?>" role="form" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
  		<label for="product">Product:</label>
                <select class="form-control" id="product" name="product" onchange="MenuChanged();">
    		<?php foreach ($products->result() as $row) {?>
    		<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
		    <?php } ?>
  		</select>
	</div>
	
	<div class="form-group">
  		<label for="menu">Menu:</label>
  		<select class="form-control" id="menu" name="menu" onchange="MenuChanged();">
    		<?php foreach ($menus->result() as $row) {?>
    		<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
		    <?php } ?>
  		</select>
	</div>
	
	<div class="form-group">
  		<label for="submenu">Sub Menu:</label>
  		<select class="form-control" id="submenu" name="submenu">
    		
  		</select>
	</div>
    
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php  if(isset($option)) echo $option->name; ?>">
    </div>
    
    <div class="form-group">
  		<label for="type">Option Type:</label>
  		<select class="form-control" id="type" name="type">
    		<option value="0">Style</option>
    		<option value="1">Fabric</option>
		    <option value="2">CheckBox</option>
  		</select>
    </div>
      
    <div class="form-group">
  		<label for="applied_to">Option Type:</label>
  		<select class="form-control" id="applied_to" name="applied_to">
                    <option value="0">Applied to Front</option>
                    <option value="1">Applied to Back</option>
                    <option value="2">Doesn't Matter</option>
  		</select>
    </div>
    
	<?php 
		
		if(isset($option)) {
			
			if($option->type == 0){
				
				$product_dir = 'style';
			}
			else{
				
				$product_dir = 'fabric';
			}
		}
			
	?>
		
	<div class="form-group">
    	<label for="option_image">Image (If Applicable): </label>
    	<input type="file" id="option_image" name="option_image" >
    	<img id="image" src="<?php if(isset($option_image)) echo ASSETS_PATH.'images/'.$product_dir.'/'.$option_image->name; ?>" class="img-responsive" alt="" width="304" height="236"> 
  	</div>
	
	<div class="form-group">
    	<label for="caption">Caption (If Applicable): </label>
    	<input type="file" id="caption" name="caption" >
    	<img id="caption_image" src="<?php if(isset($option_image)) echo ASSETS_PATH.'images/'.$product_dir.'/'.$option_image->caption; ?>" class="img-responsive" alt="" width="100" height="100"> 
  	</div>
  	
  	<div class="form-group">
      <label for="depth">Image Z-Index:</label>
      <input type="number" class="form-control" id="depth" name="depth" value="<?php  if(isset($option_image)) echo $option_image->z_index; else echo '0'; ?>">
    </div>
  	
  	<div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" id="price" name="price" value="<?php  if(isset($option)) echo $option->price; else echo '0'; ?>">
    </div>
    
     <div class="form-group">
  		<label for="description">Description:</label>
  		<textarea class="form-control" rows="5" id="description" name="description"><?php  if(isset($option)) echo $option->description; ?></textarea>
	</div>
	
	<div class="form-group">
  		<label><input type="checkbox" class="form-control" id="is_default" name="is_default" <?php if(isset($option) && $option->is_default) echo 'checked'; ?>>Is Default Value</label>
	</div>

	<button type="submit" class="btn btn-primary btn-block"><?php echo $title; ?></button>
  </form>
</div>

</body>
</html>