<!DOCTYPE html>
<!--
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
-->

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Регистрация</title>
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../admin/views/css/signin.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<form class="form-signin" role="form" method="post">
			<h2 class="form-signin-heading">Регистрация</h2>
			<input type="text" name="user_login" class="form-control" placeholder="Логин" required autofocus><br>
			<input type="password" name="user_pass_new" class="form-control" placeholder="Пароль" required>
			<input type="password" name="user_pass_repeat" class="form-control" placeholder="Повторите пароль" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Зарегистрировать</button>
		</form>
	</div>

</body>
</html>
<?php

if(isset($_POST['register']))
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
		require_once('../config/database.php');
		// Соединение с сервером БД
		mysql_connect(mysql_host, mysql_login, mysql_pass) or die ("Ошибка соединения: ". mysql_error());
		// Установка кодировки
		mysql_query("set names utf8") or die ("Ошибка в запросе: " . mysql_error());
		// Выбрать БД
		mysql_select_db(mysql_database) or die("Ошибка подключения к БД: ". mysql_error());
		
		$login = $_POST['user_login'];
		$user_password = $_POST['user_pass_new'];
		$login1 = strip_tags(preg_replace('/[\#\/\'\%\`\&\,\.\"\?\@]/','',$login));
		if(get_magic_quotes_gpc() == 1)
			$login2 = stripslashes($login1);
		else
			$login2 = $login1;
		$user_login = mysql_real_escape_string($login2);
		
		if (version_compare(PHP_VERSION, '5.5', '>='))
			{
			$options = array(
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
			'cost' => 12 
			);
			$user_pass_hash = password_hash($user_password, PASSWORD_BCRYPT, $options);
			echo 'Моя версия: ' . PHP_VERSION . "\n";
			}
		else
			{
			$salt = '$2a$10$'.substr(str_replace('+', '.', base64_encode(pack('N4', mt_rand(), mt_rand(), mt_rand(),mt_rand()))), 0, 22) . '$';
			$user_pass_hash = CRYPT($user_password, $salt);
			}
	
		$find_user = mysql_query("SELECT COUNT(user_id) FROM `users` WHERE `user_login` = '$user_login';");
		if(mysql_result($find_user, 0) > 0)
			echo "Пользователь с таким логином уже существует в базе данных";
		else
			{
			if(mysql_query("INSERT INTO `users` (`user_login`, `user_password`, `user_role`) VALUES('$user_login', '$user_pass_hash', 'admin');"))
				echo "Учетная запись $user_login успешно добавлена в базу данных";
			else
				echo "Не удалось создать учетную запись";
			}
		}

}
?>