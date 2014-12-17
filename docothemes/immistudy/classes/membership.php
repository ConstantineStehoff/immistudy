<?php

require_once('Mysql.php');
require_once('recaptchalib.php');

class Membership {
	
	protected $data = array(
	          "name" => "",
	          "lastname" => "",
	          "email" => "",
	          "password" => "",
	          "joinDate" => "",
	          "lastAccess" => ""
	);
	
	private $algo = '$2a';
	private $cost = '$10';
	private $captcha = false;
	
	public function __construct(){
	
	}
	
	public static function newRegistration($data) {
		$instance = new self();
		$instance->get_data($data);
		return $instance;
	}
	
	public function get_data($data){
		foreach ($data as $key => $value) {
			if ( array_key_exists( $key, $this->data ) ) $this->data[$key] = $value;
		}
	}
	
	public function print_data(){
		echo print_r($this->data);
	}
	
	//Register new user
	public function register_user(){
		$this->data["activationCode"] = $this->make_activation_code();
		if( $this->send_email($this->get_activation_msg($this->data["activationCode"])) ){
			$mysql = New Mysql();
			return( $mysql->registration_form($this->data["name"], $this->data["lastname"], $this->data["email"], $this->data["password"], $this->data["joinDate"], $this->data["lastAccess"], $this->data["activationCode"]) );
		}	
	}
	
	//Update new user if there is a record in a database but not activated
	public function update_new_user(){
		$this->data["activationCode"] = $this->make_activation_code();
		if( $this->send_email($this->get_activation_msg($this->data["activationCode"])) ){
			$mysql = New Mysql();
			return( $mysql->update_user($this->data["name"], $this->data["lastname"], $this->data["email"], $this->data["password"], $this->data["joinDate"], $this->data["lastAccess"], $this->data["activationCode"]) );
		}	
	}
	
	//This function checks the password and email in the database
	public function validate_user($email, $password) {
		$mysql = New Mysql();
		$is_member = $mysql->get_member_by_email($email);
		
		//Check if a member
		if( !empty($is_member) ){
			
			if ( $this->checkbrute( $mysql->get_user_id($is_member), 8, 2 * 60 * 60 ) ){
				//if there were 8 failed attempts
				header("location: ". SITE_URL . "/blocked");
				exit();
				return "Ваш личный кабинет зблокирован";
			} elseif ( $this->checkbrute( $mysql->get_user_id($is_member), 2, 30 * 60 ) ){
				//if there were 3 faild attempts
				header("location: " . SITE_URL . "/login_captcha"); 
				exit();
			} else {
				//if there is no captcha
				return $this->check_password_create_session($is_member, $password, $mysql);
			}
		} else {
			//if not a member
			$now = time();
			echo $ip;
			if( $mysql->login_attempt($mysql->get_user_id($is_member), $now) ){
				return "Неверный email или пароль";
			}	
		}
	
	}
	
	//This function validates a user with captcha
	function validate_user_captcha($email, $password) {
		$mysql = New Mysql();
		$is_member = $mysql->get_member_by_email($email);
		
		//Check if a member
		if( !empty($is_member) ){
			$privatekey = "6LdkG-ESAAAAABH2ElJqqdfw9IBniEapENAyUI7m";
			$resp = recaptcha_check_answer ($privatekey, 
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);
			
			if ( $this->checkbrute( $mysql->get_user_id($is_member), 8, 2 * 60 * 60 ) ){
				//if there were 8 failed attempts
				header("location: ". SITE_URL . "/blocked");
				exit();
				return "Ваш личный кабинет зблокирован";
			} elseif (!$resp->is_valid) {
				// What happens when the CAPTCHA was entered incorrectly
				return "Неправильная капча ";
			} else {
				// Your code here to handle a successful verification
				return $this->check_password_create_session($is_member, $password, $mysql); 	
			}
		
		} else {
			//if not a member
			$now = time();
			if( $mysql->login_attempt( $mysql->get_user_id($is_member), $now, get_client_ip() ) ){
				return "Неверный email или пароль";
			}	
		}
	}
	
