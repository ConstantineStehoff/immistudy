<?php
/*
* Template Name: Questions and Answers Page
*/
?>

<?php 
ob_start();
get_header(); ?>
	
	<div class="grid">
		<div class="unit">
			<div id="contact-form" class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Часто Задаваемые Вопросы</h2>
							<h3>Ответы на самые популярные вопросы</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>	
	
	<p class="margin_left margin_right"><a class="blue" href="<?php echo SITE_URL;?>/info/">Вернуться В Раздел Информация</a></p>
	
	<section>	
		<div class="grid">
			<?php $args = array('post_type' => 'questions');
			$loop = new WP_Query($args);
			while($loop->have_posts()) : $loop->the_post();?>
			
				<?php show_question_post(); ?>
			
			<?php endwhile;	
			wp_reset_query(); ?>
		</div>
	</section>
	
	<p class="margin_left margin_right"><a class="blue" href="<?php echo SITE_URL;?>/info/">Вернуться В Раздел Информация</a></p>
	
	<section>
		<div class="grid">
			<div class="unit">
				<div id="contact-form" class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<div><?php if($error) {echo($error);} ?></div>
							<div class="hd">
								<h2>Задать Вопрос</h2>
								<h3>Если есть вопрос напишите нам сообщение</h3>
							</div>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>	
		
		<div class="grid">
			<div id="question-form-fields" class="unit blockOneHalf">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							
							<?php 
							if( isset($_POST["action"]) && $_POST["action"] == "action" ){
								if( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) {
									$message = "Неверное число в капче";
								} else {
									require_once(IMMISTUDY_DIR . '/classes/formHandler.php');
									require_once(IMMISTUDY_DIR . '/classes/membership.php');
									$form_handler = new FormHandler();
									$name = $form_handler->validString($_POST['question_name']);
									$email = $form_handler->validEmail($_POST['question_email']);
									$note = $form_handler->validString($_POST['question_note']);
									if( isset($name, $email, $note) && !empty($name) && !empty($email) && !empty($note) ){
										$mysql = New Mysql();
										if($mysql->contact_form($name, $email, $note)){
											$new_letter = New Membership();
											$letter = "Имя: ". $name . "   Электронный адрес: " . $email . "\r\n" . $note;
											if( $new_letter->utility_email($letter, "immistudy@mail.ru", "Вопрос от пользователя сайта immistudy.ru") ){
												$message = "Спасибо. Мы получили ваше сообщение.";
											}	
										
										}
									}	
								}
							}
							?>	
							
							<form action="<?php echo SITE_URL; ?>/info/questions"
								  method="post"	
								  id="question_form">
								
								<p>
									<label class="placeholder">
										<span>Сообщение</span>
										<textarea id="question_note" class="required" name="question_note" maxlength="2000" rows="6"></textarea>
									</label>
								</p>
								<p>
									<label class="placeholder">
										<span>Имя</span>
										<input type="text" class="required" name="question_name" id="question_name" maxlength="50"/>
									</label>
								</p>
								<p>
									<label class="placeholder">
										<span>Адрес почты</span>
										<input type="text" class="required" name="question_email" id="question_email" maxlength="50"/>
									</label>
								</p>
								
								<input type="hidden" name="action" value="action" />
								<p class="register-message">Вставьте правильное число: <?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?></p>
								<p class="register-message"><?php echo isset($message) ? $message : ""; ?></p>
								<button>Отправить</button>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
			
				<div id="question-form-text" class="unit blockOneHalf lastUnit">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">
								<?php if ( function_exists( 'icit_spot' ) )
								    icit_spot( 'Contacts text' );
								?>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
			
			</div>	
		</form>	
	</section>



<script>
	//Instantiating the Form validation class
	$(document).ready(function () {
		var questionForm = new FormValidation('#question_form');
		questionForm.labelShowHide('#question_form');
		$('#question_form').submit(function () {
		  return questionForm.validateWithEmail('#question_email');
		});	
	});	
</script>

<?php get_footer(); ?>