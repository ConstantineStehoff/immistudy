<?php
/**
 * Template Name: Cabinet Work Aplication
 */
ob_start();
require_once(IMMISTUDY_DIR . '/classes/membership.php');
$mysql = new Mysql();
$membership = new Membership();
$membership->sec_session_start();
$id = preg_replace( '/[^0-9]/', '', $membership->confirm_member() ); 
if ( empty($id) || !($mysql->check_member_id($id))){
	header("location:" . SITE_URL . "/login");
	exit();
} 
$user_data = $mysql->get_name_lastname_email_by_id($id);
get_header('cabinet');

//Form handling
require_once(IMMISTUDY_DIR . '/classes/application.php');
require_once(IMMISTUDY_DIR . '/classes/formHandler.php');

if( isset($_POST["action"]) && $_POST["action"] == "login" ){
	$form_handler = new FormHandler();
	//Get values
	$workApp_first_name = $_POST['workApp_name'];
	$workApp_last_name = $_POST['workApp_lastname'];
	$workApp_birthDate =  $_POST['workApp_dayOfBirth'] . "/" . $_POST['workApp_monthOfBirth'] . "/" . $_POST['workApp_yearOfBirth'];
	$workApp_email = $form_handler->validEmail($_POST['workApp_email']);
	
	if ( isset($workApp_first_name) && isset($workApp_last_name) && isset($workApp_email) ) {
		$new_application = Application::workForm(array(
			"id" => $id,
			"name" => $workApp_first_name,
			"lastname" => $workApp_last_name,
			"email" => $workApp_email,
			"gender" => isset($_POST['workApp_gender']) ? $_POST['workApp_gender'] : "",
			"birthDate" => $workApp_birthDate,
			"phone" => isset($_POST['workApp_phone']) ? $_POST['workApp_phone'] : "",
			"addPhone" => isset($_POST['workApp_phone2']) ? $_POST['workApp_phone2'] : "",
			"citizenship" => isset($_POST['workApp_citizenship']) ? $form_handler->validString($_POST['workApp_citizenship']) : "",
			"propiska" => isset($_POST['workApp_propiska']) ? $form_handler->validString($_POST['workApp_propiska']) : "",
			"EduLevel" => isset($_POST['workApp_EduLevel']) ? $_POST['workApp_EduLevel'] : "",
			"LangLevel" => isset($_POST['workApp_EngLevel']) ? $_POST['workApp_EngLevel'] : "", 
			"otherLang" => isset($_POST['workApp_otherLanguages']) ? $form_handler->validString($_POST['workApp_otherLanguages']) : "",
			"relativesAbroad" => isset($_POST['workApp_relatives']) ? $_POST['workApp_relatives'] : "",
			"relateiveAbroadExplain" => isset($_POST['workApp_relativesText']) ? 
				$form_handler->validString($_POST['workApp_relativesText']) : "",
			"healthIssues" => isset($_POST['workApp_health']) ? $_POST['workApp_health'] : "",
			"healthIssuesExplain" => isset($_POST['workApp_healthText']) ? 
				$form_handler->validString($_POST['workApp_healthText']) : "",
			"army" => isset($_POST['workApp_army']) ? $_POST['workApp_army'] : "",
			"armyOtvod" => isset($_POST['workApp_healthArmy']) ? $form_handler->validString($_POST['workApp_healthArmy']) : "",
			"police" => isset($_POST['workApp_police']) ? $_POST['workApp_police'] : "",
			"otherCountriesWork" => isset($_POST['workApp_workOther']) ? $_POST['workApp_workOther'] : "", 
			"visaDenial" => isset($_POST['workApp_visaDenial']) ? $_POST['workApp_visaDenial'] : "", 
			"visa" => isset($_POST['workApp_visa']) ? $_POST['workApp_visa'] : "", 
		));
		$application_id = $new_application->put_workData();
		
		if(isset($_POST['otherWork_country'])){
			$new_application->set_otherWork_workApp(array(
				"country" => $_POST['otherWork_country'],
				"type" => isset($_POST['otherWork_type']) ? $_POST['otherWork_type'] : "",
				"date" => isset($_POST['otherWork_date']) ? $_POST['otherWork_date'] : "",
				"application_id" => $application_id
			));
			$new_application->put_workApp_otherWork();
		}	
		if(isset($_POST['visaDenial_country'])){
			$new_application->set_visaDenial_workApp(array(
				"country" => $_POST['visaDenial_country'],
				"type" => isset($_POST['visaDenial_type']) ? $_POST['visaDenial_type'] : "",
				"date" => isset($_POST['visaDenial_date']) ? $_POST['visaDenial_date'] : "",
				"application_id" => $application_id
			));
			$new_application->put_workApp_visaDenial();
		}
		if(isset($_POST['visa_country'])){
			$new_application->set_visa_workApp(array(
				"country" => $_POST['visa_country'],
				"type" => isset($_POST['visa_type']) ? $_POST['visa_type'] : "",
				"date" => isset($_POST['visa_date']) ? $_POST['visa_date'] : "",
				"application_id" => $application_id
			));
			$new_application->put_workApp_visa();
		}
		
		if( $membership->utility_email($new_application->get_work_application(), "immistudy@mail.ru", "Новая анкета - Личный Кабинет - Работа") ){
			$membership->application_message($id, $workApp_email);
			$message = "Ваша анкета была успешно отправлена";
		}
	}
}
?>

