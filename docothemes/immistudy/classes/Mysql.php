<?php

//require_once 'includes/constants.php';

class Mysql {
	//This function returns the row with the given email and password
	public function verify_email_and_pass($email, $password){
		global $wpdb;
		$bindValues = array($email, $password);
		
		$query = $wpdb->prepare( 
				   "SELECT * 
					FROM $wpdb->membership
					WHERE member_email = %s AND member_password = %s 
					LIMIT 1
					",
					$bindValues
		);
		return $wpdb->get_row($query, ARRAY_A);
	}
	
	//This function gets a certain user if exists by his/her email
	//from the database
	public function get_member_by_email($email){
		global $wpdb;
		$query = $wpdb->prepare( 
				   "SELECT * 
					FROM $wpdb->membership
					WHERE member_email = %s 
					LIMIT 1
					",
					$email
		);
		return $wpdb->get_row($query, ARRAY_A);
	}
	
	//This function checks if there is a user with 
	//this email and activation code in the database
	public function check_member_email_actCode($email, $activation_code){
		global $wpdb;
		$bindValues = array($email, $activation_code);
		$query = $wpdb->prepare( 
				   "SELECT * 
					FROM $wpdb->membership
					WHERE member_email = %s 
					AND member_actcode = %s
					LIMIT 1
					",
					$bindValues
		);
		return $wpdb->query($query);
	}
	
	//This function checks if there is a row in the db
	//corresponding to a given user id
	public function check_member_id($user_id){
		global $wpdb;
		$query = $wpdb->prepare( 
				   "SELECT * 
					FROM $wpdb->membership
					WHERE member_id = %d
					LIMIT 1
					",
					$user_id
		);
		return $wpdb->query($query);
	}
	
	//This functino finds the row with the given email 
	//and activation code and updates its password field
	public function change_password($password, $email, $actCode){
		global $wpdb;
		$bindValues = array($password, $email, $actCode);
		$query = $wpdb->prepare(
					"UPDATE $wpdb->membership
					SET member_password=%s 
					WHERE member_email=%s
					AND member_actcode=%s
					",
					$bindValues
		);
		return ($wpdb->query($query));
	}  
	
	
	//This function checks if the field member_active 
	//from the given row is true
	public function verify_active($row_info){
		return ($row_info['member_active'] === '1');
	}
	
	/*  Getter functions */
	
	//This function returns the value of the field id
	//from a given row
	public function get_user_id($row_info){
		return $row_info['member_id'];
	}
	
	public function get_id_by_email($email){
		global $wpdb;
		$query = $wpdb->prepare( 
				   "SELECT member_id 
					FROM $wpdb->membership
					WHERE member_email = %s
					LIMIT 1
					",
					$email
		);
		return $wpdb->get_var($query);
	}
	
	public function get_five_ips(){
		global $wpdb; 
		$query = $wpdb->escape(
					"SELECT$wpdb->login_attempts
					 FROM big_table
					 ORDER BY id DESC
					 LIMIT 5
					" 
		);
		return $wpdb->get_results($query, ARRAY_N);
	}		
		
	
	
	//This function returns the values of the name and 
	//last name fields from a given row
	public function get_user_name_lastname($row_info){
		return $row_info['member_name'] . " " . $row_info['member_lastname'];
	}
	
	//This function returns the password value of 
	//the given row from a membership table
	public function get_user_password($row_info){
		return $row_info['member_password'];
	}
	
	//This function returns the value of the password
	//field of the row that corresponds to a given id
	public function get_password_by_id($user_id){
		global $wpdb;
		$query = $wpdb->prepare( 
				   "SELECT member_password 
					FROM $wpdb->membership
					WHERE member_id = %s 
					LIMIT 1
					",
					$user_id
		);
		return $wpdb->get_var($query);
	}
	
	//This function returns an email, name, and last name of 
	//a row that containes a given id
	public function get_name_lastname_email_by_id($user_id){
		global $wpdb;
		$query = $wpdb->prepare( 
				   "SELECT member_name, member_lastname, member_email 
					FROM $wpdb->membership
					WHERE member_id = %d
					LIMIT 1
					",
					$user_id
		);
		return $wpdb->get_results($query, ARRAY_N);
	}
	
	//This function returns the bottom row of the school
	//applications table
	public function get_bottom_school_application(){
		global $wpdb; 
		$query = $wpdb->escape(
					"SELECT * 
					 FROM wp_schoolApp 
					 ORDER BY form_id DESC 
					 LIMIT 1" 
		);
		return $wpdb->get_results($query, ARRAY_N);
	}
	
