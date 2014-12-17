<?php
/*
* Template Name: Contacts Page
*/
?>

<?php 

get_header(); ?>

	<div class="grid">
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div id="contacts-header" class="inner">
						<div class="hd">
							<h2>Где мы находимся?</h2>
							<h3 class="colortext">Мы живем в Хабаровске но работаем во всем мире</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>	
	</div>		
	
	<div class="grid">
		<div class="unit blockTwoThirds">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="bd">
							<div id="map" class="alignleft">
								<!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (начало) -->
								<div id="ymaps-map-id_134550975148785924026" style="width: 600px; height: 300px;"></div>
								<script>function fid_134550975148785924026(ymaps) {var map = new ymaps.Map("ymaps-map-id_134550975148785924026", {center: [135.05730999999994, 48.47266976940867], zoom: 16, type: "yandex#map"});map.controls.add("zoomControl").add("mapTools").add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));map.geoObjects.add(new ymaps.Placemark([135.05731, 48.471885], {balloonContent: "Иммиграция и обучение / Immistudy.ru<br/>680000 г. Хабаровск ул. Муравьева-Амурского,4 офис 206<br/>телефон офиса: 8 4212 31 24 57<br/>мобильный: 8 924 315 78 46 / 8 924 217 78 46<br/>электронный адрес: Immistudy@mail.ru"}, {preset: "twirl#blueDotIcon"}));};</script>
								<!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->
							</div>		
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
				
		<div class="unit blockOneThirds lastUnit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="bd">
							<h3><strong>Офис в Хабаровске:</strong></h3>
							<div id="address">
								<?php
								if ( function_exists( 'icit_spot' ) )
								    icit_spot( 'Address text' );
								?>
							</div>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>		
			
			
	<div class="grid">
		<div class="unit blockOneHalf">	
			<div id="phone" class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd center">
							<h2>Телефон</h2>
							<h3>Звоните Нам</h3>
							<!-- <p class="blockOneHalfPhone uppercase blue margin_top">Москва</p> <p class="blockOneHalfPhone yellow margin_top"><span class="contact-info-size">8 498 619 57 98</span></p>
							<p class="blockOneHalfPhone uppercase blue">Санкт-Петербург</p> <p class="blockOneHalfPhone yellow"><span class="contact-info-size">8 812 424 78 57</span></p> -->
							<p class="blockOneHalfPhone uppercase blue">Хабаровск</p> <div class="blockOneHalfPhone"><p class="yellow"><span class="contact-info-size">8 4212 31 24 57</span></p><p class="yellow"><span class="contact-info-size">8 924 31 57 846</span></p></div>
							<p class="blockOneHalfPhone uppercase blue">Сиэтл</p> <p class="blockOneHalfPhone yellow"><span class="contact-info-size">1 206 902 8034</span></p>
							
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>	
			
			
		<div class="unit blockOneHalf lastUnit">	
			<div id="email" class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd center">
							<h2>Электронная Почта</h2>
							<h3>Напишите нам письмо</h3>
							<p class="contact-info-size margin_top"><a href="mailto:immistudy@mail.ru" class="yellow">immistudy@mail.ru</a></p>
							<h2 class="margin_top">Другие Средства Связи</h2>
							<h3>Скайп</h3>
							<p class="contact-info-size margin_top yellow">immistudy</p>
							<!--<h3 class="margin_top">Звонок с сайта</h3>
							<p class="contact-info-size margin_top"><a href="http://zingaya.com/widget/66e58b85c420490e8d5e8ab29b1e05ab" onclick="window.open(this.href+'?referrer='+escape(window.location.href)+'', '_blank', 'width=236,height=220,resizable=no,toolbar=no,menubar=no,location=no,status=no'); return false" class="yellow">Звонок с сайта</a></p>-->
							
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>	
		
	
	<div class="grid">
		<div class="unit">
			<div id="contact-form" class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Прислать Сообщение</h2>
							<h3>Если есть вопрос напишите нам сообщение</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>	

	<div class="grid">
			
			<div id="message-form-fields" class="unit blockOneHalf">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<div class="bd">
							
							<?php 
							if( isset($_POST["action"]) && $_POST["action"] == "action" ){
								if( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) {
									$message = "Неверное число в капче";
								} else {
									require_once(IMMISTUDY_DIR . '/classes/formHandler.php');
									require_once(IMMISTUDY_DIR . '/classes/membership.php');
									$form_handler = new FormHandler();
									$name = $form_handler->validString($_POST['contact_name']);
									$email = $form_handler->validEmail($_POST['contact_email']);
									$note = $form_handler->validString($_POST['contact_note']);
									
									if( isset($name, $email, $note) && !empty($name) && !empty($email) && !empty($note) ){
										$mysql = New Mysql();
										$new_letter = New Membership();
										if($mysql->contact_form($name, $email, $note)){
											$letter = "Имя: ". $name . "   Электронный адрес: " . $email . "\r\n" . $note;
											if( $new_letter->utility_email($letter, "immistudy@mail.ru", "Вопрос от пользователя сайта immistudy.ru") ){
												$message = "Спасибо. Мы получили ваше сообщение.";
											}	
										
										}
									}	
								}
							}	
							?>	
							<form name="contact_form"
								  id="contact_form"
								  action="<?php echo SITE_URL; ?>/contacts"
								  method="post">
								
								<p>
									<label class="placeholder">
										<span>Сообщение</span>
										<textarea class="required" id="contact_note" name="contact_note" maxlength="2000" rows="6"></textarea>
									</label>
								</p>
								<p>
									<label class="placeholder">
										<span>Имя</span>
										<input type="text" class="required" name="contact_name" id="contact_name"  maxlength="50"/>
									</label>
								</p>
								<p>
									<label class="placeholder">
										<span>Адрес почты</span>
										<input type="text" class="required" name="contact_email" id="contact_email"  maxlength="50"/>
									</label>
								</p>
								<input type="hidden" name="action" value="action" />
								<p class="register-message">Вставьте правильное число: <?php if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?></p>
								<p class="register-message"><?php echo isset($message) ? $message : ""; ?></p>
								<button id="form_submit">Отправить</button>
							
							</form>	
						</div>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		
			<div id="message-form-text" class="unit blockOneHalf lastUnit">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<?php
							if ( function_exists( 'icit_spot' ) )
							    icit_spot( 'Contacts text' );
							?>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		
		</div>	
	
<script>
	//Instantiating the form validation class
	$(document).ready(function () {
		var contactForm = new FormValidation('#contact_form');
		contactForm.labelShowHide('#contact_form');
		$('#contact_form').submit(function () {
		    return contactForm.validateWithEmail('#contact_email');
		});	
	});	
</script>

<?php get_footer(); ?>