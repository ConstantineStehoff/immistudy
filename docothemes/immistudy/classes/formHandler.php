<?php
class FormHandler {
	
	public function validEmail($email){
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
		
	public function validString($string){
		return preg_replace("/^[а-яА-ЯёЁa-zA-Z0-9]+$/", "", $string);
	}
}	