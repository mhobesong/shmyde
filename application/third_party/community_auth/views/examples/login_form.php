<!--
Author: DesignMaz
Author URL: https://www.designmaz.net
License URL: https://www.designmaz.net/licence/
-->
<head>
<title>Responsive Static Login Form HTML5 Template | DesignMaz</title>
<!-- Custom Theme files -->
<link href="<?php echo $application_path; ?>css/login_registration_style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<script src="<?php echo $application_path; ?>js/jquery.min.js"></script>
<script src="<?php echo $application_path; ?>js/easyResponsiveTabs.js" type="text/javascript"></script>
		    <script type="text/javascript">
			    $(document).ready(function () {
			        $('#horizontalTab').easyResponsiveTabs({
			            type: 'default', //Types: default, vertical, accordion           
			            width: 'auto', //auto or any width like 600px
			            fit: true   // 100% fit in a container
			        });
			    });
				
</script>

<!---Google Analytics Designmaz.net-->
<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-35751449-15', 'auto');ga('send', 'pageview');</script>
</head>



<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Login Form View
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2016, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */


if(!isset( $on_hold_message ) )
{
	if( isset( $login_error_mesg ) )
	{
		echo '
			<div style="border:1px solid red;">
				<p>
					Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username, Email Address, or Password.
				</p>
				<p>
					Username, email address and password are all case sensitive.
				</p>
			</div>
		';
	}

	if( $this->input->get('logout') )
	{
		echo '
			<div style="border:1px solid green">
				<p>
					You have successfully logged out.
				</p>
			</div>
		';
	}

?>

<body>
	<div class="head">
		<div class="logo">
			<div class="logo-top">
				<h1>SHMYDE LOGIN</h1>
			</div>
			<div class="logo-bottom">
				<section class="sky-form">									
					<label class="radio"><input type="radio" name="radio" checked=""><i></i>Ut mattis mattis bibendum</label>
					<label class="radio"><input type="radio" name="radio"><i></i>Nullam rutrum sagittis interdum</label>										
					<label class="radio"><input type="radio" name="radio"><i></i>Nam cursus eros sed elit</label>
				</section>
			</div>
		</div>		
		<div class="login">
			<div class="sap_tabs">
				<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
					<ul class="resp-tabs-list">
						<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Login</span></li>
						<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><label>/</label><span>Sign up</span></li>
						<div class="clearfix"></div>
					</ul>				  	 
					<div class="resp-tabs-container">
						<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
							<div class="login-top">
								<?php echo form_open( $login_url ); ?>
									<input name="login_string" type="text" class="email" placeholder="Email" required=""/>
									<input name="login_pass" type="password" class="password" placeholder="Password" required=""/>	
									<div class="login-bottom login-bottom1">
									<div class="submit">
										<input type="submit" value="LOGIN"/>
									</div>
									<ul>
										<li><p>Or login with</p></li>
										<li><a href="#"><span class="fb"></span></a></li>
										<li><a href="#"><span class="twit"></span></a></li>
										<li><a href="#"><span class="google"></span></a></li>
									</ul>
									<div class="clear"></div>
								</div>		
								</form>
							</div>
						</div>
						<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
						<div class="login-top">
								<?php echo form_open( $registration_url ); ?>
									<input name="username" type="text" class="name active" placeholder="Your Name" required=""/>
									<input name="email" type="text" class="email" placeholder="Email" required=""/>
									<input name="password" type="password" class="password" placeholder="Password" required=""/>
									<div class="login-bottom">
									<div class="submit">
										<input type="submit" value="SIGN UP"/>
									</div>
									<ul>
										<li><p>Or login with</p></li>
										<li><a href="#"><span class="fb"></span></a></li>
										<li><a href="#"><span class="twit"></span></a></li>
										<li><a href="#"><span class="google"></span></a></li>
									</ul>
									<div class="clear"></div>
								</div>		
								</form>
	
							</div>
							
						</div>							
					</div>	
				</div>
			</div>	
		</div>	
		<div class="clear"></div>
	</div>	
	<div class="account">
			<ul>
				<li><p>Don't have an <a href="#">account?</a></p></li><span>/</span>
				<li><p>Forgot <a href="#">password?</a></p></li>
				<div class="clear"></div>
			</ul>
		</div>
	<div style="text-align:center; margin-top:10px;">
				<ins class="adsbygoogle"
style="display:block"
data-ad-client="ca-pub-8011246932591811"
data-ad-slot="9844648019"
data-ad-format="auto"></ins> <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				</div>
	<div class="footer">
		<p>Template by <a href="https://www.designmaz.net/" target="_blank">Designmaz</a> </p>
	</div>
</body>

<?php

	}
	else
	{
		// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
		echo '
			<div style="border:1px solid red;">
				<p>
					Excessive Login Attempts
				</p>
				<p>
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				<p>
				<p>
					Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
				</p>
				<p>
					Please use the ' . secure_anchor('examples/recover','Account Recovery') . ' after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				</p>
			</div>
		';
	}

/* End of file login_form.php */
/* Location: /views/examples/login_form.php */ 