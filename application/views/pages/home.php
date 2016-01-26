<!DOCTYPE html>
<html lang="en">
    
    
 <link href="<?php echo ASSETS_PATH; ?>css/design_button_style.css" rel="stylesheet">
 <link href="<?php echo ASSETS_PATH; ?>frameworks/ninja-slider/ninja-slider.css" rel="stylesheet">
 <script src="<?php echo ASSETS_PATH; ?>frameworks/ninja-slider/ninja-slider.js"></script>
 <script src="<?php echo ASSETS_PATH; ?>js/button_script.js"></script>

  <body>

	 <!--start ninja slider-->

    <div id="ninja-slider">

        <div class="slider-inner">

            <ul>

                <li>

                    <a class="ns-img" href="<?php echo ASSETS_PATH; ?>frameworks/ninja-slider/img/6.jpg"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

                <li>

                    <a class="ns-img" href="<?php echo ASSETS_PATH; ?>frameworks/ninja-slider/img/1.png"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

                <li>

                    <a class="ns-img" href="<?php echo ASSETS_PATH; ?>frameworks/ninja-slider/img/1.jpg"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

                <li>

                    <a class="ns-img" href="<?php echo ASSETS_PATH; ?>frameworks/ninja-slider/img/5.jpg"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

                <li>

                    <a class="ns-img" href="<?php echo ASSETS_PATH; ?>frameworks/ninja-slider/img/3.jpg"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

            </ul>

            <div class="navsWrapper">

                <div id="ninja-slider-prev"></div>

                <div id="ninja-slider-next"></div>

            </div>

        </div>

    </div>

    <!--end ninja slider-->	
	
	<div class='start-customizing'>
  		
		<a href="#">
  <div class="button-fill grey">
    <div class="button-text"><?php echo $this->lang->line('shmyde_men_button_text'); ?></div>
    <div class="button-inside">
      <div class="inside-text"><?php echo $this->lang->line('shmyde_men_button_text'); ?></div>
    </div>
  </div></a>
  
  <a href="#">
  <div class="button-fill orange">
    <div class="button-text"><?php echo $this->lang->line('shmyde_women_button_text'); ?></div>
    <div class="button-inside">
      <div class="inside-text"><?php echo $this->lang->line('shmyde_women_button_text'); ?></div>
    </div>
  </div></a>

	</div>

	<!-- first band -->
	<div class='middle-band'>
		<p><?php echo $this->lang->line('shmyde_247_customer_service'); ?></P>
		<p><b>info @ shmyde.com</b></P>
	</div>	
	<!-- end first band -->	

	
	<!-- Statistics Section -->
	<div class='stat-section'>


		<div class='container statistics'>
				<div class='row'>
				
					<div class='col-md-2 col-sm-3'>
						<p><?php echo $this->lang->line('shmyde_tailors'); ?></p>
						<img src='<?php echo ASSETS_PATH; ?>/images/tailors-stat.png'/>
						<p><b>43</b><p>
					</div>
					
					<div class='col-md-2 col-sm-3'>
						<p><?php echo $this->lang->line('shmyde_testimonials'); ?></p>
						<img src='<?php echo ASSETS_PATH; ?>/images/testimonials.png'/>
						<p><b>175</b><p>
					</div>
					
					
					<div class='col-md-2 col-sm-3'>
						<p><?php echo $this->lang->line('shmyde_deliveries'); ?></p>
						<img src='<?php echo ASSETS_PATH; ?>/images/deliveries.png'/>
						<p><b>358</b><p>
					</div>
					
					
					<div class='col-md-6 col-sm-3'></div>
					
				</div>
				
				<div class='row'>
				
					<div class='col-md-2 col-sm-3'>
						<p><?php echo $this->lang->line('shmyde_tweeter'); ?></p>
						<img src='<?php echo ASSETS_PATH; ?>/images/tweeter.png'/>
						<p><b>43</b><p>
					</div>
					
					<div class='col-md-2 col-sm-3'>
						<p><?php echo $this->lang->line('shmyde_facebook'); ?></p>
						<img src='<?php echo ASSETS_PATH; ?>/images/facebook.png'/>
						<p><b>175</b><p>
					</div>
					
					
					<div class='col-md-2 col-sm-3'>
						
					</div>
					
					
					<div class='col-md-6 col-sm-3'></div>
					
				</div>
				
			</div>
	</div>
	<!-- end Statistics Section -->


	<!-- second band -->
	<div class='middle-band'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
					<P><?php echo $this->lang->line('shmyde_teaser_line_01'); ?></P>
					<center><p><b><?php echo $this->lang->line('shmyde_teaser_line_02'); ?></b></p></center>
				</div>
			</div>
		</div>
	</div>	
	<!-- end second band -->	

	<!-- models section -->
	<div class='models'>
		<div class='bg-video'>
				<video muted loop autoplay>
				  <source src="<?php echo ASSETS_PATH; ?>/videos/Model Tailor WorkShop.mp4" type="video/mp4">
				  <source src="<?php echo ASSETS_PATH; ?>/videos/Model Tailor WorkShop.ogg" type="video/ogg">
				  <?php echo $this->lang->line('shmyde_video_tag_not_supported'); ?>
				</video>	
		</div>

		<div class='offers'>

				<div class='grid'> 
					<figure class="effect-sadie">
						<img src="<?php echo ASSETS_PATH; ?>/images/models/men-suits.png" alt="img02"/>
						<figcaption>
							<h2><?php echo $this->lang->line('shmyde_men_button_test'); ?><span><?php echo $this->lang->line('shmyde_suits'); ?></span></h2>
							<a href="#"><?php echo $this->lang->line('shmyde_view_more'); ?></a>
						</figcaption>			
					</figure> 
					<figure class="effect-sadie">
						<img src="<?php echo ASSETS_PATH; ?>/images/models/women-suits.png" alt="img02"/>
						<figcaption>
							<h2><?php echo $this->lang->line('shmyde_women_button_test'); ?> <span><?php echo $this->lang->line('shmyde_suits'); ?></span></h2>
							<a href="#"><?php echo $this->lang->line('shmyde_view_more'); ?></a>
						</figcaption>			
					</figure> 
					<figure class="effect-sadie">
						<img src="<?php echo ASSETS_PATH; ?>/images/models/jeans.png" alt="img02"/>
						<figcaption>
							<h2><span><?php echo $this->lang->line('shmyde_jeans'); ?></span></h2>
							<a href="#"><?php echo $this->lang->line('shmyde_view_more'); ?></a>
						</figcaption>			
					</figure> 
					<figure class="effect-sadie">
						<img src="<?php echo ASSETS_PATH; ?>/images/models/t-shirts.png" alt="img02"/>
						<figcaption>
							<h2>T-<span><?php echo $this->lang->line('shmyde_shirts'); ?></span></h2>
							<a href="#"><?php echo $this->lang->line('shmyde_view_more'); ?></a>
						</figcaption>			
					</figure>
				</div>

				
				<div class='grid' style="z-index:30">
					<figure class="effect-honey">
						<img src="<?php echo ASSETS_PATH; ?>/images/models/popular.png" alt="img05"/>
						<figcaption>
							<h2>POPULAR<span>MODELS</span></h2>
							<a href="#"><?php echo $this->lang->line('shmyde_view_more'); ?></a>
						</figcaption>			
					</figure>
				</div>

		</div>

	</div>
	<!-- end models section --->	

<script>
	 $(".button-fill").hover(function () {
    $(this).children(".button-inside").addClass('full');
}, function() {
  $(this).children(".button-inside").removeClass('full');
});
</script>	