	//This function checks if the password is correct
	//and logs in the user
	function check_password_create_session($is_member, $password, $mysql){
		//Check if the password is correct
		$hashed_password = $mysql->get_user_password($is_member);
		if($this->check_password($hashed_password, $password)){
			//Check if the account is activated
			if($mysql->verify_active($is_member)){
				$_SESSION['status'] = 'authorized';
				$_SESSION['user_id'] = preg_replace( "/[^0-9]+/", "", $mysql->get_user_id($is_member) );
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$user_browser = $_SERVER['HTTP_USER_AGENT'];
				$_SESSION['login_string'] = hash('sha512', $hashed_password . $ip_address . $user_browser);
				header("location: " . SITE_URL . "/cabinet"); 
				exit();
			} else {
				return "Пожалуйста зайдите в свой электронный почтовый ящик и активируйте свой личный кабинет";
			}
		
		} else {
			$now = time();
			if( $mysql->login_attempt( $mysql->get_user_id($is_member), $now) ){
				return "Неверный email или пароль";
			}	
		}	
	}
	
	//This function logs out the member
	public function log_member_out(){
		if(isset($_SESSION['status'])) {
			$_SESSION = array();
			$params = session_get_cookie_params();
			//Delete the actual cookie.
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
			//Destroy session
			session_destroy();
		}
	}
	
	//This function confirmes that the member is authorized
	public function confirm_member(){
		if(isset($_SESSION['status'], $_SESSION['user_id'], $_SESSION['login_string'])){
			$user_id = $_SESSION['user_id'];
			$status = $_SESSION['status'];
			$login_string = $_SESSION['login_string'];
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			$mysql = New Mysql();
			$password = $mysql->get_password_by_id($user_id);
			if( $password != "" ){
				$login_check = hash('sha512', $password . $ip_address . $user_browser);
				if($login_check == $login_string && $status == 'authorized'){
					return $user_id;
				}
			} else {
				return false;
			}
		} else {
			echo("Variables are not set");
			return false;
		}
	}
	
	//This function checks if there were more than 5 
	//login attempts per minute 
	public function checkbrute($user_id, $attempts_num, $time_lapse){
		$now = time();
		$valid_attempts = $now - $time_lapse;
		$mysql = new Mysql();
		return ($mysql->check_login_attempts($user_id, $valid_attempts) > $attempts_num);
	}
	
	private function unique_salt(){
		return substr(sha1(mt_rand()), 0, 22);
	}
	
	public function hash($password){
		return crypt($password, $this->algo . $this->cost . '$' . $this->unique_salt());
	}
	
	public function check_password($hash, $password){
		$full_salt = substr($hash, 0, 29);
		$new_hash = crypt($password, $full_salt);
		return ($hash == $new_hash);
	}
	
	public function sec_session_start(){
		$session_name = 'immistudy_login_session'; // Set a custom session name
		$secure = false; // Set to true if using https.
		$httponly = true; // This stops javascript being able to access the session id. 
		 
		ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
		$cookieParams = session_get_cookie_params(); // Gets current cookies params.
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
		session_name($session_name); // Sets the session name to the one set above.
		session_start(); // Start the php session
		//session_regenerate_id(true); // regenerated the session, delete the old one. 
	}
		
	//This function sends an email with the link for the 
	//change password page and updates the activation code
	public function make_new_password($member_email){
		$mysql = new Mysql();
		$newCode = $this->make_activation_code();
		if($this->utility_email( $this->get_newpass_msg($newCode , $member_email ), $member_email, "Смена пароля" ) ){
			return($mysql->update_activation_code($member_email, $newCode)); 	
		} 
		
	}
	//This function sends an email with the information 
	//about a password and email
	public function change_password_confirmation_mail($email){
		$mysql = new Mysql();
		$row = $mysql->get_member_by_email($email);
		$id = $mysql->get_user_id($row);
		$member_fullname = $mysql->get_user_name_lastname($row);
		$msg = "
		Информационное сообщение сайта immistudy.ru - Иммиграция и обучение
		------------------------------------------
		" . $member_fullname . ",
		
		Ваш пароль успешно изменен.
		
		Ваша регистрационная информация:
		
		ID пользователя: " . $id  ." 
		Статус: активен
		Login: " . $email . "
		
		Сообщение сгенерировано автоматически.";
		
		return $this->utility_email($msg, $email, "Ваш пароль успешно изменен");
	}
	
