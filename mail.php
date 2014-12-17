<?php
/*
* Template Name: Send email from the msg box
*/

require_once(IMMISTUDY_DIR . '/classes/membership.php');
$new_letter = New Membership();

$user_email = $_POST['user_email'];
$user_note = $_POST['user_note'];
$msg= "Электронный адрес пользователя: " . $user_email . "\r\n" . "Сообщение: " . $user_note;
//mail("immistudy@mail.ru", "Сообщение с сайта immistudy.ru", $msg);
$new_letter->utility_email($msg, "immistudy@mail.ru", "Сообщение с сайта immistudy.ru");
