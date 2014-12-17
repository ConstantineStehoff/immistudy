<?php

require_once('Mysql.php');

class Application {
	private $mysql;
	private $schoolData = array(
	          "id" => "",
	          "name" => "",
	          "lastname" => "",
	          "email" => "",
	          "gender" => "",
	          "birthDate" => "",
	          "phone" => "",
	          "address" => "",
	          "familyStatus" => "",
	          "citizenship" => "",
	          "nativeLang" => "",
	          "EduLevel" => "",
	          "speciality" => "",
	          "additional" => ""
	);
	
	private $immigrationData = array(
			  "id" => "",
			  "name" => "",
			  "lastname" => "",
			  "email" => "",
			  "gender" => "",
			  "birthDate" => "",
			  "phone" => "",
			  "address" => "",
			  "familyStatus" => "",	
			  "citizenship" => "",
			  "nativeLang" => "",
			  "EduLevel" => "",
			  "speciality" => "",
			  "additional" => "",
			  "army" => "",
			  "armyOtvod" => "",
			  "armyZvanie" => "",
			  "armyYears" => "",
			  "police" => "",
			  "policeCause" => "",
			  "policeYears" => ""
	);
	
	private $workData = array(
			  "id" => "",
			  "name" => "",
			  "lastname" => "",
			  "email" => "",
			  "gender" => "",
			  "birthDate" => "",
			  "phone" => "",
			  "addPhone" => "",
			  "citizenship" => "",
			  "propiska" => "",
			  "EduLevel" => "",
			  "LangLevel" => "",
			  "otherLang" => "",
			  "relativesAbroad" => "",
			  "relateiveAbroadExplain" => "",
			  "healthIssues" => "",
			  "healthIssuesExplain" => "",
			  "army" => "",
			  "armyOtvod" => "",
			  "police" => "",
			  "otherCountriesWork" => "",
			  "visaDenial" => "",
			  "visa" => ""
	);
	
	private $children = array(
				"name" => "",
				"age" =>"",
				"gender" => "",
				"application_id" => ""
	);
	
	private $schools = array(
				"name" => "",
				"place" =>"",
				"years" => "",
				"document" => "",
				"application_id" => ""
	);
	
	private $works = array(
				"name" => "",
				"status" =>"",
				"years" => "",
				"responsibilities" => "",
				"application_id" => ""
	);
	
	private $otherWork = array(
				"country" => "",
				"type" => "",
				"date" => "",
				"application_id" => ""
	);
	
	private $visaDenial = array(
				"country" => "",
				"type" => "",
				"date" => "",
				"application_id" => ""
	);
	
	private $visa = array(
				"country" => "",
				"type" => "",
				"date" => "",
				"application_id" => ""
	);
	
	public function __construct(){
		
	}
	
	public static function schoolForm($schoolData){
		$instance = new self();
		$instance->set_schoolData($schoolData);
		return $instance;
	}
	
	public static function immigrationForm($immigrationData) {
		$instance = new self();
		$instance->set_immigrationData($immigrationData);
		return $instance;
	}
	
	public static function workForm($workData) {
		$instance = new self();
		$instance->set_workData($workData);
		return $instance;
	}
	
	public function set_schoolData($schoolData){
		foreach ($schoolData as $key => $value) {
			if ( array_key_exists($key, $this->schoolData) ) $this->schoolData[$key] = $value;
		}
	}
	
	public function get_schoolApp_children(){
		return $this->schoolApp_children;
	}
	
	public function set_immigrationData($immigrationData){
		foreach ($immigrationData as $key => $value) {
			if ( array_key_exists($key, $this->immigrationData) ) $this->immigrationData[$key] = $value;
		}
	}
	
	public function set_workData($workData){
		foreach ($workData as $key => $value) {
			if ( array_key_exists($key, $this->workData) ) $this->workData[$key] = $value;
		}
	}
	
	public function set_children($children){
		foreach ($children as $key => $value) {
			if ( array_key_exists($key, $this->children) ) $this->children[$key] = $value;
		}
	}
	
	public function set_schools($schools){
		foreach ($schools as $key => $value) {
			if ( array_key_exists($key, $this->schools) ) $this->schools[$key] = $value;
		}
	}
	
	public function set_works($works){
		foreach ($works as $key => $value) {
			if ( array_key_exists($key, $this->works) ) $this->works[$key] = $value;
		}
	}
	
