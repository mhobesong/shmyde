<!DOCTYPE html>
<html lang="en">

<script type="text/javascript">
    
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
                        				
  		   	
  		   	
  		   		var tr = document.createElement('TR');
    		
    	
    		
    			var name = document.createElement('TD');
        		name.appendChild(document.createTextNode(options_array[key]['name']));
        		tr.appendChild(name);
    		
    			var type = document.createElement('TD');
        		type.appendChild(document.createTextNode(options_array[key]['type']));
        		tr.appendChild(type);
                        
                        var applied_to = document.createElement('TD');
        		applied_to.appendChild(document.createTextNode(options_array[key]['applied_to']));
        		tr.appendChild(applied_to);
    		
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
                        
                      SubMenuChanged();  
                                               
		}
	};
	
	var site_url = "<?php echo site_url('admin/get_submenus') ?>";
	
	site_url = site_url.concat("/").concat($( "#product" ).val()).concat("/").concat($( "#menu" ).val());
		
	xmlhttp.open("GET", site_url, true);
	
	xmlhttp.send();
}  

function SubMenuChanged(){
	
	var xmlhttp = new XMLHttpRequest();
        

	xmlhttp.onreadystatechange = function() {
		
                       

		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
                        
                        
			var json_array =  JSON.parse(xmlhttp.responseText);
						
			create_table_body(json_array);
                                               
		}
	};
	
	var site_url = "<?php echo site_url('admin/get_options') ?>";
	
	site_url = site_url.concat("/").concat($( "#submenu" ).val());
		
	xmlhttp.open("GET", site_url, true);
	
	xmlhttp.send();
}  




$(document).ready(function() {

    $("#target option[value='<?php if(isset($option)) echo $option->target; else echo 0; ?>']").prop('selected', true);
    
    MenuChanged();
      
	
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
  		<label for="submenu" onchange="SubMenuChanged();">Sub Menu:</label>
  		<select class="form-control" id="submenu" name="submenu">
    		
  		</select>
	</div>
	
</div>

<div class="container">
  
  <table class="table table-hover" id="options_table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Applied To</th>
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