	//This function returns the bottom row of the immigration
	//applications table
	public function get_bottom_immigration_application(){
		global $wpdb; 
		$query = $wpdb->escape(
					"SELECT * 
					 FROM wp_immigrationApp 
					 ORDER BY form_id DESC 
					 LIMIT 1" 
		);
		return $wpdb->get_results($query, ARRAY_N);
	}
	
	//This function returns the bottom row of the work
	//applications table
	public function get_bottom_work_application() {
		global $wpdb; 
		$query = $wpdb->escape(
					"SELECT * 
					 FROM wp_workApp 
					 ORDER BY form_id DESC 
					 LIMIT 1" 
		);
		return $wpdb->get_results($query, ARRAY_N);
	}
	
	//This function gets the row from the children school
	//application that corresponds to a given id
	public function get_children_school_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->schoolApp_children
					 WHERE schoolApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	//This function gets the rows from the children immigration
	//application that corresponds to a given id
	public function get_children_immigration_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->immigrationApp_children
					 WHERE immigrationApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	//This function gets the row from the school school
	//application that correspond to a given id
	public function get_schools_school_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->schoolApp_school
					 WHERE schoolApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	//This function gets the rows from the school immigration
	//application that correspond to a given id
	public function get_schools_immigration_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->immigrationApp_school
					 WHERE immigrationApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	//This function gets the rows from the work school
	//application that correspond to a given id
	public function get_works_school_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->schoolApp_work
					 WHERE schoolApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	//This function gets the rows from the work immigration
	//application that correspond to a given id
	public function get_works_immigration_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->immigrationApp_work
					 WHERE immigrationApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	//This function gets the rows from the other work work
	//application that correspond to a given id
	public function get_otherWorks_work_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->workApp_otherWork
					 WHERE workApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	//This function gets the rows from the visa denial work
	//application that correspond to a given id
	public function get_visaDenials_work_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->workApp_visaDenial
					 WHERE workApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	//This function gets the rows from the visa work
	//application that correspond to a given id
	public function get_visas_work_application($id){
		global $wpdb;
		$query = $wpdb->prepare(
					"SELECT *
					 FROM $wpdb->workApp_visa
					 WHERE workApp_form_id = %d
					",
					$id
		);
		return $wpdb->get_results($query, ARRAY_N);	
	}
	
