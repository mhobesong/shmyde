<script>
    var sly;
    var parameters;
    var menu_index;
    var submenu_index;
    
            
    function isEmpty(obj) {
        
        for(var prop in obj) {
            
            if(obj.hasOwnProperty(prop))
                return false;
        }
            
        return true;
    }
    
    
    $(document).ready(function(){
        
        parameters = <?php echo $parameters;  ?>;
    
        apply_parameters();
        
        var $frame = $('#design_options');
        
        var $wrap  = $frame.parent();
        
        sly = new Sly( $frame, {
			horizontal: true,
			itemNav: 'centered',
			smart: true,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 0,
			scrollBar: $wrap.find('.scrollbar'),
			scrollBy: 1,
			speed: 300,
			elasticBounds: 1,
			easing: 'easeOutExpo',
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1

			// Buttons
			//prev: $wrap.find('.prev'),
			//next: $wrap.find('.next')
		}, {
                       
                
                }).init();
                
                    
    });
    
    function get_image_source_after_blend(src, elem){

            
            for (var menu in parameters) {
            
            
                for(var submenu in parameters[menu]){


                    if(!isEmpty(parameters[menu][submenu])){

                        if(parameters[menu][submenu].type == 1){


                            var blend_path = "<?php echo ASSETS_PATH; ?>";

                            var img_src = src;

                            blend_path = blend_path.concat('images/fabric/').concat(parameters[menu][submenu].image_name);
                                                      
                            $.post('<?= site_url("Design/getProductPreview/"); ?>',{image:img_src, blend:blend_path },function(dataurl){

                                   elem.setAttribute("src", dataurl);

                            });
                        }


                    }

                }
            
        }
    }
    
    function apply_parameters(){
        
        
        for (var menu in parameters) {
            
            
            document.getElementById("design-preview").innerHTML = "";
            
            image_path = "<?= base_url("assets/images/products/").'/'.$base_images['front']['name']; ?>";
            var elem = document.createElement("img");
            get_image_source_after_blend(image_path, elem);
            //elem.setAttribute("src", image_path);
            elem.setAttribute("class", "preview-image");
            document.getElementById("design-preview").appendChild(elem);

            for(var submenu in parameters[menu]){

                
                if(!isEmpty(parameters[menu][submenu])){

                        
                    if(parameters[menu][submenu].type == 0){
                        

                        var image_path = "<?php echo ASSETS_PATH; ?>";
                        image_path = image_path.concat('images/style/').concat(parameters[menu][submenu].image_name);
                        var elem = document.createElement("img");
                        get_image_source_after_blend(image_path, elem);
                        //elem.setAttribute("src", image_path);
                        elem.setAttribute("class", "preview-image");
                        document.getElementById("design-preview").appendChild(elem);
                        

                    }


                }

            }
            
        }
    }
    
    
    
    function option_selected(option_id){
       
       var xmlhttp = new XMLHttpRequest();
       
       xmlhttp.onreadystatechange = function() {
		
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
                    var option_object =  JSON.parse(xmlhttp.responseText);
                                        
                    parameters[menu_index][submenu_index].image_name = option_object["image_name"];
                    
                    apply_parameters();
											
		}
	};
         
       var site_url = "<?php echo base_url("index.php/admin/get_option"); ?>";
        	
	site_url = site_url.concat("/").concat(option_id);
		
	xmlhttp.open("GET", site_url, true);
	
	xmlhttp.send();
       
    }
    
        

function LoadOptions(submenu_id){
	
        submenu_index = submenu_id;
                
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
			var json_array =  JSON.parse(xmlhttp.responseText);
			
			document.getElementById('option-list').innerHTML = "";
			
			for (var key in json_array) {
				
				var dir_name = json_array[key]['caption'].split("_")[0];
								
				var image_path = '<?php echo ASSETS_PATH; ?>'.concat('images/').concat(dir_name).concat('/').concat(json_array[key]['caption']);
				
				var image_element = document.createElement("img");
				image_element.setAttribute("src", image_path);
				image_element.setAttribute("height", "100");
				image_element.setAttribute("width", "96");
				
				var link_element = document.createElement("a");
				link_element.appendChild(image_element);
                                
                                var list_element = document.createElement("li");
                                var function_string = "option_selected(".concat(json_array[key]['id']).concat(")")
                                list_element.setAttribute("onclick", function_string);
                                list_element.appendChild(link_element);
				
				document.getElementById("option-list").appendChild(list_element);
                                
                                var $frame = $('#design_options');
        
                                var $wrap  = $frame.parent();

                                
                                
                                sly.reload();
                            
                                 
				
				
			}
                        
                       
                        
                        
                        
		}
	};
        
        var site_url = "<?php echo base_url("index.php/admin/get_options"); ?>";
        	
	site_url = site_url.concat("/").concat(submenu_id);
		
	xmlhttp.open("GET", site_url, true);
	
	xmlhttp.send();
}

function LoadSubMenus(selected_menu) {
	
        menu_index = selected_menu;
        
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
			var json_array =  JSON.parse(xmlhttp.responseText);
                        			
			$('#sub_menu_list').empty();
                        			
			for (var key in json_array) {
				
                                
                                var on_click = 'return LoadOptions('.concat(json_array[key]['id']).concat(');');
                                
				$('#sub_menu_list').append(
					$('<a>').attr('href', '#').attr('value', json_array[key]['id']).attr('onclick', on_click).attr('class', 'list-group-item').append(
							$('<span>').attr('class', 'tab').append(json_array[key]['name'])
				)); 
			}
							
		}
	};
        
        var site_url = "<?php echo base_url("index.php/admin/get_submenus"); ?>";
		
	site_url = site_url.concat("/").concat(<?php if(isset($product_id)) echo $product_id; else echo "-1" ?>).concat("/").concat(selected_menu);
		
	xmlhttp.open("GET", site_url, true);
	
	xmlhttp.send();
    
}

</script>

<!-- Desing Page -->
<div class='design-page'>
	<div id='' class='container'>
		<div id='' class="row">
		
			<!-- MAIN MENUS  -->
			
			<div id='' class=' design-menu col-sm-4'>
				<div id='main_menu' class='design-menu-header'>Design Menu</div>
                                <div id='main_menu_list' class="list-group">
                                    <?php foreach ($menus->result() as $row) {?>
                                            <a  value="<?php echo $row->id; ?>" onclick="LoadSubMenus(<?php echo $row->id; ?>)" href="#" class="list-group-item"><?php echo $row->name; ?></a>				
                                    <?php }?>				
				</div>
			</div>
                        
                        <div id='sub_menu_list' class="col-sm-2">
                            
                        </div>
                        
                        <div id='design-preview' class='design-preview  col-sm-6'>
                            
                        </div>
                        
                </div>
            
			<!-- END MAIN MENUS  -->
			                                                                                            
                <div class="wrap">  
                        <div class="scrollbar">
                                <div class="handle">
                                        <div class="mousearea"></div>
                                </div>
                        </div>

                        <div class="frame" id="design_options">
                                <ul class="clearfix" id="option-list">
                                    <!--
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/1.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/2.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/3.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/4.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/5.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/6.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/7.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/8.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/9.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/10.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/11.png"); ?>" width="96%" height="100%"></a></li>
                                        <li><a ><img src="<?= base_url("assets/images/design/fabriques/12.png"); ?>" width="96%" height="100%"></a></li>
                                    -->
                                </ul>
                        </div>

                </div>

                                    
					
		
	</div>
</div>
