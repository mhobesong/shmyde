<!DOCTYPE html>
<html lang="en">

<script type="text/javascript">




$(document).ready(function() {

    $("#target option[value='<?php if(isset($option)) echo $option->target; else echo 0; ?>']").prop('selected', true);
    
    update_submenu_combobox();
    
    function update_submenu_combobox(){
    	
    	try {
    	
    		$("#submenu").empty();
  		
  			var data = <?php echo json_encode($submenus)?>[$( "#product" ).val()][$( "#menu" ).val()];
  		
  			for (var key in data) {
  		   			
   				$('#submenu').append($("<option/>", {
        			value: data[key]['id'],
        			text:  data[key]['name']
    			}));
			}
		}
		catch(err){
		
		}
    }
        
    
    function create_table_body(options_array){
    	
    	//alert(JSON.stringify(options_array));
		
    	var table = document.getElementById("options_table");
    	
    	
    	
    	while(table.rows.length > 1){
    		
    		table.deleteRow(1);
    	}
    	
    	
    	var tablebody = document.getElementById("tablebody");
		

    				
    	for (var key in options_array) {
  		   		
			var product = document.getElementById("product");
			var menu = document.getElementById("menu");
			var submenu = document.getElementById("submenu");
				
  		   	if(options_array[key]['product_id'] == product.value 
  		   	&& options_array[key]['menu_id'] == menu.value
  		   	&& options_array[key]['submenu_id'] == submenu.value){
  		   	
  		   		var tr = document.createElement('TR');
    		
    		
        		var product = document.createElement('TD');
        		product.appendChild(document.createTextNode(options_array[key]['product_name']));
        		tr.appendChild(product);
    		
    			var menu = document.createElement('TD');
        		menu.appendChild(document.createTextNode(options_array[key]['menu_name']));
        		tr.appendChild(menu);
    		
    			var submenu = document.createElement('TD');
        		submenu.appendChild(document.createTextNode(options_array[key]['submenu_name']));
        		tr.appendChild(submenu);
    		
    			var name = document.createElement('TD');
        		name.appendChild(document.createTextNode(options_array[key]['name']));
        		tr.appendChild(name);
    		
    			var type = document.createElement('TD');
        		type.appendChild(document.createTextNode(options_array[key]['type']));
        		tr.appendChild(type);
    		
    			var price = document.createElement('TD');
        		price.appendChild(document.createTextNode(options_array[key]['price']));
        		tr.appendChild(price);
    		
    			var description = document.createElement('TD');
        		description.appendChild(document.createTextNode(options_array[key]['description']));
        		tr.appendChild(description);
				
				var is_default = document.createElement('TD');
        		is_default.appendChild(document.createTextNode(options_array[key]['is_default']));
        		tr.appendChild(is_default);
        		
        		var links = document.createElement('TD');
        		
        		var edit = document.createElement("a");  
        		var edit_text = document.createTextNode("Edit");
				edit.href = "<?php echo site_url('admin/edit/option/'); ?>/".concat(options_array[key]['id']); 
        		edit.appendChild(edit_text); 
        		
        		var delete_link = document.createElement("a");  
        		var delete_text = document.createTextNode("Delete");
				delete_link.href = "<?php echo site_url('admin/delete/option/'); ?>/".concat(options_array[key]['id']); 
        		delete_link.appendChild(delete_text);  
				 

        		links.appendChild(edit);
        		links.appendChild(document.createTextNode(' | '));
        		links.appendChild(delete_link);
        		tr.appendChild(links);
        	
    			tablebody.appendChild(tr);	
    		
    		}	
  		   			
   			
		}
    	
    }
    
    
    $( "#product" ).change(function() {
  		
  		update_submenu_combobox();  
  		
  		update_table(); 		
  		
	});
	
	$( "#menu" ).change(function() {
  		
  		update_submenu_combobox();
  		
  		update_table(); 
  		
	});
	
	$( "#submenu" ).change(function() {
  		
  		update_table();
  		
	});
	
	function update_table(){
	
		var data = <?php echo json_encode($options)?>;
  		
  		create_table_body(data);
  	}
  	
  	update_table();
	
	
	
	
});
        
</script>

<body>



<div style="margin-left:5%; margin-top:5%;">
<span><a href="<?php echo site_url('admin/create/option'); ?>">Create New</a> </span>
</div>

<div class="container">
	<h2>SHMYDE SUB MENU OPTIONS</h2>
	<div class="form-group">
  		<label for="product">Product:</label>
  		<select class="form-control" id="product" name="product">
    		<?php foreach ($products->result() as $row) {?>
    		<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
		    <?php } ?>
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
  		<label for="submenu">Sub Menu:</label>
  		<select class="form-control" id="submenu" name="submenu">
    		
  		</select>
	</div>
	
</div>

<div class="container">
  
  <table class="table table-hover" id="options_table">
    <thead>
      <tr>
        <th>Product</th>
        <th>Menu</th>
        <th>Sub Menu</th>
        <th>Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Description</th>
		<th>Is Default</th>
        <th>Links</th>
      </tr>
    </thead>
    <tbody id="tablebody">
	    

    </tbody>
  </table>
</div>

</body>
</html>