	public function set_otherWork_workApp($otherWork){
		foreach ($otherWork as $key => $value) {
			if ( array_key_exists($key, $this->otherWork) ) $this->otherWork[$key] = $value;
		}
	}
	
	public function set_visaDenial_workApp($visaDenial){
		foreach ($visaDenial as $key => $value) {
			if ( array_key_exists($key, $this->visaDenial) ) $this->visaDenial[$key] = $value;
		}
	}
	
	
	public function set_visa_workApp($visa){
		foreach ($visa as $key => $value) {
			if ( array_key_exists($key, $this->visa) ) $this->visa[$key] = $value;
		}
	}
	
	
	public function put_schoolData(){
		$this->mysql = new Mysql();
		return $this->mysql->schoolApp_form($this->schoolData);
	}
	
	public function put_immigrationData(){
		$this->mysql = new Mysql();
		return $inserted_user_id = $this->mysql->immigrationApp_form($this->immigrationData);
	}
	
	public function put_workData(){
		$this->mysql = new Mysql();
		return $inserted_user_id = $this->mysql->workApp_form($this->workData);
	}
	
	public function put_schoolApp_children(){
		for($i = 0; $i < count($this->children["name"]); $i++){
			$this->mysql->add_child_schoolApp($this->children["name"][$i], $this->children["age"][$i], $this->children["gender"][$i], $this->children["application_id"]);
		}
	}
	
	public function put_schoolApp_schools(){
		for($i = 0; $i < count($this->schools["name"]); $i++){
			$this->mysql->add_school_schoolApp($this->schools["name"][$i], $this->schools["place"][$i], $this->schools["years"][$i], $this->schools["document"][$i],$this->schools["application_id"]);
		}
	}
	
	public function put_schoolApp_works(){
		for($i = 0; $i < count($this->works["name"]); $i++){
			$this->mysql->add_work_schoolApp($this->works["name"][$i], $this->works["status"][$i], $this->works["years"][$i], $this->works["responsibilities"][$i],$this->works["application_id"]);
		}
	}
	
	public function put_immigrationApp_children(){
		for($i = 0; $i < count($this->children["name"]); $i++){
			$this->mysql->add_child_immigrationApp($this->children["name"][$i], $this->children["age"][$i], $this->children["gender"][$i], $this->children["application_id"]);
		}
	}
	
	public function put_immigrationApp_schools(){
		for($i = 0; $i < count($this->schools["name"]); $i++){
			$this->mysql->add_school_immigrationApp($this->schools["name"][$i], $this->schools["place"][$i], $this->schools["years"][$i], $this->schools["document"][$i],$this->schools["application_id"]);
		}
	}
	
	public function put_immigrationApp_works(){
		for($i = 0; $i < count($this->works["name"]); $i++){
			$this->mysql->add_work_immigrationApp($this->works["name"][$i], $this->works["status"][$i], $this->works["years"][$i], $this->works["responsibilities"][$i], $this->works["application_id"]);
		}
	}
	
	//This function puts data about the work in the
	//other countries from the work application into the database
	public function put_workApp_otherWork(){
		for($i = 0; $i < count($this->otherWork['country']); $i++){
			$this->mysql->add_otherCountry_workApp($this->otherWork['country'][$i], $this->otherWork['type'][$i], $this->otherWork['date'][$i], $this->otherWork['application_id']);
		}
	}
	
	//This function puts data about the denied visas 
	//from the work application into the database 
	public function put_workApp_visaDenial(){
		for($i = 0; $i < count($this->visaDenial['country']); $i++){
			$this->mysql->add_visaDenial_workApp($this->visaDenial['country'][$i], $this->visaDenial['type'][$i], $this->visaDenial['date'][$i], $this->visaDenial['application_id']);
		}
	}
	
	//This function puts data about the visa violations 
	//from the work application into the database 
	public function put_workApp_visa(){
		for($i = 0; $i < count($this->visa['country']); $i++){
			$this->mysql->add_visa_workApp($this->visa['country'][$i], $this->visa['type'][$i], $this->visa['date'][$i], $this->visa['application_id']);
		}
	}
	