	/* End Getter functions */
	
	
	//This function inserts the data about the login attempt
	//in the login attempts table
	public function login_attempt($user_id, $time){
		global $wpdb;
		$bindValues = array($user_id, $time);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->login_attempts
					 (member_id, login_time)
					 VALUES (%d, %s)
					 ",
					 $bindValues
		);
		return $wpdb->query($query);
	}
	
	public function check_login_attempts($user_id, $valid_attempts){
		global $wpdb;
		$bindValues = array($user_id, $valid_attempts);
		$query = $wpdb->prepare(
					 "SELECT login_time 
					  FROM $wpdb->login_attempts
					  WHERE member_id = %d 
					  AND login_time > %d
					  ",
					  $bindValues
		);
		$wpdb->get_results($query);
		return $wpdb->num_rows;
	}
	
	public function schoolApp_insert_child($name){
		global $wpdb;
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->schoolApp_children
					 (schoolApp_children_name)
					 VALUES (%s)
					 ",
					 $name
		);
		return $wpdb->query($query);
	}
	
	public function schoolApp_tablesLink_insert_child($member_id, $child_id){
		global $wpdb;
		$bindValues = array($member_id, $child_id);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->schoolApp_tablesLink
					 (member_id, schoolApp_childID)
					 VALUES (%d, %d)
					 ",
					 $bindValues
		);
		return $wpdb->query($query);
	}
	
	public function update_activation_code($email, $code){
		global $wpdb;
		$bindValues = array($code, $email);
		$update = $wpdb->prepare(
			"UPDATE $wpdb->membership
			 SET member_actcode=%s
			 WHERE member_email=%s
			 ",
			 $bindValues
		);
		
		return $wpdb->query($update);
	}
	
	public function insert_activation_code($email, $code){
		global $wpdb;
		$bindValues = array($code, $email);
		$update = $wpdb->prepare(
			"INSERT INTO $wpdb->membership
			 (member_actcode)
			 VALUES (%s)
			 WHERE member_email = %s
			 ",
			 $bindValues
		);
		return $wpdb->query($update);
	}
	
	public function user_activation($code){
		global $wpdb;
		$bindValues = array(1, $code);
		$query = $wpdb->prepare(
			"SELECT member_actcode 
			 FROM $wpdb->membership
			 WHERE member_actcode = %s
			 LIMIT 1
			",
			$code
		);
		if($wpdb->query($query)){
			$update = $wpdb->prepare(
				"UPDATE $wpdb->membership
				 SET member_active = %d
				 WHERE member_actcode = %s
				 ",
				 $bindValues
			);
			return ($wpdb->query($update));
		}	
			
	}
	
	public function add_child_schoolApp($name, $age, $gender, $formID){
		global $wpdb;
		$bindValues = array($name, $age, $gender, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->schoolApp_children
					 (schoolApp_children_name, schoolApp_children_age, schoolApp_children_gender, schoolApp_form_id)
					 VALUES (%s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	
	public function add_child_immigrationApp($name, $age, $gender, $formID){
		global $wpdb;
		$bindValues = array($name, $age, $gender, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->immigrationApp_children
					 (immigrationApp_children_name, immigrationApp_children_age, immigrationApp_children_gender, immigrationApp_form_id)
					 VALUES (%s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	
	public function add_school_schoolApp($name, $place, $years, $document, $formID){
		global $wpdb;
		$bindValues = array($name, $place, $years, $document, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->schoolApp_school
					 (schoolApp_school_name, schoolApp_school_place, schoolApp_school_years, schoolApp_school_document, schoolApp_form_id)
					 VALUES (%s, %s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	
	
	public function add_school_immigrationApp($name, $place, $years, $document, $formID){
		global $wpdb;
		$bindValues = array($name, $place, $years, $document, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->immigrationApp_school
					 (immigrationApp_school_name, immigrationApp_school_place, immigrationApp_school_years, immigrationApp_school_document, immigrationApp_form_id)
					 VALUES (%s, %s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
		
	public function add_work_schoolApp($name, $status, $years, $responsibilities, $formID){
		global $wpdb;
		$bindValues = array($name, $status, $years, $responsibilities, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->schoolApp_work
					 (schoolApp_work_name, schoolApp_work_status, schoolApp_work_years, schoolApp_work_resposibilities, schoolApp_form_id)
					 VALUES (%s, %s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	
	public function add_work_immigrationApp($name, $status, $years, $responsibilities, $formID){
		global $wpdb;
		$bindValues = array($name, $status, $years, $responsibilities, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->immigrationApp_work
					 (immigrationApp_work_name, immigrationApp_work_status, immigrationApp_work_years, immigrationApp_work_responsibilities, immigrationApp_form_id)
					 VALUES (%s, %s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	
	public function add_otherCountry_workApp($country, $type, $date, $formID){
		global $wpdb;
		$bindValues = array($country, $type, $date, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->workApp_otherWork
					 (workApp_otherWork_country, workApp_otherWork_type, workApp_otherWork_date, workApp_form_id)
					 VALUES (%s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	
	public function add_visaDenial_workApp($country, $type, $date, $formID){
		global $wpdb;
		$bindValues = array($country, $type, $date, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->workApp_visaDenial
					 (workApp_visaDenial_country, workApp_visaDenial_type, workApp_visaDenial_date, workApp_form_id)
					 VALUES (%s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	
	public function add_visa_workApp($country, $type, $date, $formID){
		global $wpdb;
		$bindValues = array($country, $type, $date, $formID);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->workApp_visa
					 (workApp_visa_country, workApp_visa_type, workApp_visa_date, workApp_form_id)
					 VALUES (%s, %s, %s, %d)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	
	public function contact_form($name, $email, $message){
		global $wpdb;
		$bindValues = array($name, $email, $message);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->contactForm
					 (contact_form_name, contact_form_email, contact_form_message)
					 VALUES (%s, %s, %s)
					",
					$bindValues		
		);
		return ($wpdb->query($query));
	}
	 
	public function registration_form($name, $lastname, $email, $password, $joinDate, $lastAccess, $actCode){
		global $wpdb;
		$bindValues = array($name, $lastname, $email, $password, 0, $joinDate, $lastAccess, $actCode);
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->membership
					 (member_name, member_lastname, member_email, member_password, member_active, member_joinDate, member_lastAccess, member_actcode)
					 VALUES (%s, %s, %s, %s, %d, %s, %s, %s)
					",
					$bindValues
		
		);
		return ($wpdb->query($query));
	}
	
	public function update_user($name, $lastname, $email, $password, $joinDate, $lastAccess, $actCode){
		global $wpdb;
		$bindValues = array($name, $lastname, $email, $password, 0, $joinDate, $lastAccess, $actCode, $email);
		$query = $wpdb->prepare(
					"UPDATE $wpdb->membership
					SET member_name=%s, member_lastname=%s, member_email=%s, member_password=%s, member_active=%d, member_joinDate=%s, member_lastAccess=%s, member_actcode=%s
					WHERE member_email=%s
					",
					$bindValues
		);
		return ($wpdb->query($query));
	}

	public function schoolApp_form($data){
		global $wpdb;
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->schoolApp
					 (member_id, member_name, member_lastname, member_email, schoolApp_gender, schoolApp_birthDate, schoolApp_phone, schoolApp_address, schoolApp_familyStatus, schoolApp_citizenship, schoolApp_nativeLanguage, schoolApp_EduLevel, schoolApp_EduSpeciality, schoolApp_addSkill)
					 VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
					",
					$data
		);
		$get_id = "SELECT LAST_INSERT_ID()";	
		if($wpdb->query($query)){
			return ($wpdb->get_var($get_id));
		}
	}
	
	public function immigrationApp_form($data){
		global $wpdb;
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->immigrationApp
					 (member_id, member_name, member_lastname, member_email, immigrationApp_gender, immigrationApp_birthDate, immigrationApp_phone, immigrationApp_address, immigrationApp_familyStatus, immigrationApp_citizenship, immigrationApp_nativeLanguage, immigrationApp_EduLevel, immigrationApp_EduSpeciality, immigrationApp_addSkills, immigrationApp_army, immigrationApp_armyOtvod, immigrationApp_armyZvanie, immigrationApp_armyYears, immigrationApp_police, immigrationApp_policeCause, immigrationApp_policeYears)
					 VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
					",
					$data
		);
		$get_id = "SELECT LAST_INSERT_ID()";	
		if($wpdb->query($query)){
			return ($wpdb->get_var($get_id));
		}
	}

	public function workApp_form($data){
		global $wpdb;
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->workApp
					 (member_id, member_name, member_lastname, member_email, workApp_gender, workApp_birthDate, workApp_phone, workApp_addPhone, workApp_citizenship, workApp_propiska, workApp_EduLevel, workApp_LangLevel, workApp_otherLang, workApp_relativesAbroad, workApp_relativesAbroadExplain, workApp_healthIssues, workApp_healthIssuesExplain, workApp_army, workApp_armyOtvod, workApp_police, workApp_otherCountriesWork, workApp_visaDenial, workApp_visa)
					 VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
					",
					$data
		);
		$get_id = "SELECT LAST_INSERT_ID()";	
		if($wpdb->query($query)){
			return ($wpdb->get_var($get_id));
		}
	}
	
	public function chancesApp_form($data){
		global $wpdb;
		$query = $wpdb->prepare(
					"INSERT INTO $wpdb->chancesApp
						(chancesApp_goal, chancesApp_name, chancesApp_gender, chancesApp_birthDate, chancesApp_english, chancesApp_email, chancesApp_eduLevel)
					 VALUES (%s, %s, %s, %s, %s, %s, %s)
					",
					$data
		);
		return ($wpdb->query($query));
	}

	//This function truncates the wp_geo_cities table
	public function truncate_geocities(){
		global $wpdb;
		$query = $wpdb->escape(
					"TRUNCATE TABLE wp_geo_cities"
		);
		return $wpdb->query($query);
	}

	//This function truncates the wp_geo_base table
	public function truncate_geobase(){
		global $wpdb;
		$query = $wpdb->escape(
					"TRUNCATE TABLE wp_geo_base"
		);
		return $wpdb->query($query);
	}

	//This function imports the data into the wp_geo_cities table
	public function import_geocities($city_id, $city, $region, $district, $lat, $lng){
		global $wpdb;
		$bindValues = array($city_id, $city, $region, $district, $lat, $lng);
		$query = $wpdb->prepare(
					"INSERT INTO wp_geo_cities
						(city_id, city, region, district, lat, lng)
					 VALUES (%s, %s, %s, %s, %s, %s)
					",
					$bindValues
		);
		return ($wpdb->query($query));
	}

	//This function imports the data into the wp_geo_base table
	public function import_geobase($long_ip1, $long_ip2, $ip1, $ip2, $country, $city_id){
		global $wpdb;
		
		$bindValues = array($long_ip1, $long_ip2, $ip1, $ip2, $country, $city_id);
		$query = $wpdb->prepare(
					"INSERT INTO wp_geo_base
						(long_ip1, long_ip2, ip1, ip2, country, city_id)
					 VALUES (%s, %s, %s, %s, %s, %s)
					",
					$bindValues
		);
		return ($wpdb->query($query));	
	}

	public function get_ip_data($long_ip){
		global $wpdb;
		$bindValues = array($long_ip, $long_ip);
		$query = $wpdb->prepare(
					"SELECT * 
					 FROM wp_geo_base 
					 WHERE long_ip1 = %s AND long_ip2 = %s 
					 LIMIT 1
					",
					$bindValues 
		);
		return $wpdb->get_row($query, ARRAY_A);
	}

	public function get_city_data($res1){
		global $wpdb;
		$query = $wpdb->escape(
					"SELECT * 
					 FROM wp_geo_cities 
					 WHERE city_id = $res1[city_id] 
					 LIMIT 1
					 "
		);
		return $wpdb->get_row($query, ARRAY_A);
	}
}