	//This function sends the message that notifies the user
	//that his/her application is received
	public function application_message($id, $email){
		$msg = "Информационное сообщение сайта immistudy.ru - Иммиграция и обучение
		------------------------------------------
		
		Вы успешно отправили анкету и мы получили всю необходимую информацию. Спасибо вам за то что вы выбрали нас.
		
		Ваша регистрационная информация:
		
		ID пользователя: " . $id  ." 
		Статус: активен
		Login: " . $email . "
		
		Сообщение сгенерировано автоматически.";
		
		return $this->utility_email($msg, $email, "Ваша анкета получена");
	}
	
	//This function makes an activation code
	public function make_activation_code(){
		$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		 return substr(str_shuffle($alphanum), 0, 7);
	}
	
	//This function makes an activation message
	public function get_activation_msg($activation){
		return "Информационное сообщение сайта immistudy.ru - Иммиграция и обучение
		------------------------------------------
		
		Спасибо вам за то что вы зарегистрировались на нашем сайте. 

		Пожалуйста пройдите по данной ссылке чтобы активировать свой личный кабинет.
		
		http://immistudy.ru/activate/?code=".$activation."
		
		Сообщение сгенерировано автоматически.";
	}
	
	//This function makes a new password message
	public function get_newpass_msg($activation, $member_email){
		return "Информационное сообщение сайта immistudy.ru - Иммиграция и обучение
		------------------------------------------
		
		Здравствуйте! 

		Пожалуйста пройдите по данной ссылке чтобы изменить пароль к вашему личному кабинету.
		
		http://immistudy.ru/new_password/?CODE=" . $activation . "&USER_LOGIN=" . urlencode($member_email) . "
		
		Сообщение сгенерировано автоматически.";
	}
	
	
	//This function verifies and updates the activation code
	public function verify_actcode($member_email, $code){
		//$newCode = $this->make_activation_code();
		$mysql = New Mysql();
		return($mysql->update_activation_code($member_email, $code));
	}
	
	//Send the activation email with the code
	public function send_email($msg){
		//echo "Email that was sent is";
		//echo $msg;
		return $this->send_mime_mail("immistudy.ru", 
						"immistudy@mailru",
						$this->data['name'],
						$this->data['email'],
						'UTF-8',
						'windows-1251',
						"Активируйте Личный Кабинет",
						$msg);
	}
	
	public function utility_email($msg, $member_email, $subject){
		//echo "Email that was sent is";
		//echo $msg;
		return $this->send_mime_mail("immistudy.ru", 
						"immistudy@mailru",
						"",
						$member_email,
						'UTF-8',
						'windows-1251',
						$subject,
						$msg);
	}

	function send_mime_mail($name_from, /* имя отправителя */
                        $email_from, /*  email отправителя */
                        $name_to, /*  имя получателя */
                        $email_to, /*  email получателя */
                        $data_charset, /* кодировка переданных данных */
                        $send_charset, /* кодировка письма */
                        $subject, /* тема письма */
                        $body, /* текст письма */
                        $html = FALSE, /* письмо в виде html или обычного текста */
                        $reply_to = FALSE
                        ) {
  		$to = $this->mime_header_encode($name_to, $data_charset, $send_charset)
                 . ' <' . $email_to . '>';
  		$subject = $this->mime_header_encode($subject, $data_charset, $send_charset);
  		$from =  $this->mime_header_encode($name_from, $data_charset, $send_charset)
                     .' <' . $email_from . '>';
  		if($data_charset != $send_charset) {
   			$body = iconv($data_charset, $send_charset, $body);
  		}
  		$headers = "From: $from\r\n";
  		$type = ($html) ? 'html' : 'plain';
  		$headers .= "Content-type: text/$type; charset=$send_charset\r\n";
  		$headers .= "Mime-Version: 1.0\r\n";
  		$headers .="Content-Transfer-Encoding: 8bit";
  		if ($reply_to) {
      		$headers .= "Reply-To: $reply_to";
  		}
  		return mail($to, $subject, $body, $headers);
	}

	function mime_header_encode($str, $data_charset, $send_charset) {
  		if($data_charset != $send_charset) {
    		$str = iconv($data_charset, $send_charset, $str);
  		}
 		return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
	}

}