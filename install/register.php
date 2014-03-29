<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

?>
<form method="POST" action="">Логин
	<input type="text" name="login" id="reg_inp" /><br />Пароль
	<input type="password" name="password" id="reg_inp" /><br />
<input name="register" type="submit" value="Зарегистрировать">
</form>
<?php
require_once('../config/database.php');

mysql_connect(mysql_host, mysql_login, mysql_pass) or die ("Ошибка соединения: ". mysql_error());
// Установка кодировки
mysql_query("set names utf8") or die ("Ошибка в запросе: " . mysql_error());
// Выбрать БД
mysql_select_db(mysql_database) or die("Ошибка подключения к БД: ". mysql_error());

if(isset($_POST['register']))
	{
	$err = array();

	# проверям логин
	if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
		{
		$err[] = "Логин может состоять только из букв английского алфавита и цифр";
		}
	 
	if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
		{
		$err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
		}
	 
	# проверяем, не сущестует ли пользователя с таким именем
	$query = mysql_query("SELECT COUNT(users_id) FROM users WHERE users_login='".mysql_real_escape_string($_POST['login'])."'") or die ("<br>Invalid query: " . mysql_error());
	if(mysql_result($query, 0) > 0)
		{
		$err[] = "Пользователь с таким логином уже существует в базе данных";
		}
	  
	# Если нет ошибок, то добавляем в БД нового пользователя
	if(count($err) == 0)
		{
		$login = $_POST['login'];
		 
	# Убераем лишние пробелы и делаем двойное шифрование
		$password = md5(md5(trim($_POST['password'])));
		 
		mysql_query("INSERT INTO users SET users_login='".$login."', users_password='".$password."'");
		echo "Администратор $login успешно зарегистрирован в системе<br>Удалите папку install";
		}
	else 
		{
		print "<b>При регистрации произошли следующие ошибки:</b><br>";
		foreach($err AS $error)
			{
			print $error."<br>";
			} 
		}
	}
?>
