<script>
  
jQuery(function($){
	'use strict';


	// -------------------------------------------------------------
	//   Centered Navigation
	// -------------------------------------------------------------
	(function () {
		var $frame = $('#design_options');
		var $wrap  = $frame.parent();

		// Call Sly on frame
		 $frame.sly({
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
			clickBar: 1,

			// Buttons
			prev: $wrap.find('.prev'),
			next: $wrap.find('.next')
		});
	}());

});
    

function LoadOptions(submenu_id){
	
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
			var json_array =  JSON.parse(xmlhttp.responseText);
			
			document.getElementById('design_options').innerHTML = "";
			
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
                                list_element.appendChild(link_element);
				
				document.getElementById("design_options").appendChild(list_element);
				
				
			}
                        
                        if(json_array.lenght > 0){
                            
                            var $frame = $('#design_options');
                            var $wrap  = $frame.parent();

                            // Call Sly on frame
                             $frame.sly({
                                    horizontal: 1,
                                    itemNav: 'centered',
                                    smart: 1,
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
                                    clickBar: 1,

                                    // Buttons
                                    prev: $wrap.find('.prev'),
                                    next: $wrap.find('.next')
                            });
                        }
                        
		}
	};
	
	var site_url = "<?php echo site_url('admin/get_options') ?>";
	
	site_url = site_url.concat("/").concat(submenu_id);
		
	xmlhttp.open("GET", site_url, true);
	
	xmlhttp.send();
}

function LoadSubMenus(selected_menu) {
	
	var xmlhttp = new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
			var json_array =  JSON.parse(xmlhttp.responseText);
			
			$('#sub_menu ul').empty();
			
			for (var key in json_array) {
				
				$('#sub_menu ul').append(
					$('<li>').attr('value', json_array[key]['id']).attr('onclick', 'LoadOptions(this.value)').append(
						$('<a>').attr('href','#').append(
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
				<ol>
				<?php foreach ($menus->result() as $row) {?>
					<li value="<?php echo $row->id; ?>" onclick="LoadSubMenus(<?php echo $row->id; ?>)"><a href="#"><?php echo $row->name; ?></a></li>				
				<?php }?>				
				</ol>
			</div>
			
			<!-- END MAIN MENUS  -->
			
			<div id='' class='col-md-10 col-sm-10'>
				<div id='' class='row'>
				
					<!-- SUB MENUS  -->
					
					<div id='' class='col-md-2 col-sm-2' style='padding:0;'>
						<div id='sub_menu' class='design-sub-menu'>
							<ul>
								<?php if(isset($product_submenus)) foreach($product_submenus->result() as $submenu) {?>
								
								<li value="<?php echo $submenu->id; ?>"><a href="#"><?php echo $submenu->name; ?></a></li>
								
								<?php } ?>
							</u>
						</div>
					</div>
					
					<!-- END SUB MENUS  -->
					
					
					<div id='' class='col-md-8 col-sm-8' style='padding:0'>
						<div id='' class='design-preview'><img src="<?= base_url("assets/images/design/shirt/base_shirt.png") ?>" /></div>
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
                                                <ul class="clearfix">
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

                                        <div class="controls center">
                                                <button class="btn prev"><i class="icon-chevron-left"></i> prev</button>
                                                <button class="btn next">next <i class="icon-chevron-right"></i></button>
                                        </div>
                                </div>

                                    
					
			</div>
		</div>
	</div>
</div>
