<?php
/*
* Template Name: Send email for the new password
*/
ob_start();
get_header(); ?>
	<div class="grid">
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Восстановление Пароля</h2>
							<h3 class="colortext">Введите свой email и получите новую ссылку для изменения пароля</h3>
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
						<div class="bd">
							
							<div class="mod"> 
								<b class="top"><b class="tl"></b><b class="tr"></b></b> 
									<div class="inner">
										<div class="hd">
											<h3 class="center">Получить Ссылку</h3>
										</div>
									</div>
								<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
							</div>
							
							<?php
								require_once(IMMISTUDY_DIR . '/classes/membership.php');
								$message = "";
								if( isset($_POST["action"]) && $_POST["action"] == "newPass" ){
									$member_email = $_POST['newpassword-email'];
									if( !empty($member_email) && filter_var($member_email, FILTER_VALIDATE_EMAIL) ){
										$mysql = new Mysql();
										$isMember = $mysql->get_member_by_email($member_email);
										if(!empty($isMember)){
											$member = new Membership();
											if($member->make_new_password($member_email)){
												header("Location: " . SITE_URL . "/newpass_emailExec");
											} 
										} else {
											$message = "Пользователь с таким электронным адресом не зрегистрирован.";
										}
									} else {
										$message = "Поле Адрес почты должно быть заполнено.";
									}	
								
								}
							?>
							
							<form action="<?php echo SITE_URL; ?>/newpass_email"
								  method="post"	
								  name="email-newpassword-form"
								  id="email-newpassword-form">
								<p>
									<label class="placeholder">
										<span>Адрес почты</span>
										<input type="text" class="email" name="newpassword-email" id="newpassword-email"  maxlength="50"/>	
									</label>
								</p>
								
								<input type="hidden" name="action" value="newPass" />
								<p class="register-message"><?php echo $message; ?></p>
								<button type="submit" name="newpassword">Отправить</button>
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
												<p>Зарегистрированные пользователи могут оценить свои шансы на обучение, иммиграцию, и получение работы за рубежом</p>
												
												<button class="center yellowBack">Зарегистрироваться</button>
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

	<script>
		$(document).ready(function () {
			var newPasswordForm = new FormValidation('#email-newpassword-form');
			newPasswordForm.labelShowHide('#email-newpassword-form');
		});	
	</script>
	<script src="<?php echo ROOT_URL; ?>/scripts/formValidation.js"></script>

<?php get_footer('help'); ?>