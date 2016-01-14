<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>
    
    <!-- Bootstrap -->
    <link href="<?php echo $application_path; ?>frameworks/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $application_path; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo $application_path; ?>css/set1.css" rel="stylesheet">
    <link href="<?php echo $application_path; ?>frameworks/ninja-slider/ninja-slider.css" rel="stylesheet">
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo $application_path; ?>frameworks/jquery/jquery-1.11.3.min.js"></script>
    <script src="<?php echo $application_path; ?>frameworks/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $application_path; ?>frameworks/ninja-slider/ninja-slider.js"></script>

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
		<a href="<?php echo site_url('pages/view/home'); ?>">
		<img src="<?php echo $application_path; ?>images/logo_shmyde.png" class="logo-image">
		</a>
		<p>GET PRODUCT</p>
	</div>
	
		<ul>
			<li><a href='<?php echo site_url('pages/view/about-us'); ?>'><?php echo $this->lang->line('shmyde_about_us'); ?></a></li>
			<li><a href='<?php echo site_url('pages/view/contact-us'); ?>'><?php echo $this->lang->line('shmyde_contact_us'); ?></a></li>
			<li><a href='<?php echo site_url('pages/view/review'); ?>'><?php echo $this->lang->line('shmyde_review'); ?></a></li>
			<li><a href='<?php echo site_url('pages/view/faq'); ?>'><?php echo $this->lang->line('shmyde_faq'); ?></a></li>

		</ul>
	</div> 



  </body>
</html>