	//This function returns the received 
	//school application in the text form
	public function get_school_application(){
		$schoolApp_row = $this->mysql->get_bottom_school_application();
		$schoolApp_children_rows = $this->mysql->get_children_school_application($schoolApp_row[0][0]);
		$schoolApp_schools_rows = $this->mysql->get_schools_school_application($schoolApp_row[0][0]);
		$schoolApp_works_rows = $this->mysql->get_works_school_application($schoolApp_row[0][0]);
		$children_msg = "Дети";
		$child_num = 0;
		for ($i = 0; $i < sizeof($schoolApp_children_rows); $i++) {
			$child_num++;
			$children_msg .= "\r\n"
			. "Номер ребенка " . $child_num
			. "\r\n"
			. "Имя ребенка: " . $schoolApp_children_rows[$i][2]
			. "\r\n"
			. "Возраст ребенка: " . $schoolApp_children_rows[$i][3]
			. "\r\n"
			. "Пол ребенка: " . $schoolApp_children_rows[$i][4];	
		};
		
		$schools_msg = "История образования";
		$school_num = 0;
		for ($i = 0; $i < sizeof($schoolApp_schools_rows); $i++) {
			$school_num++;
			$schools_msg .= "\r\n"
			. "Номер учебного заведения " . $school_num
			. "\r\n"
			. "Название: " . $schoolApp_schools_rows[$i][2]
			. "\r\n"
			. "Место: " . $schoolApp_schools_rows[$i][3]
			. "\r\n"
			. "Годы обучения: " . $schoolApp_schools_rows[$i][4]
			. "\r\n"
			. "Полученный документ: " . $schoolApp_schools_rows[$i][5];	
		};
		
		$works_msg = "\r\n\r\n"
					 . "РАБОТА";
		$work_num = 0;
		for ($i = 0; $i < sizeof($schoolApp_works_rows); $i++) {
			$work_num++;
			$works_msg .= "\r\n"
			. "Номер работы " . $work_num
			. "\r\n"
			. "Название предприятия: " . $schoolApp_works_rows[$i][2]
			. "\r\n"
			. "Должность: " . $schoolApp_works_rows[$i][3]
			. "\r\n"
			. "Годы работы: " . $schoolApp_works_rows[$i][4]
			. "\r\n"
			. "Должностные обязанности: " . $schoolApp_works_rows[$i][5];
		}
		
		$msg = "Анкета на обучение номер " . $schoolApp_row[0][0] 
			. "\r\n"
			. "Номер пользователя " . $schoolApp_row[0][1]
			. "\r\n\r\n"
			. "КОНТАКТНАЯ ИНФОРМАЦИЯ"
			. "\r\n"
			. "Имя: " . $schoolApp_row[0][2]
			. "\r\n"
			. "Фамилия: " . $schoolApp_row[0][4]
			. "\r\n"
			. "Электронный адрес: " . $schoolApp_row[0][3]
			. "\r\n"
			. "Пол: " . $schoolApp_row[0][5]
			. "\r\n"
			. "Дата рождения: " . $schoolApp_row[0][6]
			. "\r\n"
			. "Номер телефона: " . $schoolApp_row[0][7]
			. "\r\n"
			. "Адрес: " . $schoolApp_row[0][8]
			. "\r\n"
			. "Семейное положение: " . $schoolApp_row[0][9]
			. "\r\n"
			. "Гражданство: " . $schoolApp_row[0][10]
			. "\r\n"
			. "Родной язык: " . $schoolApp_row[0][11]
			. "\r\n\r\n"
			. $children_msg
			. "\r\n\r\n"
			. "ОБРАЗОВАНИЕ"
			. "\r\n"
			. "Уровень Образования: " . $schoolApp_row[0][12]
			. "\r\n"
			. "Специальность: " . $schoolApp_row[0][13]
			. "\r\n"
			. $schools_msg
			. $works_msg
			. "\r\n"
			. "ДОПОЛНИТЕЛЬНЫЕ НАВЫКИ: " . $schoolApp_row[0][14];
		return $msg;
	}
	
