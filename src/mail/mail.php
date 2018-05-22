
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

$phone = trim($_POST["user_phone"]);

$body = "Заявка на обратный звонок на номер: ".$phone;

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

mail($admin_email, adopt($project_name), $body);

/**
 * change
 */