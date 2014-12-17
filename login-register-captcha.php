<?php 
/**
 * The template for displaying all pages.
 *
 * Template name: Login-Register-captcha page
 */
ob_start();
require_once(IMMISTUDY_DIR . '/classes/membership.php');
$membership = New Membership();
$membership->sec_session_start();
$year = time()+31536000;

if( isset($_POST['login_email']) ) {
	setcookie('remember_me', $_POST['login_email'], $year);
} elseif(!isset($_POST['login_email'])){
	if( isset($_COOKIE['remember_me']) ){
		$past = time() - 100;
		setcookie('remember_me', 'gone', $past);
	}
}

if(isset($_GET['status']) && $_GET['status'] == 'loggedout'){
	$membership->log_member_out();
	$response = "Вы успешно вышли из личного кабинета";
}

if(isset($_POST['login']) && !empty($_POST['login_email']) && !empty($_POST['login_password'])) {
	$response = $membership->validate_user_captcha($_POST['login_email'], $_POST['login_password']);
}
?>
<?php get_header(); ?>

	
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
								
								<form action=""
									  method="post"	
									  id="login_form">
									<?php 
									if(isset($response)) echo '<p class="register-message center margin_bottom">' . $response . '</p>';
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
									
									<h3 class="center">Заполните Капчу</h3>
									<p>
										<div id="recaptcha_widget">
											<h3 class="center"></h3>
											<p><div class="alignleft margin_bottom" id="recaptcha_image"></div></p>
											<p class="alignright margin_bottom margin_top"><a class="none red" href="javascript:Recaptcha.reload()">Обновить</a></p>
																
											<div class="recaptcha_only_if_incorrect_sol"><p class="register-message">Неправильная капча</p></div>
											<label class="placeholder">
												<span class="recaptcha_only_if_image">Слово с картинки</span> 
												<input type="text" class="required" id="recaptcha_response_field" name="recaptcha_response_field" maxlength="50"/>
											</label>
										</div>
																
										<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6LdkG-ESAAAAAK9HmGRz4-SfXZ2_hnVWMyXDmlsA">
										</script>
												
										<noscript>
											<iframe src="http://www.google.com/recaptcha/api/noscript?k=6LdkG-ESAAAAAK9HmGRz4-SfXZ2_hnVWMyXDmlsA" height="300" width="500" frameborder="0"></iframe><br>
											<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
											<input type="hidden" name="recaptcha_response_field" value="manual_challenge">
										</noscript>
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