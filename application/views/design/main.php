<script>

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
				image_element.setAttribute("height", "30");
				image_element.setAttribute("width", "30");
				
				var link_element = document.createElement("a");
				link_element.setAttribute('href', '#');
				link_element.appendChild(image_element);
				
				document.getElementById("design_options").appendChild(link_element);
				
				
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
				<div id='' class='row design-fabrique'>
					<div class="col-sm-2 col-md-2 design-part">
						<img src="<?= base_url("assets/images/design/shirt/part-preview/collar-button.png"); ?>">
					</div>
					<div class="col-sm-8 col-md-8" id="design_options">
						
						<!--
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/default-white.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/1.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/2.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/3.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/4.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/5.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/6.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/7.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/8.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/9.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/10.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/11.png"); ?>"></a>
						<a href="#"><img class='active' src="<?= base_url("assets/images/design/fabriques/12.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/13.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/14.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/15.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/16.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/17.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/18.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/19.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/20.png"); ?>"></a>
						<a href="#"><img src="<?= base_url("assets/images/design/fabriques/21.png"); ?>"></a>
						
						-->
						
					</div>
					<div class="col-sm-2 col-md-2"></div>
				</div>
			</div>
		</div>
	</div>
</div>
