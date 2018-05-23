
<?php

/**
 * ssh valentina@karpov.today
 * 
 * cd source/project/public/lesson_2.22
 * 
 * git pull origin master
 */

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
	return http_response_code(404);
}
$project_name = 'Добрый картон';
$admin_email = 'valentinamaa@ya.ru';

$name = $_POST['user_name'];
$text = $_POST['user_text'];
$phone = trim($_POST['user_phone']);

$body = file_get_contents('./mail-template.html');
$body = str_replace('{{name}}', $name, $body);
$body = str_replace('{{comment}}', $text, $body);
$body = str_replace('{{phone}}', $phone, $body);

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($admin_email, adopt($project_name), $body, $headers);

/**
 * change
 */