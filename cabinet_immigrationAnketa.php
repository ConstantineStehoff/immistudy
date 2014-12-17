<?php

/**
 * Template Name: Cabinet Immigration Application
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
	$immiApp_first_name = $form_handler->validString($_POST['immiApp_name']);
	$immiApp_last_name = $form_handler->validString($_POST['immiApp_lastname']);
	$immiApp_birthDate =  $_POST['immiApp_dayOfBirth'] . "/" . $_POST['immiApp_monthOfBirth'] . "/" . $_POST['immiApp_yearOfBirth'];
	$immiApp_email = $form_handler->validEmail($_POST['immiApp_email']);
	
	
	if ( isset($immiApp_first_name, $immiApp_last_name, $immiApp_email) ) {
		$new_application = Application::immigrationForm(array(
			"id" => $id,
			"name" => $immiApp_first_name,
			"lastname" => $immiApp_last_name,
			"email" => $immiApp_email,
			"gender" => isset($_POST['immiApp_gender']) ? $form_handler->validString($_POST['immiApp_gender']) : "",
			"birthDate" => $immiApp_birthDate,
			"phone" => isset($_POST['immiApp_phone']) ? $_POST['immiApp_phone'] : "",
			"address" => isset($_POST['immiApp_address']) ? $form_handler->validString($_POST['immiApp_address']) : "",
			"familyStatus" => isset($_POST['immiApp_familyStatus']) ? $_POST['immiApp_familyStatus'] : "",
			"citizenship" => isset($_POST['immiApp_citizenship']) ? $form_handler->validString($_POST['immiApp_citizenship']) : "",
			"nativeLang" => isset($_POST['immiApp_nativeLang']) ? $form_handler->validString($_POST['immiApp_nativeLang']) : "",
			"EduLevel" => $_POST['immiApp_EduLevel'],
			"speciality" => isset($_POST['immiApp_speciality']) ? $form_handler->validString($_POST['immiApp_speciality']) : "",
			"additional" => isset($_POST['immiApp_additional']) ? $form_handler->validString($_POST['immiApp_additional']) : "",
			"army" => isset($_POST['immiApp_army']) ? $_POST['immiApp_army'] : "",
			"armyOtvod" => isset($_POST['immiApp_healthArmy']) ? $form_handler->validString($_POST['immiApp_healthArmy']) : "",
			"armyZvanie" => isset($_POST['immiApp_army_zvanie']) ? $form_handler->validString($_POST['immiApp_army_zvanie']) : "",
			"armyYears" => isset($_POST['immiApp_army_years']) ? $_POST['immiApp_army_years'] : "",
			"police" => isset($_POST['immiApp_police']) ? $_POST['immiApp_police'] : "",
			"policeCause" => isset($_POST['immiApp_police_cause']) ? $form_handler->validString($_POST['immiApp_police_cause']) : "",
			"policeYears" => isset($_POST['immiApp_police_years']) ? $_POST['immiApp_police_years'] : ""
		));
		$application_id = $new_application->put_immigrationData();
		
		if(isset($_POST['children_name'])){
			$new_application->set_children(array(
				"name" => $_POST['children_name'], 
				"age" => isset($_POST['children_age']) ? $_POST['children_age'] : "",
				"gender" => isset($_POST['children_gender']) ? $_POST['children_gender'] : "",
				"application_id" => $application_id
			));
			$new_application->put_immigrationApp_children();
		}	
		if(isset($_POST['school_name'])){
			$new_application->set_schools(array(
				"name" => $_POST['school_name'],
				"place" => isset($_POST['school_place']) ? $form_handler->validString($_POST['school_place']) : "",
				"years" => isset($_POST['school_years']) ? $form_handler->validString($_POST['school_years']) : "",
				"document" => isset($_POST['school_document']) ? $form_handler->validString($_POST['school_document']) : "",
				"application_id" => $application_id
			));
			$new_application->put_immigrationApp_schools();
		}
		if(isset($_POST['work_name'])){
			$new_application->set_works(array(
				"name" => $form_handler->validString($_POST['work_name']),
				"status" => isset($_POST['work_status']) ? $form_handler->validString($_POST['work_status']) : "",
				"years" => isset($_POST['work_years']) ? $form_handler->validString($_POST['work_years']) : "",
				"responsibilities" => isset($_POST['work_responsibilities']) ? $form_handler->validString($_POST['work_responsibilities']) : "",
				"application_id" => $application_id
			));
			$new_application->put_immigrationApp_works();
		}
	
		if( $membership->utility_email($new_application->get_immigration_application(), "immistudy@mail.ru", "Новая анкета - Личный Кабинет - Иммиграция") ){
			$membership->application_message($id, $immiApp_email);
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
							<h2>Анкета для Иммиграции</h2>
							<h3 class="colortext">Эта анкета для подачи на иммиграционные программы</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>
	
	<?php echo $message = isset($message) ? '<p class="register-message margin_left">' . $message . '</p>' : "";?>
	
	<form 
	method="post"	
	action="<?php echo site_url();?>/cabinet/immigration_application/"
	id="immiApp-form">
		<div class="grid">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<h3 class="uppercase">Контактная информация</h3>
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
								<label for="immiApp_name" class="placeholder">
									<span>Имя</span>
									<input type="text" class="required" name="immiApp_name" id="immiApp_name" maxlength="50" value="<?php echo $user_data[0][0]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="immiApp_lastname" class="placeholder">
									<span>Фамилия</span>
									<input type="text" class="required" name="immiApp_lastname" id="immiApp_lastname" maxlength="50" value="<?php echo $user_data[0][1]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="immiApp_gender" class="margin_right">Пол</label>
								<input type="radio" value="Мужской" name="immiApp_gender">Мужской
								<input type="radio" value="Женский" name="immiApp_gender">Женский
							</p>
							
							<p>
								<label for="immiApp_yearOfBirth" class="margin_right">Год рождения</label>
								 
								 <select name="immiApp_yearOfBirth">
								 	<?php
								 	for ($i = 1950; $i <= date("Y"); $i++){
								 	?><option>
								 		<?= $i; ?>
								 		</option>
								 	<?php } ?>	  
								 </select>
								 <select name="immiApp_monthOfBirth">
								 	<?php $month = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');
								 	for ($i = 1; $i <= 12; $i++){
								 		?>
								 		<option>
								 		<?= $month[$i]; ?>			
								 		</option>
								 	<?php } ?>	  
								 </select> 
								 <select name="immiApp_dayOfBirth">
								 	<?php
								 	for ($i = 1; $i <= 31; $i++){
								 	?><option>
								 		<?= $i; ?>
								 	  </option>
								 	<?php } ?>	  
								 </select>
							</p>
							
							<p>
								<label for="immiApp_email" class="placeholder">
									<span>E-mail</span>
									<input type="text" class="required" name="immiApp_email" id="immiApp_email" maxlength="50" value="<?php echo $user_data[0][2]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="immiApp_phone" class="placeholder">
									<span>Телефон</span>
									<input type="text" name="immiApp_phone" id="immiApp_phone" maxlength="50"/>
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
								<label for="immiApp_address" class="placeholder">
									<span>Адрес</span>
									<textarea type="text" id="immiApp_address" name="immiApp_address" maxlength="2000" rows="6"></textarea>
								</label>
							</p>
							
							<p>
								<label for="immiApp_familyStatus">Семейное положение</label>
								 <select name="immiApp_familyStatus" class="margin_left" style="border: 0;">
								 	<option>не замужем/не женат</option>
								 	<option>разведена/разведен</option>
								 	<option>вдова/вдовец</option>
								 	<option>замужем/женат</option>
								 	<option>гражданский брак</option>
								 </select>
							</p>
							
							<p>
								<label for="immiApp_citizenship" class="placeholder">
									<span>Гражданство</span>
									<input type="text" name="immiApp_citizenship" id="immiApp_citizenship" maxlength="50"/>
								</label>
							</p>
							
							<p>
								<label for="immiApp_nativeLang" class="placeholder">
									<span>Родной язык</span>
									<input type="text" name="immiApp_nativeLang" id="immiApp_nativeLang" maxlength="50"/>
								</label>
							</p>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>					
		
		<div class="grid">
			<label class="margin_left margin_right">Дети</label>
				<!-- sheepIt Form -->
				<div id="immiChildrenForm" class="margin_top">
				<!-- Form template-->
				<div id="immiChildrenForm_template">
					<label for="immiChildrenForm_#index#_name" class="placeholder margin_left margin_bottom" style="width: 400px;">
						<input id="immiChildrenForm_#index#_name" name="children_name[#index#]" type="text" placeholder="Имя" />
					</label>
					<label for="immiChildrenForm_#index#_age" class="placeholder margin_left margin_bottom"  style="width: 400px;">
						<input id="immiChildrenForm_#index#_age" name="children_age[#index#]" type="text" placeholder="Возраст"/>
					</label>	
					<p>
						<label for="immiChildrenForm_#index#_gender" class="margin_left margin_right">Пол<span id="sheepItForm_label"></span></label>
						<input type="radio" id="immiChildrenForm_#index#_male" name="children_gender[#index#]" type="text" value="Мужской"/>Мужской
						<input type="radio" id="immiChildrenForm_#index#_female" name="children_gender[#index#]" type="text" value="Женский"/>Женский
					</p>
					
				</div>
				<!-- /Form template-->
							   
				<!-- No forms template -->
				<div id="immiChildrenForm_noforms_template" class="center">Детей нет</div>
				<!-- /No forms template-->
							   
				<!-- Controls -->
				<div id="immiChildrenForm_controls" class="margin_left margin_bottom">
					<button id="immiChildrenForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить ребенка</span></a></button>
					<button id="immiChildrenForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
				</div>
			    <!-- /Controls -->
							   
				</div>
				<!-- /sheepIt Form -->
		</div>
		
		<div class="grid">
			<div class="mod"> 
				<b class="top"><b class="tl"></b><b class="tr"></b></b> 
					<div class="inner">
						<h3 class="uppercase">Образование</h3>
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
								<label for="immiApp_EduLevel" class="unit margin_right">Уровень Образования</label>
								<select name="immiApp_EduLevel">
									<option>Среднее</option>
									<option>Среднее специальное профессиональное</option>
									<option>Высшее профессиональное</option>
								</select>
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
								<label for="immiApp_speciality" class="placeholder">
									<span>Специальность</span>
									<input type="text" name="immiApp_speciality" id="immiApp_speciality" maxlength="50"/>
								</label>
							</p>
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
							<p>В хронологическом порядке указать историю образования (учебные заведения в которых вы учились. Школа, Профтехучилище или специальные курсы, Среднее специальное профессиональное учебное заведение, Высшее профессиональное учебное заведение)</p>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>
		
		<!-- sheepIt Form -->	
		<div class="grid">
			<div id="immiEduForm" class="margin_top">
			
			<div id="immiEduForm_template">
				<label for="immiEduForm_#index#_name" class="placeholder margin_left margin_bottom" style="width: 400px;">
					<input id="immiEduForm_#index#_name" name="school_name[#index#]" type="text" placeholder="Название"/>
				</label>
				
					<div class="grid">
						<div class="unit blockGoldenWide">
							<div class="mod" style="margin-top: 0;"> 
								<b class="top"><b class="tl"></b><b class="tr"></b></b> 
									<div class="inner">
										<p>
											<label class="placeholder" for="immiEduForm_#index#_place">
												<textarea type="text" id="immiEduForm_#index#_place" name="school_place[#index#]" maxlength="2000" rows="6" placeholder="Место"></textarea>
											</label>
										</p>
									</div>
								<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
							</div>
						</div>	
					</div>			
				
					
				<label for="immiEduForm_#index#_years" class="placeholder margin_left margin_bottom" style="width: 150px;">
					<input id="immiEduForm_#index#_name" name="school_years[#index#]" type="text" placeholder="Годы"/>
				</label>	
				<label for="immiEduForm_#index#_document" class="placeholder margin_left margin_bottom" style="width: 400px;">
					<input id="immiEduForm_#index#_document" name="school_document[#index#]" type="text" placeholder="Полученный документ"/>
				</label>	
			</div>
			
						   
			
			<div id="immiEduForm_noforms_template" class="center">Образования нет</div>
			
						   
			
			<div id="immiEduForm_controls" class="margin_left margin_bottom">
				<button id="immiEduForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить учебное заведение</span></a></button>
				<button id="immiEduForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
			</div>
			
			</div>
			
		</div>
		<!-- /sheepIt Form -->	
		
		<div class="grid">
			<div class="unit">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<h3 class="uppercase">Работа</h3>
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
							<p>В хронологическом порядке указать название всех предприятий, где вы когда-либо работали</p>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>
		
		
		<!-- sheepIt Form -->	
		<div class="grid">
			<div id="immiWorkForm" class="margin_top">
			
			<div id="immiWorkForm_template">
				
				<label for="immiWorkForm_#index#_name" class="placeholder margin_left margin_bottom" style="width: 400px;">
					<input id="immiWorkForm_#index#_name" name="work_name[#index#]" type="text" placeholder="Название предприятия" />
				</label>
				
				<label for="immiWorkForm_#index#_status" class="placeholder margin_left margin_bottom" style="width: 400px;">
					<input id="immiWorkForm_#index#_status" name="work_status[#index#]" type="text" placeholder="Должность" />
				</label>
				
				<label for="immiWorkForm_#index#_years" class="placeholder margin_left margin_bottom" style="width: 150px;">
					<input id="immiWorkForm_#index#_years" name="work_years[#index#]" type="text" placeholder="Годы"/>
				</label>
				
				<div class="grid">
					<div class="unit blockGoldenWide">
						<div class="mod" style="margin-top: 0;"> 
							<b class="top"><b class="tl"></b><b class="tr"></b></b> 
								<div class="inner">
									<p>
										<label class="placeholder" for="immiWorkForm_#index#_responsibilities">
											<textarea type="text" id="immiWorkForm_#index#_responsibilities" name="work_responsibilities[#index#]" maxlength="2000" rows="6" placeholder="Должностные обязанности"></textarea>
										</label>
									</p>
								</div>
							<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
						</div>
					</div>	
				</div>			
			</div>
			
			<div id="immiWorkForm_noforms_template" class="center">Не работала/Не работал</div>
			
			<div id="immiWorkForm_controls" class="margin_left margin_bottom">
				<button id="immiWorkForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить место работы</span></a></button>
				<button id="immiWorkForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
			</div>
			
			</div>
			
		</div>
		<!-- /sheepIt Form -->
		
		
		<div class="grid">
			<div class="unit">
				<div class="mod"> 
					<b class="top"><b class="tl"></b><b class="tr"></b></b> 
						<div class="inner">
							<h3 class="uppercase">Дополнительные навыки</h3>
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
							<p>
								<label for="immiApp_additional" class="placeholder">
									<span>Ваши дополнительные навыки</span>
									<textarea type="text" id="immiApp_additional" name="immiApp_additional" maxlength="2000" rows="6"></textarea>
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
							<p>Занятия спортом и музыкой, компьютерные навыки и знание компьютерных программ,
							знание иностранных языков (результаты тестов IELTS, TOEFL, DELF, наличие
							сертификатов об окончании курсов или языковых школ), наличие водительского
							удостоверения категории «В» и если есть, то указать другие категории водительских
							удостоверений.</p>
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
							<p>
								<label for="immiApp_army" class="margin_right">Служили ли Вы в Армии?</label>
								<input type="radio" value="Да" name="immiApp_army">Да
								<input type="radio" value="Нет" name="immiApp_army">Нет
							</p>
						
							<p>
								<label for="workApp_healthArmy" class="placeholder">
									<span>Если имели отвод от армии то укажите диагноз</span>
									<textarea type="text" id="immiApp_healthArmy" name="immiApp_healthArmy" maxlength="2000" rows="6"></textarea>
								</label>
							</p>
							
							<p>Если "да" то укажите ниже</p>
							
							<p>
								<label for="immiApp_army_zvanie" class="placeholder">
									<span>Звание</span>
									<input type="text" name="immiApp_army_zvanie" id="immiApp_army_zvanie" maxlength="50"/>
								</label>
							</p>
							
							<p class="unit blockGoldenWide">
								<label for="immiApp_army_years" class="placeholder">
									<span>Годы службы</span>
									<input type="text" name="immiApp_army_years" id="immiApp_army_years" maxlength="50"/>
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
								<label for="immiApp_police" class="margin_right">Имели ли вы судимость?</label>
								<input type="radio" value="Да" name="immiApp_police">Да
								<input type="radio" value="Нет" name="immiApp_police">Нет
							</p>
						
							<p>Если "да" то укажите ниже</p>
						
							<p>
								<label for="immiApp_police_cause" class="placeholder">
									<span>Причина</span>
									<input type="text" name="immiApp_police_cause" id="immiApp_police_cause" maxlength="50"/>
								</label>
							</p>
							
							<p class="unit blockGoldenWide">
								<label for="immiApp_police_years" class="placeholder">
									<span>Сроки отбывания</span>
									<input type="text" name="immiApp_police_years" id="immiApp_police_years" maxlength="50"/>
								</label>
							</p>
							
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
		
<script type="text/javascript">
	$(document).ready(function() {
	      var sheepItForm = $('#immiChildrenForm').sheepIt({
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
	 
	 	var sheepItForm = $('#immiEduForm').sheepIt({
	 	    separator: '',
	 	    allowRemoveLast: true,
	 	    allowRemoveCurrent: true,
	 	    allowRemoveAll: true,
	 	    allowAdd: true,
	 	    allowAddN: true,
	 	   	minFormsCount: 0,
	 	    iniFormsCount: 1
	 	});
	 
	 	var sheepItForm = $('#immiWorkForm').sheepIt({
	 	    separator: '',
	 	    allowRemoveLast: true,
	 	    allowRemoveCurrent: true,
	 	    allowRemoveAll: true,
	 	    allowAdd: true,
	 	    allowAddN: true,
	 	   	minFormsCount: 0,
	 	    iniFormsCount: 1
	 	});
		
		var immiForm = new FormValidation('#immiApp-form');
		immiForm.labelShowHide('#immiApp-form');
		$('#immiApp-form').submit(function () {
		    return immiForm.validate();
		});	
	});
</script>	

<?php get_footer('help'); ?>