﻿<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

defined('_Asti') or die;

class register
{
function reg_user()
	{
	if($_POST['user_pass_new'] !== $_POST['user_pass_repeat'])
		echo "Пароли не совпадают<br>";
	if(strlen($_POST['user_pass_new']) < 6)
		echo "Пароль должен состоять не менее чем из 6 символов<br>";
	if(!preg_match('/^[a-z\d]{4,20}$/i', $_POST['user_login']))
		echo "Логин может состоять: из латинских букв (от a до Z) и цифр, длиной от 4 до 20 символов";
	if(!empty($_POST['user_login'])
		&& strlen($_POST['user_login']) <= 20
		&& strlen($_POST['user_login']) >= 4
		&& strlen($_POST['user_pass_new']) >= 6
		&& preg_match('/^[a-z\d]{4,20}$/i', $_POST['user_login'])
		&& !empty($_POST['user_pass_new'])
		&& !empty($_POST['user_pass_repeat'])
		&& ($_POST['user_pass_new'] === $_POST['user_pass_repeat'])) 
		{
		
		$user_login = mysql_real_escape_string(strip_tags($_POST['user_login'], ENT_QUOTES));
		$user_password = $_POST['user_pass_new'];
		$salt = '$2a$10$'.substr(str_replace('+', '.', base64_encode(pack('N4', mt_rand(), mt_rand(), mt_rand(),mt_rand()))), 0, 22) . '$';
		$user_pass_hash = CRYPT($user_password, $salt);
		
		require_once('../config/database.php');
		// Соединение с сервером БД
		mysql_connect(mysql_host, mysql_login, mysql_pass) or die ("Ошибка соединения: ". mysql_error());
		// Установка кодировки
		mysql_query("set names utf8") or die ("Ошибка в запросе: " . mysql_error());
		// Выбрать БД
		mysql_select_db(mysql_database) or die("Ошибка подключения к БД: ". mysql_error());
		
		$find_user = mysql_query("SELECT COUNT(users_id) FROM `users` WHERE `users_login` = '$user_login';");
		if(mysql_result($find_user, 0) > 0)
			echo "Пользователь с таким логином уже существует в базе данных";
		else
			{
			if(mysql_query("INSERT INTO `users` (`users_login`, `users_password`) VALUES('$user_login', '$user_pass_hash');"))
				echo "Учетная запись успешно добавлена в базу данных";
			else
				echo "Не удалось создать учетную запись";
			}
		}
	}
}

?>