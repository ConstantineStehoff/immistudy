<?php
/*
* Template Name: Change Password Page
*/
get_header();


if(isset($_GET['CODE'], $_GET['USER_LOGIN'])){//if both variables are set
	require_once(IMMISTUDY_DIR . '/classes/membership.php');
	$mysql = new Mysql();
	$member = new Membership();
	$message = "";
	
	$activation =  mysql_escape_string($_GET['CODE']); //validate both variables
	$user_login =  mysql_escape_string($_GET['USER_LOGIN']);
	//if they are both not empty and there is a user with this email and the code
	if( !empty($activation) && !empty($user_login) && $mysql->check_member_email_actCode($user_login, $activation) ){ 
		//if the form was submitted
		if( isset($_POST["action"]) && $_POST["action"] == "password" ){ 
			//if the password was filled and not empty
			$password = $_POST["newpassword-pass"];
			$password2 = $_POST["newpassword-pass2"];
			if( isset($password, $password2) && !empty($password2) && !empty($password) 
				&& $password == $password2){ 
				if( $mysql->change_password($member->hash($password), $user_login, $activation) 
					&& $member->change_password_confirmation_mail($user_login) ){
					$message = "Пароль успешно сменен.
								На ваш электронный адрес высланы новые регистрационные данные.";
				} else {
					$message = "Такого пользователя нет в базе данных";
				}
			
			} else {
				$message = "Поля паролей не соответствуют друг другу либо не заполнены";
			}	
		
		}
	
	} else {	
		$message = "Такого пользователя нет в базе данных";
	}
}
?>
	<div class="grid">
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Восстановление Пароля</h2>
							<h3 class="colortext">Напишите свой новый пароль</h3>
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
							<form action=""
								  method="post"	
								  id="newpassword-form">
								<p class="register-message"><?php echo $message; ?></p>
								<p>
									<label class="placeholder">
										<span>Новый Пароль</span>
										<input type="password" class="required" name="newpassword-pass" id="newpassword-pass"  maxlength="50"/>
									</label>
								</p>
								
								<p>
									<label class="placeholder">
										<span>Повторить Пароль</span>
										<input type="password" class="required" name="newpassword-pass2" id="newpassword-pass2"  maxlength="50"/>
									</label>
								</p>
								<input type="hidden" name="action" value="password" />
								<button type="submit" name="reactivate">Изменить пароль</button>
							</form>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>
	
	<script> 
	$(document).ready(function () {
		var newpassForm = new FormValidation('#newpassword-form');
		newpassForm.labelShowHide('#newpassword-form');
		$('#newpassword-form').submit(function () {
			return newpassForm.validate();
		});	
	});	
	</script>

<?php get_footer('help'); ?>



