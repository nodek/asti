<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

define('_Asti', 1);

$error[0] = 'Включите куки';
$error[1] = 'Авторизуйтесь';

function generateCode($length=6)					# Функция для генерации случайной строки 
	{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	$clen = strlen($chars) - 1;  
	while (strlen($code) < $length) 
		{
		$code .= $chars[mt_rand(0,$clen)];  
		}
	return $code;
	}

if (isset($_COOKIE['errors']))			# Если есть куки с ошибкой то выводим их в переменную и удаляем куки
	{
	$errors = $_COOKIE['errors'];
	setcookie('errors', '', time() - 60*24*30*12, '/');
	}

  
require_once('controllers/admin.php');		# Подключаем контроллер
$login=new admin;
if(isset($_POST['submit']))
	{
	# Вытаскиваем из БД запись, у которой логин равняеться введенному
	$data = mysql_fetch_assoc(mysql_query("SELECT users_id, users_password FROM `users` WHERE `users_login`='".mysql_real_escape_string($_POST['login'])."' LIMIT 1"));

	if($data['users_password'] === md5(md5($_POST['password'])))		# Соавниваем пароли
		{
		$hash = md5(generateCode(10));			# Генерируем случайное число и шифруем его
		mysql_query("UPDATE users SET users_hash='".$hash."' WHERE users_id='".$data['users_id']."'") or die("MySQL Error: " . mysql_error());	# Записываем в БД новый хеш авторизации и IP
					# Ставим куки
		setcookie("id", $data['users_id'], time()+60*60*24*30);
		setcookie("hash", $hash, time()+60*60*24*30);

		header("Location: index.php"); exit();		# Переадресовываем браузер
		}
	else
		{
		print "<p class='p-signin'>Вы ввели неправильный логин/пароль</p>";
		}
	}
require_once('views/login.php'); 

# Проверяем наличие в куках номера ошибки
if (isset($errors))
	{
	print '<h4>'.$error[$errors].'</h4>';
	}

?>