	//This function returns the received immigration 
	//application in the text format
	public function get_immigration_application(){
		$immigrationApp_row = $this->mysql->get_bottom_immigration_application();
		$immigrationApp_children_rows = $this->mysql->get_children_immigration_application($immigrationApp_row[0][0]);
		$immigrationApp_schools_rows = $this->mysql->get_schools_immigration_application($immigrationApp_row[0][0]);
		$immigrationApp_works_rows = $this->mysql->get_works_immigration_application($immigrationApp_row[0][0]);
		$children_msg = "Дети";
		$child_num = 0;
		for ($i = 0; $i < sizeof($immigrationApp_children_rows); $i++) {
			$child_num++;
			$children_msg .= "\r\n"
			. "Номер ребенка " . $child_num
			. "\r\n"
			. "Имя ребенка: " . $immigrationApp_children_rows[$i][2]
			. "\r\n"
			. "Возраст ребенка: " . $immigrationApp_children_rows[$i][3]
			. "\r\n"
			. "Пол ребенка: " . $immigrationApp_children_rows[$i][4];	
		};
		
		$schools_msg = "История образования";
		$school_num = 0;
		for ($i = 0; $i < sizeof($immigrationApp_schools_rows); $i++) {
			$school_num++;
			$schools_msg .= "\r\n"
			. "Номер учебного заведения " . $school_num
			. "\r\n"
			. "Название: " . $immigrationApp_schools_rows[$i][2]
			. "\r\n"
			. "Место: " . $immigrationApp_schools_rows[$i][3]
			. "\r\n"
			. "Годы обучения: " . $immigrationApp_schools_rows[$i][4]
			. "\r\n"
			. "Полученный документ: " . $immigrationApp_schools_rows[$i][5];	
		};
		
		$works_msg = "\r\n\r\n"
					 . "РАБОТА";
		$work_num = 0;
		for ($i = 0; $i < sizeof($immigrationApp_works_rows); $i++) {
			$work_num++;
			$works_msg .= "\r\n"
			. "Номер работы " . $work_num
			. "\r\n"
			. "Название предприятия: " . $immigrationApp_works_rows[$i][2]
			. "\r\n"
			. "Должность: " . $immigrationApp_works_rows[$i][3]
			. "\r\n"
			. "Годы работы: " . $immigrationApp_works_rows[$i][4]
			. "\r\n"
			. "Должностные обязанности: " . $immigrationApp_works_rows[$i][5];
		}
		
		$msg = "Анкета на иммиграцию номер " . $immigrationApp_row[0][0] 
			. "\r\n"
			. "Номер пользователя " . $immigrationApp_row[0][1]
			. "\r\n\r\n"
			. "КОНТАКТНАЯ ИНФОРМАЦИЯ"
			. "\r\n"
			. "Имя: " . $immigrationApp_row[0][2]
			. "\r\n"
			. "Фамилия: " . $immigrationApp_row[0][4]
			. "\r\n"
			. "Электронный адрес: " . $immigrationApp_row[0][3]
			. "\r\n"
			. "Пол: " . $immigrationApp_row[0][5]
			. "\r\n"
			. "Дата рождения: " . $immigrationApp_row[0][6]
			. "\r\n"
			. "Номер телефона: " . $immigrationApp_row[0][7]
			. "\r\n"
			. "Адрес: " . $immigrationApp_row[0][8]
			. "\r\n"
			. "Семейное положение: " . $immigrationApp_row[0][9]
			. "\r\n"
			. "Гражданство: " . $immigrationApp_row[0][10]
			. "\r\n"
			. "Родной язык: " . $immigrationApp_row[0][11]
			. "\r\n\r\n"
			. $children_msg
			. "\r\n\r\n"
			. "ОБРАЗОВАНИЕ"
			. "\r\n"
			. "Уровень Образования: " . $immigrationApp_row[0][12]
			. "\r\n"
			. "Специальность: " . $immigrationApp_row[0][13]
			. "\r\n"
			. $schools_msg
			. $works_msg
			. "\r\n"
			. "\r\n"
			. "ДОПОЛНИТЕЛЬНЫЕ НАВЫКИ: " . $immigrationApp_row[0][14]
			. "\r\n"
			. "Служили ли Вы в Армии? " . $immigrationApp_row[0][15]
			. "\r\n"
			. "Если имели отвод от армии то укажите диагноз: " . $immigrationApp_row[0][16]
			. "\r\n"
			. "Если да то укажите ниже"
			. "\r\n"
			. "Звание: " . $immigrationApp_row[0][17]
			. "\r\n"
			. "Годы службы: " . $immigrationApp_row[0][18] 
			. "\r\n"
			. "Имели ли вы судимость? " . $immigrationApp_row[0][19]
			. "\r\n"
			. "Если да то укажите ниже"
			. "\r\n"
			. "Причина: " . $immigrationApp_row[0][20]
			. "\r\n"
			. "Сроки отбывания: " . $immigrationApp_row[0][21];
		return $msg;
	}
	