<div class="grid">
		<div class="unit">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<div class="hd">
							<h2>Анкета для Работы</h2>
							<h3 class="colortext">Эта анкета для подачи на программы связанные с работой</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>

	<form 
	method="post"	
	action="<?php echo site_url();?>/cabinet/work_application/"
	id="workApp-form">
		<div class="grid">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<h3 class="uppercase">Контактная информация</h3>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
		
		<?php echo $message = isset($message) ? '<p class="register-message margin_left">' . $message . '</p>' : "";?>
	
		<div class="grid">
			<div class="unit blockOneHalf">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<p>
								<label for="workApp_name" class="placeholder">
									<span>Имя</span>
									<input type="text" class="required" name="workApp_name" id="workApp_name" maxlength="50" value="<?php echo $user_data[0][0]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="workApp_lastname" class="placeholder">
									<span>Фамилия</span>
									<input type="text" class="required" name="workApp_lastname" id="workApp_lastname" maxlength="50" value="<?php echo $user_data[0][1]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="workApp_gender" class="margin_right">Пол</label>
								<input type="radio" value="Мужской" name="workApp_gender">Мужской
								<input type="radio" value="Женский" name="workApp_gender">Женский
							</p>
							
							<p>
								<label for="workApp_yearOfBirth" class="margin_right">Год рождения</label>
								 
								 <select name="workApp_yearOfBirth" id="workApp_yearOfBirth">
								 	<?php
								 	for ($i = 1950; $i <= date("Y"); $i++){
								 	?><option>
								 		<?= $i; ?>
								 		</option>
								 	<?php } ?>	  
								 </select>
								 <select name="workApp_monthOfBirth" id="workApp_monthOfBirth">
								 	<?php $month = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');
								 	for ($i = 1; $i <= 12; $i++){
								 		?>
								 		<option>
								 		<?= $month[$i]; ?>			
								 		</option>
								 	<?php } ?>	  
								 </select> 
								 <select name="workApp_dayOfBirth" id="workApp_dayOfBirth">
								 	<?php
								 	for ($i = 1; $i <= 31; $i++){
								 	?><option>
								 		<?= $i; ?>
								 	  </option>
								 	<?php } ?>	  
								 </select>
							</p>
							
							<p>
								<label for="workApp_email" class="placeholder">
									<span>E-mail</span>
									<input type="text" class="required" name="workApp_email" id="workApp_email" maxlength="50" value="<?php echo $user_data[0][2]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="workApp_phone" class="placeholder">
									<span>Телефон</span>
									<input type="text" name="workApp_phone" id="workApp_phone" maxlength="50"/>
								</label>
							</p>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
			
			<div class="unit blockOneHalf">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">				
							<p>
								<label for="workApp_phone2" class="placeholder">
									<span>Дополнительный Телефон</span>
									<input type="text" name="workApp_phone2" id="workApp_phone2" maxlength="50"/>
								</label>
							</p>
							
							<p>
								<label for="workApp_citizenship" class="placeholder">
									<span>Гражданство</span>
									<input type="text" name="workApp_citizenship" id="workApp_citizenship" maxlength="50"/>
								</label>
							</p>
						
							<p>
								<label for="workApp_propiska" class="placeholder">
									<span>Место прописки</span>
									<textarea type="text" id="workApp_propiska" name="workApp_propiska" maxlength="2000" rows="6"></textarea>
								</label>
							</p>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>					
		
		<div class="grid">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<h3 class="uppercase">Другая информация</h3>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
		
		<div class="grid">
				<div class="unit blockOneHalf">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">				
								<p>
									<label for="workApp_EduLevel" class="unit margin_right">Уровень Образования</label>
									<select name="workApp_EduLevel">
										<option>Среднее</option>
										<option>Среднее специальное профессиональное</option>
										<option>Высшее профессиональное</option>
									</select>
								</p>
								
								<p>
									<label for="workApp_EngLevel" class="unit margin_right">Уровень знания английского языка</label>
									<select name="workApp_EngLevel">
										<option>Fluent</option>
										<option>Conversational</option>
										<option>Limited</option>
										<option>No</option>
									</select>
								</p>
								
								<p>
									<label for="workApp_otherLanguages" class="placeholder">
										<span>Знание других языков</span>
										<input type="text" name="workApp_otherLanguages" id="workApp_otherLanguages" maxlength="50"/>
									</label>
								</p>
								
								<p>
									<label for="workApp_relatives" class="margin_right">Есть ли у вас родственники за границей?</label>
									<input type="radio" value="Да" name="workApp_relatives">Да
									<input type="radio" value="Нет" name="workApp_relatives">Нет
								</p>
								
								<p>
									<label for="workApp_relativesText" class="placeholder">
										<span>Если "да" то поясните степень родства и основание для проживания</span>
										<textarea type="text" id="workApp_relativesText" name="workApp_relativesText" maxlength="2000" rows="6"></textarea>
									</label>
								</p>
							
								<p>
									<label for="workApp_health" class="margin_right">Есть ли у Вас какие-либо проблемы со здоровьем?</label>
									<input type="radio" value="Да" name="workApp_health">Да
									<input type="radio" value="Нет" name="workApp_health">Нет
								</p>
								
								<p>
									<label for="workApp_healthText" class="placeholder">
										<span>Если «да» то поясните</span>
										<textarea type="text" id="workApp_healthText" name="workApp_healthText" maxlength="2000" rows="6"></textarea>
									</label>
								</p>
								
								<p>
									<label for="workApp_army" class="margin_right">Служили ли Вы в Армии?</label>
									<input type="radio" value="Да" name="workApp_army">Да
									<input type="radio" value="Нет" name="workApp_army">Нет
								</p>
								
								<p>
									<label for="workApp_healthArmy" class="placeholder">
										<span>Если имели отвод от армии то укажите диагноз</span>
										<textarea type="text" id="workApp_healthArmy" name="workApp_healthArmy" maxlength="2000" rows="6"></textarea>
									</label>
								</p>
								
								<p>
									<label for="workApp_police" class="margin_right">Были ли у Вас приводы в милицию, были ли Вы когда-нибудь осуждены?</label>
									<input type="radio" value="Да" name="workApp_police">Да
									<input type="radio" value="Нет" name="workApp_police">Нет
								</p>
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
				<div class="unit blockOneHalf">
					<div class="mod"> 
						<b class="top"><b class="tl"></b><b class="tr"></b></b> 
							<div class="inner">				
								<p>
									<label for="workApp_workOther" class="margin_right">Работали ли Вы раньше в других странах?</label>
									<input type="radio" value="Да" name="workApp_workOther">Да
									<input type="radio" value="Нет" name="workApp_workOther">Нет
								</p>
							
								<p>Если "да" то укажите ниже</p>
								
								<!-- SheepIt form work other countries -->
								<div class="grid">
									<div id="otherWorkForm" class="margin_top">
										
										<div id="otherWorkForm_template">
											<label for="otherWorkForm_#index#_country" class="placeholder margin_left margin_bottom" style="width: 400px;">
												<input id="otherWorkForm_#index#_country" name="otherWork_country[#index#]" type="text" placeholder="Страна"/>
											</label>
											
											<label for="otherWorkForm_#index#_type" class="placeholder margin_left margin_bottom" style="width: 400px;">
												<input id="otherWorkForm_#index#_type" name="otherWork_type[#index#]" type="text" placeholder="Тип визы"/>
											</label>
											
											<label for="otherWorkForm_#index#_date" class="placeholder margin_left margin_bottom" style="width: 150px;">
												<input id="otherWorkForm_#index#_name" name="otherWork_date[#index#]" type="text" placeholder="Даты"/>
											</label>
											
										</div>
										
										<div id="otherWorkForm_noforms_template" class="center">Не работала/работал в других странах</div>
										
										<div id="otherWorkForm_controls" class="margin_left margin_bottom">
											<button id="otherWorkForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить работу</span></a></button>
											<button id="otherWorkForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
										</div>
									</div>
								</div>		
								<!-- End SheepIt form visa -->
								
								<p>
									<label for="workApp_visaDenial" class="margin_right">Были ли у Вас отказы в получении визы или аннулирование визы какой-либо страны?</label>
									<input type="radio" value="Да" name="workApp_visaDenial">Да
									<input type="radio" value="Нет" name="workApp_visaDenial">Нет
								</p>
								<p>Если "да" то укажите ниже</p>
								<!-- SheepIt form visa denial -->
								<div class="grid">
									<div id="visaDenialForm" class="margin_top">
										
										<div id="visaDenialForm_template">
											<label for="visaDenialForm_#index#_country" class="placeholder margin_left margin_bottom" style="width: 400px;">
												<input id="visaDenialForm_#index#_country" name="visaDenial_country[#index#]" type="text" placeholder="Страна"/>
											</label>
											
											<label for="visaDenialForm_#index#_type" class="placeholder margin_left margin_bottom" style="width: 400px;">
												<input id="visaDenialForm_#index#_type" name="visaDenial_type[#index#]" type="text" placeholder="Тип визы"/>
											</label>
											
											<label for="visaDenialForm_#index#_date" class="placeholder margin_left margin_bottom" style="width: 150px;">
												<input id="visaDenialForm_#index#_name" name="visaDenial_date[#index#]" type="text" placeholder="Дата" />
											</label>
											
										</div>
										
										<div id="visaDenialForm_noforms_template" class="center">Не было отказов в визах</div>
										
										<div id="visaDenialForm_controls" class="margin_left margin_bottom">
											<button id="visaDenialForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить отказ в визе</span></a></button>
											<button id="visaDenialForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
										</div>
									</div>
								</div>		
								<!-- End SheepIt form visa denial -->
								
								<p>
									<label for="workApp_visa" class="margin_right">Нарушения визового режима?</label>
									<input type="radio" value="Да" name="workApp_visa">Да
									<input type="radio" value="Нет" name="workApp_visa">Нет
								</p>
								
								<p>Если "да" то укажите ниже</p>
								
								<!-- SheepIt form visa -->
								<div class="grid">
									<div id="visaForm" class="margin_top">
										
										<div id="visaForm_template">
											<label for="visaForm_#index#_country" class="placeholder margin_left margin_bottom" style="width: 400px;">
												<input id="visaForm_#index#_country" name="visa_country[#index#]" type="text" placeholder="Страна"/>
											</label>
											
											<label for="visaForm_#index#_type" class="placeholder margin_left margin_bottom" style="width: 400px;">
												<input id="visaForm_#index#_type" name="visa_type[#index#]" type="text" placeholder="Тип визы"/>
											</label>
											
											<label for="visaForm_#index#_date" class="placeholder margin_left margin_bottom" style="width: 150px;">
												<input id="visaForm_#index#_name" name="visa_date[#index#]" type="text" placeholder="Дата"/>
											</label>
											
										</div>
										
										<div id="visaForm_noforms_template" class="center">Не было нарушений визового режима</div>
										
										<div id="visaForm_controls" class="margin_left margin_bottom">
											<button id="visaForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить нарушение</span></a></button>
											<button id="visaForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
										</div>
									</div>
								</div>		
								<!-- End SheepIt form visa -->
								
							</div>
						<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
					</div>
				</div>
		</div>
	
		<div class="grid">
			<div class="unit">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<input type="hidden" name="action" value="login" />
							<button>Отправить</button>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>
	
	</form>
	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/sheepItPlugin.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/formValidation.js"></script>
	
	<script type="text/javascript">
		var sheepItForm = $('#visaDenialForm').sheepIt({
		    separator: '',
		    allowRemoveLast: true,
		    allowRemoveCurrent: true,
		    allowRemoveAll: true,
		    allowAdd: true,
		    allowAddN: true,
		    maxFormsCount: 10,
		    minFormsCount: 0,
		    iniFormsCount: 0
		});
		
		var sheepItForm = $('#visaForm').sheepIt({
		    separator: '',
		    allowRemoveLast: true,
		    allowRemoveCurrent: true,
		    allowRemoveAll: true,
		    allowAdd: true,
		    allowAddN: true,
		    maxFormsCount: 10,
		    minFormsCount: 0,
		    iniFormsCount: 0
		});
		
		var sheepItForm = $('#otherWorkForm').sheepIt({
		    separator: '',
		    allowRemoveLast: true,
		    allowRemoveCurrent: true,
		    allowRemoveAll: true,
		    allowAdd: true,
		    allowAddN: true,
		    maxFormsCount: 10,
		    minFormsCount: 0,
		    iniFormsCount: 0
		});
	
		$(document).ready(function () {
			var workForm = new FormValidation('#workApp-form');
			workForm.labelShowHide('#workApp-form');
			$('#workApp-form').submit(function () {
			    return workForm.validate();
			});	
		});	
	</script>
<?php get_footer('help'); ?>