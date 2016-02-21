<script>
    var sly;
    var parameters;
    var menu_index;
    var submenu_index;
    
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
    
    function apply_parameters(){
        
        for (var menu in parameters) {
            
            
            document.getElementById("design-preview").innerHTML = "";
            
            image_path = "<?= base_url("assets/images/products/").'/'.$base_images['front']['name']; ?>";
            var elem = document.createElement("img");
            elem.setAttribute("src", image_path);
            elem.setAttribute("class", "preview-image");
            document.getElementById("design-preview").appendChild(elem);

            for(var submenu in parameters[menu]){

                if(parameters[menu][submenu].length != 0){

                    if(parameters[menu][submenu].type == 0){

                        var image_path = "<?php echo ASSETS_PATH; ?>";
                        image_path = image_path.concat('images/style/').concat(parameters[menu][submenu].image_name);
                        var elem = document.createElement("img");
                        elem.setAttribute("src", image_path);
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
             
       var site_url = "<?php echo site_url('admin/get_option') ?>";
        	
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
	
	var site_url = "<?php echo site_url('admin/get_options') ?>";
        	
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
			
			$('#sub_menu ul').empty();
			
			for (var key in json_array) {
				
				$('#sub_menu ul').append(
					$('<li>').attr('value', json_array[key]['id']).attr('onclick', 'LoadOptions(this.value)').append(
						$('<a>').append(
							$('<span>').attr('class', 'tab').append(json_array[key]['name'])
				))); 
			}
							
		}
	};
	
	var site_url = "<?php echo site_url('admin/get_submenus') ?>";
	
	site_url = site_url.concat("/").concat(<?php if(isset($product_id)) echo $product_id; else echo "-1" ?>).concat("/").concat(selected_menu);
		
	xmlhttp.open("GET", site_url, true);
	
	xmlhttp.send();
    
}

</script>

<!-- Desing Page -->
<div class='design-page'>
	<div id='' class='container'>
		<div id='' class='row'>
		
			<!-- MAIN MENUS  -->
			
			<div id='' class='col-md-2 col-sm-2 design-menu'>
				<div id='main_menu' class='design-menu-header'>Design Menu</div>
				<ol id='main_menu_list'>
				<?php foreach ($menus->result() as $row) {?>
					<li value="<?php echo $row->id; ?>" onclick="LoadSubMenus(<?php echo $row->id; ?>)"><a><?php echo $row->name; ?></a></li>				
				<?php }?>				
				</ol>
			</div>
			
			<!-- END MAIN MENUS  -->
			
			<div id='' class='col-md-10 col-sm-10'>
				<div id='' class='row'>
				
					<!-- SUB MENUS  -->
					
					<div id='' class='col-md-2 col-sm-2' style='padding:0;'>
						<div id='sub_menu' class='design-sub-menu'>
							<ul id='sub_menu_list'>
								<?php if(isset($product_submenus)) foreach($product_submenus->result() as $submenu) {?>
								
								<li value="<?php echo $submenu->id; ?>"><a><?php echo $submenu->name; ?></a></li>
								
								<?php } ?>
							</u>
						</div>
					</div>
					
					<!-- END SUB MENUS  -->
					
					                                        
					<div id='' class='col-md-8 col-sm-8' style='padding:0'>
                                            <div id='design-preview' class='design-preview'><img src="<?= base_url("assets/images/products/").'/'.$base_images['front']['name']; ?>" class="preview-image" /></div>
					</div>
					<div id='' class='col-md-2 col-sm-2 design-side'>
						<h4>SIDES</h4>

						<ul>
							<li class='active' ><a href="#">
								<h5>Front</h5>
								<img src="<?= base_url("assets/images/design/front.png"); ?>">
							</a></li>
							<li><a href="#">
								<h5>Back</h5>
								<img src="<?= base_url("assets/images/design/back.png"); ?>">
							</a></li>

						</ul>
					</div>
				</div>
                            
                                
				<div class='fabrique-heading'>Chose Your Fabrique</div>
                                    
                                <div class="wrap">  
                                        <div class="scrollbar">
                                                <div class="handle">
                                                        <div class="mousearea"></div>
                                                </div>
                                        </div>

                                        <div class="frame" id="design_options">
                                                <ul class="clearfix" id="option-list">
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
                                                </ul>
                                        </div>

                                </div>

                                    
					
			</div>
		</div>
	</div>
</div>