	//This function returns the received work application in the
	//text format
	public function get_work_application(){
		$workApp_row = $this->mysql->get_bottom_work_application();
		$workApp_otherWorks_rows = $this->mysql->get_otherWorks_work_application($workApp_row[0][0]);
		$workApp_visaDenials_rows = $this->mysql->get_visaDenials_work_application($workApp_row[0][0]);
		$workApp_visas_rows = $this->mysql->get_visas_work_application($workApp_row[0][0]);
		
		$otherWorks_msg = "Работа в других странах";
		$otherWork_num = 0;
		for ($i = 0; $i < sizeof($workApp_otherWorks_rows); $i++) {
			$otherWork_num++;
			$otherWorks_msg .= "\r\n"
			. "Номер работы " . $otherWork_num
			. "\r\n"
			. "Страна: " . $workApp_otherWorks_rows[$i][2]
			. "\r\n"
			. "Тип визы: " . $workApp_otherWorks_rows[$i][3]
			. "\r\n"
			. "Даты: " . $workApp_otherWorks_rows[$i][4];	
		};
		
		$visaDenials_msg = "Отказы в визах";
		$visaDenial_num = 0;
		for ($i = 0; $i < sizeof($workApp_visaDenials_rows); $i++) {
			$visaDenial_num++;
			$visaDenials_msg .= "\r\n"
			. "Номер отказа " . $visaDenial_num
			. "\r\n"
			. "Страна: " . $workApp_visaDenials_rows[$i][2]
			. "\r\n"
			. "Тип визы: " . $workApp_visaDenials_rows[$i][3]
			. "\r\n"
			. "Дата: " . $workApp_visaDenials_rows[$i][4];	
		};
		
		$visas_msg = "Нарушения визового режима";
		$visa_num = 0;
		for ($i = 0; $i < sizeof($workApp_visas_rows); $i++) {
			$visa_num++;
			$visas_msg .= "\r\n"
			. "Номер отказа " . $visa_num
			. "\r\n"
			. "Страна: " . $workApp_visas_rows[$i][2]
			. "\r\n"
			. "Тип визы: " . $workApp_visas_rows[$i][3]
			. "\r\n"
			. "Дата: " . $workApp_visas_rows[$i][4];	
		};
		
		$msg = "Анкета на работу номер " . $workApp_row[0][0]
			. "\r\n"
			. "Номер пользователя " . $workApp_row[0][1]
			. "\r\n\r\n"
			. "КОНТАКТНАЯ ИНФОРМАЦИЯ"
			. "\r\n"
			. "Имя: " . $workApp_row[0][2]
			. "\r\n"
			. "Фамилия: " . $workApp_row[0][4]
			. "\r\n"
			. "Электронный адрес: " . $workApp_row[0][3]
			. "\r\n"
			. "Пол: " . $workApp_row[0][5]
			. "\r\n"
			. "Дата рождения: " . $workApp_row[0][6]
			. "\r\n"
			. "Номер телефона: " . $workApp_row[0][7]
			. "\r\n"
			. "Дополнительный телефон: " . $workApp_row[0][8]
			. "\r\n"
			. "Гражданство: " . $workApp_row[0][9]
			. "\r\n"
			. "Место прописки: " . $workApp_row[0][10]
			. "\r\n\r\n"
			. "ДРУГАЯ ИНФОРМАЦИЯ"
			. "\r\n"
			. "Уровень Образования: " . $workApp_row[0][11]
			. "\r\n"
			. "Уровень знания английского языка: " . $workApp_row[0][12]
			. "\r\n"
			. "Знание других языков: " . $workApp_row[0][13]
			. "\r\n"
			. "Родственники за границей: " . $workApp_row[0][14]
			. "\r\n"
			. "Поясните степень родства: " . $workApp_row[0][15]
			. "\r\n"
			. "Проблемы со здоровьем: " . $workApp_row[0][16]
			. "\r\n"
			. "Поясните проблемы со здоровьем: " . $workApp_row[0][17]	
			. "\r\n"
			. "Были ли приводы в милицию: " . $workApp_row[0][18]
			. "\r\n"
			. "Работали ли других странах: " . $workApp_row[0][19]
			. "\r\n\r\n"
			. $otherWorks_msg
			. "\r\n"
			. "Были ли отказы в получении визы: " . $workApp_row[0][20]
			. "\r\n\r\n"
			. $visaDenials_msg
			. "\r\n"
			. "Были ли нарушения визового режима: " . $workApp_row[0][21]
			. "\r\n\r\n"
			. $visas_msg;	
		
		return $msg;
	}
	
	
}	