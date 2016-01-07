<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SHMYDE</title>
    
    <?php $application_path = base_url().'assets/';  ?>

    <!-- Bootstrap -->
    <link href="<?php echo $application_path; ?>frameworks/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $application_path; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo $application_path; ?>frameworks/ninja-slider/ninja-slider.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>


	

	<div class='top-menu'>
	
	<div class="logo-section">
		<p>START DESIGN</p>
		<img src="<?php echo $application_path; ?>images/logo_shmyde.png" class="logo-image">
		<p>GET PRODUCT</p>
	</div>
	
		<ul>
			<li><a href='#'>ABOUT US</a></li>
			<li><a href='#'>CONTACT US</a></li>
			<li><a href='#'>REVIEW</a></li>
			<li><a href='#'>FAQ</a></li>

		</ul>
	</div> 


	 <!--start ninja slider-->

    <div id="ninja-slider">

        <div class="slider-inner">

            <ul>

                <li>

                    <a class="ns-img" href="<?php echo $application_path; ?>frameworks/ninja-slider/img/6.jpg"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

                <li>

                    <a class="ns-img" href="<?php echo $application_path; ?>frameworks/ninja-slider/img/1.png"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

                <li>

                    <a class="ns-img" href="<?php echo $application_path; ?>frameworks/ninja-slider/img/1.jpg"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

                <li>

                    <a class="ns-img" href="<?php echo $application_path; ?>frameworks/ninja-slider/img/5.jpg"></a>

                    <div class="caption">
						<b>Laborum ipsum senectus</b>
						<div>Fugiat voluptatem Fugiat voluptatem in harum nam</div>
					</div>

                </li>

                <li>

                    <a class="ns-img" href="<?php echo $application_path; ?>frameworks/ninja-slider/img/3.jpg"></a>

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
		<a href='#'><img src='<?php echo $application_path; ?>images/start-customizing.png'></a>
	</div>

	<!-- first band -->
	<div class='middle-band'>
		<p>CUSTOMER SERVICE 24 / 7</P>
		<p><b>info @ shmyde.com</b></P>
	</div>	
	<!-- end first band -->	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo $application_path; ?>frameworks/jquery/jquery-1.11.3.min.js"></script>
    <script src="<?php echo $application_path; ?>frameworks/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $application_path; ?>frameworks/ninja-slider/ninja-slider.js"></script>
  </body>
</html>
