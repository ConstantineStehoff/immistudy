<?php
/*
* Template Name: Register Page
*/
ob_start();
get_header();

?>

	<div class="grid">
		
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Регистрация</h2>
							<h3 class="colortext">Регистрация новых пользователей</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
			
		</div>
		
	</div>
	
	
	<div class="grid">
		
		<div class="unit blockGoldenWide">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
					<?php 
						
						require_once(IMMISTUDY_DIR . '/classes/Mysql.php');
						require_once(IMMISTUDY_DIR . '/classes/membership.php');
						require_once(IMMISTUDY_DIR . '/classes/formHandler.php');
						$mySql = new Mysql();
						$new_member = new Membership();
						$message = "";
						
						if( isset($_POST["action"]) && $_POST["action"] == "login" ){
							if( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) {
								$message = "Неверное число в капче";
							} else {
								//Getting the variables from the form
								$member_name = $_POST['register_name'];
								$member_lastname = $_POST['register_lastname'];
								$member_email = $_POST['register_email'];
								$member_password = $_POST['register_password'];
								$member_passowrd2 = $_POST['register_password2'];
								
								$isMember = $mySql->get_member_by_email($member_email);
								//if there is a member with the same email
								if(!empty($isMember)){ 
									
									//and active then show error message
									if ($mySql->verify_active($isMember)) {
										$message = "Пользователь с таким электронным адресом уже зарегистрирован";
									//and if not active then update the existing record
									} else { 
										
										if (isset($member_name, $member_email, $member_password) && $member_password === $member_passowrd2){
											$form_handler = new FormHandler();
											//instantiating the membership class
											$new_member = Membership::newRegistration(array(
												"name" => $form_handler->validString($member_name),
												"lastname" => $form_handler->validString($member_lastname),
												"email" => $form_handler->validEmail($member_email), 
												"password" => $new_member->hash($member_password),
												"joinDate" => date("Y-m-d"),
												"lastAccess" => date("Y-m-d")
											));
											
											$note_of_registration = "Новый пользователь заполнил форму регистрации. 
																	 Имя: " . $member_name . "
																	 Фамилия: " . $member_lastname . " 
																	 Электронный адрес:  " . $member_email . "
																	 Дата заполнения: " . date("Y-m-d");
											
											if($new_member->update_new_user()){//updation the user and sending the email
												if( $new_member->utility_email($note_of_registration, 
													"immistudy@mail.ru", "Новый пользователь заполнил форму регистрации") ){
													header("Location: " . SITE_URL . "/register_exec");	
												}
											} else {
												$message = "Извините мы не смогли отправить вам письмо с активацией так как этого электронного адреса не существует либо он заблокирован";
											}
										}
									}
								
								} else { //if there is no member with this email then add a new member
									if (isset($member_name, $member_email, $member_password) && $member_password === $member_passowrd2){
										$form_handler = new FormHandler();
										$new_member = Membership::newRegistration(array(
											"name" => $form_handler->validString($member_name),
											"lastname" => $form_handler->validString($member_lastname),
											"email" => $form_handler->validEmail($member_email), 
											"password" => $new_member->hash($member_password),
											"joinDate" => date("Y-m-d"),
											"lastAccess" => date("Y-m-d")
										));
										$note_of_registration = "Новый пользователь заполнил форму регистрации. 
																 Имя: " . $member_name . "
																 Фамилия: " . $member_lastname . " 
																 Электронный адрес:  " . $member_email . "
																 Дата заполнения: " . date("Y-m-d");
										
										if( $new_member->register_user() ){
											if( $new_member->utility_email($note_of_registration, 
												"immistudy@mail.ru", "Новый пользователь заполнил форму регистрации") ){
												header("Location: " . SITE_URL . "/register_exec");	
											}									
										} else {
											$message = "Извините мы не смогли отправить вам письмо с активацией так как этого электронного адреса не существует либо он заблокирован";
										}
									} 
								}	
							}
						}
						?>
						
						
						<form 
						action="<?php echo SITE_URL;?>/register"
						method="post"	
						id="register_form">
							
							<p>
								<label class="placeholder">
									<span>Имя</span>
									<input type="text" class="required" name="register_name" id="register_name" maxlength="50"/>
								</label>
							</p>
							
							<p>
								<label class="placeholder">
									<span>Фамилия</span>
									<input type="text" class="required" name="register_lastname" id="register_lastname" maxlength="50"/>
								</label>
							</p>
							
							<p>
								<label class="placeholder">
									<span>E-mail</span>
									<input type="text" class="required" name="register_email" id="register_email" maxlength="50"/>
								</label>
							</p>
						
							<p>
								<label class="placeholder">
									<span>Пароль</span>
									<input type="password" class="required" name="register_password" id="register_password" maxlength="50"/>
								</label>
							</p>
						
							<p>
								<label class="placeholder">
									<span>Повторите Пароль</span>
									<input type="password" class="required" name="register_password2" id="register_password2" maxlength="50"/>
								</label>
							</p>
							
							<input type="hidden" name="action" value="login" />
							<p class="register-message">Вставьте правильное число: <?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?></p>
							<p class="register-message"><?php echo $message; ?></p>
							<button>Зарегистрироваться</button>
						</form>	
					
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
			
		<div class="unit blockGoldenShort">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">	
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
			
		
	</div>
	
	


<script>
	
	$(document).ready(function () {
		var registerForm = new FormValidation('#register_form');
		registerForm.labelShowHide('#register_form');
		$('#register_form').submit(function () {
		   return registerForm.validateWithEmailAndPassword('#register_email', '#register_password', '#register_password2');
		});	
	});	
	
</script>

<script src="<?php bloginfo('template_url'); ?>/scripts/formValidation.js" type="text/javascript"></script>

<?php get_footer('help'); ?>
