<?php 
/**
 * The template for displaying all pages.
 *
 * Template name: Login-Register page
 */
ob_start();
require_once(IMMISTUDY_DIR . '/classes/membership.php');
$membership = New Membership();
$membership->sec_session_start();
 
if(isset($_GET['status']) && $_GET['status'] == 'loggedout'){
	$membership->log_member_out();
	$response = "Вы успешно вышли из личного кабинета";
} 

if( !empty($_COOKIE['remember_me']) ){
	$mysql = new Mysql();
	
	if ( $membership->checkbrute( $mysql->get_id_by_email($_COOKIE['remember_me']), 2, 30 * 60 ) ){
		//if there were 3 failed attempts in 15 minutes
		header("location: " . SITE_URL . "/login_captcha"); 
		exit();
	}
}	

if(isset($_POST['login']) && !empty($_POST['login_email']) && !empty($_POST['login_password'])) {
	setcookie('remember_me', $_POST['login_email'], time() + 60 * 60 * 24 *365, "", "", false, true );
	$response = $membership->validate_user( $_POST['login_email'], $_POST['login_password'] );
}

get_header(); ?>

	
	<div class="grid">
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Войти в Личный Кабинет</h2>
							<h3 class="colortext">Здесь вы можете зарегистрироваться и зайти в ваш личный кабинет</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>	
	
	
	<div class="grid">
		<div class="unit blockOneHalf">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<div class="hd">
								
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<div class="hd">
												<h3 class="center">Авторизация</h3>
											</div>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
								
							</div>
							<div class="bd">
								
								<script type="text/javascript">
								 var RecaptchaOptions = {
								    theme : 'custom',
								    custom_theme_widget: 'recaptcha_widget',
								   	lang : 'ru'
								 };
								 </script>
								
								<form 
									  method="post"	
									  id="login_form">
									
									<?php 
									if(isset($response)) echo '<p class="register-message">' . $response . '</p>';
									?>
									<p>
										<label class="placeholder">
											<span>Адрес почты</span>
											<input type="text" class="required" name="login_email" id="login_email" value="<?php echo isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : ""; ?>" maxlength="50"/>
										</label>
									</p>
									<p>
										<label class="placeholder">
											<span>Пароль</span> 
											<input type="password" class="required" name="login_password" 
												id="login_password"  maxlength="50"/>
										</label>
									</p>
										
									<div class="unit blockOneHalf">
										<button type="submit" name="login">Войти</button>
									</div>
										
									<div class="unit blockOneHalf">
										<a href="<?php echo site_url(); ?>/newpass_email/" class="alignright black">Забыли пароль?</a>
									</div>	
								</form>
							</div>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		
		
			<div class="unit blockOneHalf">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<div class="hd">
								
								
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<div class="hd">
												<h3 class="center">Регистрация</h3>
											</div>
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
								
								
								<div class="mod"> 
									<b class="top"><b class="tl"></b><b class="tr"></b></b> 
										<div class="inner">
											<form action="<?php echo site_url();?>/register/"
													  method="post"	
													  id="login-form">
												<div class="bd">
													<p>Зарегистрированные пользователи могут заполнить анкету на обучение, иммиграцию, и получение работы за рубежом</p>
													
													<p class="center"><button class="yellowBack">Зарегистрироваться</button></p>
												</div>
											</form>	
										</div>
									<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
								</div>
								
						
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		
		</div>
	</div>	
	

	

<script type="text/javascript">
	
	$(document).ready(function () {
		var loginForm = new FormValidation('#login_form');
		loginForm.labelShowHide('#login_form');
		$('#login_form').submit(function () {
		    return loginForm.validate();
		});	
	});	
	
</script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/formValidation.js"></script>



<?php get_footer('help'); ?>