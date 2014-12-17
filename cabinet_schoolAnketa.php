<?php
/**
 * Template Name: Cabinet School Application
 */
ob_start();
require_once(IMMISTUDY_DIR . '/classes/membership.php');
$mysql = new Mysql();
$membership = new Membership();
$membership->sec_session_start();
$id = preg_replace( '/[^0-9]/', '', $membership->confirm_member() ); 
if (empty($id) || !($mysql->check_member_id($id))){
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
	$schoolApp_first_name = $form_handler->validString($_POST['schoolApp_name']);
	$schoolApp_last_name = $form_handler->validString($_POST['schoolApp_lastname']);
	$schoolApp_birthDate =  $_POST['schoolApp_dayOfBirth'] . "/" . $_POST['schoolApp_monthOfBirth'] . "/" . $_POST['schoolApp_yearOfBirth'];
	$schoolApp_email = $form_handler->validEmail($_POST['schoolApp_email']);
	
	//form key validation and form processing
	if ( isset($schoolApp_first_name) && isset($schoolApp_last_name) && isset($schoolApp_email) ) {
		$new_application = Application::schoolForm(array(
			"id" => $id,
			"name" => $schoolApp_first_name,
			"lastname" => $schoolApp_last_name,
			"email" => $schoolApp_email,
			"gender" => isset($_POST['schoolApp_gender']) ? $_POST['schoolApp_gender'] : "",
			"birthDate" => $schoolApp_birthDate,
			"phone" => isset($_POST['schoolApp_phone']) ? $_POST['schoolApp_phone'] : "",
			"address" => isset($_POST['schoolApp_address']) ? $form_handler->validString($_POST['schoolApp_address']) : "",
			"familyStatus" => $_POST['schoolApp_familyStatus'],
			"citizenship" => isset($_POST['schoolApp_citizenship']) ? $form_handler->validString($_POST['schoolApp_citizenship']) : "",
			"nativeLang" => isset($_POST['schoolApp_nativeLang']) ? $form_handler->validString($_POST['schoolApp_nativeLang']) : "",
			"EduLevel" => $_POST['schoolApp_EduLevel'],
			"speciality" => isset($_POST['schoolApp_speciality']) ? $form_handler->validString($_POST['schoolApp_speciality']) : "",
			"additional" => isset($_POST['schoolApp_additional']) ? $form_handler->validString($_POST['schoolApp_additional']) : ""
		));
		$application_id = $new_application->put_schoolData();
		if(isset($_POST['children_name'])){
			$new_application->set_children(array(
				"name" => $_POST['children_name'],
				"age" => isset($_POST['children_age']) ? $_POST['children_age'] : "",
				"gender" => isset($_POST['children_gender']) ? $_POST['children_gender'] : "",
				"application_id" => $application_id
			));
			$new_application->put_schoolApp_children();
		}	
		if(isset($_POST['school_name'])){
			$new_application->set_schools(array(
				"name" => $_POST['school_name'],
				"place" => isset($_POST['school_place']) ? $_POST['school_place'] : "",
				"years" => isset($_POST['school_years']) ? $_POST['school_years'] : "",
				"document" => isset($_POST['school_document']) ? $_POST['school_document'] : "",
				"application_id" => $application_id
			));
			$new_application->put_schoolApp_schools();
		}
		
		if(isset($_POST['work_name'])){
			$new_application->set_works(array(
				"name" => $_POST['work_name'],
				"status" => isset($_POST['work_status']) ? $_POST['work_status'] : "",
				"years" => isset($_POST['work_years']) ? $_POST['work_years'] : "",
				"responsibilities" => isset($_POST['work_resposibilities']) ? $_POST['work_resposibilities'] : "",
				"application_id" => $application_id
			));
			$new_application->put_schoolApp_works();
		}
		if( $membership->utility_email($new_application->get_school_application(), "immistudy@mail.ru", "Новая анкета - Личный Кабинет - Обучение") ){
			$membership->application_message($id, $schoolApp_email);
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
							<h2>Анкета для Обучения</h2>
							<h3 class="colortext">Эта анкета для подачи на образовательные программы</h3>
						</div>
					</div>
				<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
			</div>
		</div>
	</div>
	
	<?php echo $message = isset($message) ? '<p class="register-message margin_left">' . $message . '</p>' : "";?>

	<form 
	method="post"	
	action="<?php echo site_url();?>/cabinet/school_application/"
	id="schoolApp-form">
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
								<label for="schoolApp_name" class="placeholder">
									<span>Имя</span>
									<input type="text" class="required" name="schoolApp_name" id="schoolApp_name" maxlength="50" value="<?php echo $user_data[0][0]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="schoolApp_lastname" class="placeholder">
									<span>Фамилия</span>
									<input type="text" class="required" name="schoolApp_lastname" id="schoolApp_lastname" maxlength="50" value="<?php echo $user_data[0][1]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="schoolApp_gender" class="margin_right">Пол</label>
								<input type="radio" value="Мужской" name="schoolApp_gender">Мужской
								<input type="radio" value="Женский" name="schoolApp_gender">Женский
							</p>
							
							<p>
								<label for="schoolApp_yearOfBirth" class="margin_right">Год рождения</label>
								 
								 <select name="schoolApp_yearOfBirth">
								 	<?php
								 	for ($i = 1950; $i <= date("Y"); $i++){
								 	?><option>
								 		<?= $i; ?>
								 		</option>
								 	<?php } ?>	  
								 </select>
								 <select name="schoolApp_monthOfBirth">
								 	<?php $month = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');
								 	for ($i = 1; $i <= 12; $i++){
								 		?>
								 		<option>
								 		<?= $month[$i]; ?>			
								 		</option>
								 	<?php } ?>	  
								 </select> 
								 <select name="schoolApp_dayOfBirth">
								 	<?php
								 	for ($i = 1; $i <= 31; $i++){
								 	?><option>
								 		<?= $i; ?>
								 	  </option>
								 	<?php } ?>	  
								 </select>
							</p>
							
							<p>
								<label for="schoolApp_email" class="placeholder">
									<span>E-mail</span>
									<input type="text" class="required" name="schoolApp_email" id="schoolApp_email" maxlength="50" value="<?php echo $user_data[0][2]; ?>"/>
								</label>
							</p>
							
							<p>
								<label for="schoolApp_phone" class="placeholder">
									<span>Телефон</span>
									<input type="text" name="schoolApp_phone" id="schoolApp_phone" maxlength="50"/>
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
								<label for="schoolApp_address" class="placeholder">
									<span>Адрес</span>
									<textarea type="text" id="schoolApp_address" name="schoolApp_address" maxlength="2000" rows="6"></textarea>
								</label>
							</p>
							
							<p>
								<label for="schoolApp_familyStatus" class="margin_right">Семейное положение</label>
								 <select name="schoolApp_familyStatus">
								 	<option>не замужем/не женат</option>
								 	<option>разведена/разведен</option>
								 	<option>вдова/вдовец</option>
								 	<option>замужем/женат</option>
								 	<option>гражданский брак</option>
								 </select>
							</p>
							
							<p>
								<label for="schoolApp_citizenship" class="placeholder">
									<span>Гражданство</span>
									<input type="text" name="schoolApp_citizenship" id="schoolApp_citizenship" maxlength="50"/>
								</label>
							</p>
							
							<p>
								<label for="schoolApp_nativeLang" class="placeholder">
									<span>Родной язык</span>
									<input type="text" name="schoolApp_nativeLang" id="schoolApp_nativeLang" maxlength="50"/>
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
				<div id="childrenForm" class="margin_top">
				<!-- Form template-->
				<div id="childrenForm_template">
					<label for="childrenForm_#index#_name" class="placeholder margin_left margin_bottom" style="width: 400px;">
						<input type="text" id="childrenForm_#index#_name" name="children_name[#index#]" placeholder="Имя"/>
					</label>
					
					<label for="childrenForm_#index#_age" class="placeholder margin_left margin_bottom"  style="width: 400px;">
						<input type="text" id="childrenForm_#index#_age"  name="children_age[#index#]" placeholder="Возраст"/>
					</label>	
					<p>
						<label for="childrenForm_#index#_gender" class="margin_left margin_right">Пол<span id="sheepItForm_label"></span></label>
						<input type="radio" id="childrenForm_#index#_male" name="children_gender[#index#]" type="text" value="Мужской"/>Мужской
						<input type="radio" id="childrenForm_#index#_female" name="children_gender[#index#]" type="text" value="Женский"/>Женский
					</p>
					
				</div>
				<!-- /Form template-->
						   
				<!-- No forms template -->
				<div id="childrenForm_noforms_template" class="center">Детей нет</div>
				<!-- /No forms template-->
							   
				<!-- Controls -->
				<div id="childrenForm_controls" class="margin_left margin_bottom">
					<button id="childrenForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить ребенка</span></a></button>
					<button id="childrenForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
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
								<label for="schoolApp_EduLevel" class="unit margin_right">Уровень Образования</label>
								<select name="schoolApp_EduLevel">
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
								<label for="schoolApp_speciality" class="placeholder">
									<span>Специальность</span>
									<input type="text" name="schoolApp_speciality" id="schoolApp_speciality" maxlength="50"/>
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
			<div id="educationForm" class="margin_top">
			
			<div id="educationForm_template">
				<label for="educationForm_#index#_name" class="placeholder margin_left margin_bottom" style="width: 400px;">
					<input type="text" id="educationForm_#index#_name" name="school_name[#index#]" placeholder="Название"/>
				</label>
				
					<div class="grid">
						<div class="unit blockGoldenWide">
							<div class="mod" style="margin-top: 0;"> 
								<b class="top"><b class="tl"></b><b class="tr"></b></b> 
									<div class="inner">
										<p>
											<label class="placeholder" for="educationForm_#index#_place">
												<textarea type="text" id="educationForm_#index#_place" name="school_place[#index#]" maxlength="2000" placeholder="Место" rows="6"></textarea>
											</label>
										</p>
									</div>
								<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
							</div>
						</div>	
					</div>			
				
					
				<label for="educationForm_#index#_years" class="placeholder margin_left margin_bottom" style="width: 150px;">
					<input id="educationForm_#index#_name" name="school_years[#index#]" type="text" placeholder="Годы"/>
				</label>	
				<label for="educationForm_#index#_document" class="placeholder margin_left margin_bottom" style="width: 400px;">
					<input id="educationForm_#index#_document" name="school_document[#index#]" type="text" placeholder="Полученный документ"/>
				</label>	
				
			</div>
			
			<!-- /Form template -->
			<div id="educationForm_noforms_template" class="center">Образования нет</div>
			
			<div id="educationForm_controls" class="margin_left margin_bottom">
				<button id="educationForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить учебное заведение</span></a></button>
				<button id="educationForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
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
							<p>В хронологическом порядке указать название всех предприятий, где вы когда-либо
							работали</p>
						</div>
					<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
				</div>
			</div>
		</div>
		
		
		<!-- sheepIt Form -->	
		<div class="grid">
			<div id="workForm" class="margin_top">
			
			<div id="workForm_template">
				
				<label for="workForm_#index#_name" class="placeholder margin_left margin_bottom" style="width: 400px;">
					<input id="workForm_#index#_name" name="work_name[#index#]" type="text" placeholder="Название предприятия"/>
				</label>
				
				<label for="workForm_#index#_status" class="placeholder margin_left margin_bottom" style="width: 400px;">
					<input id="workForm_#index#_status" name="work_status[#index#]" type="text" placeholder="Должность"/>
				</label>
				
				<label for="workForm_#index#_years" class="placeholder margin_left margin_bottom" style="width: 150px;">
					<input id="workForm_#index#_name" name="work_years[#index#]" type="text" placeholder="Годы">
				</label>
				
				<div class="grid">
					<div class="unit blockGoldenWide">
						<div class="mod" style="margin-top: 0;"> 
							<b class="top"><b class="tl"></b><b class="tr"></b></b> 
								<div class="inner">
									<p>
										<label class="placeholder" for="workForm_#index#_resposibilities">
											<textarea type="text" id="workForm_#index#_resposibilities" name="work_resposibilities[#index#]" maxlength="2000" rows="6" placeholder="Должностные обязанности"></textarea>
										</label>
									</p>
								</div>
							<b class="bottom"><b class="bl"></b><b class="br"></b></b> 
						</div>
					</div>	
				</div>			
			</div>
			<!-- /Form template -->
			<div id="workForm_noforms_template" class="center">Не работала/Не работал</div>
			
			<div id="workForm_controls" class="margin_left margin_bottom">
				<button id="workForm_add"  class="margin_top" style="background-color: #235FA8;"><a><span>Добавить место работы</span></a></button>
				<button id="workForm_remove_last" class="margin_top" style="background-color: #A40000;"><a><span>Убрать</span></a></button>
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
								<label for="schoolApp_additional" class="placeholder">
									<span>Ваши дополнительные навыки</span>
									<textarea type="text" id="schoolApp_additional" name="schoolApp_additional" maxlength="2000" rows="6"></textarea>
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
	
	<script>
		$(document).ready(function() {
		     
		    var sheepItForm = $('#childrenForm').sheepIt({
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
		 
		 	var sheepItForm = $('#educationForm').sheepIt({
		 	    separator: '',
		 	    allowRemoveLast: true,
		 	    allowRemoveCurrent: true,
		 	    allowRemoveAll: true,
		 	    allowAdd: true,
		 	    allowAddN: true,
		 	   	minFormsCount: 0,
		 	    iniFormsCount: 1
		 	});
		 
		 	var sheepItForm = $('#workForm').sheepIt({
		 	    separator: '',
		 	    allowRemoveLast: true,
		 	    allowRemoveCurrent: true,
		 	    allowRemoveAll: true,
		 	    allowAdd: true,
		 	    allowAddN: true,
		 	   	minFormsCount: 0,
		 	    iniFormsCount: 1
		 	});
			
			var schoolForm = new FormValidation('#schoolApp-form');
			schoolForm.labelShowHide('#schoolApp-form');
			$('#schoolApp-form').submit(function () {
			    return schoolForm.validate();
			});
		});
	</script>
	
	
	
<?php get_footer('help'); ?>