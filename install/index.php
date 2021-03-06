﻿<?php
/**
 * ASTI
 * 
 * @author Eselbaev Asyllan
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Установка и настройка</title>

<!-- Редактирование файла database.php -->

<form action='' method='post'>
	<input type='text' name='login' placeholder="Логин" />
	<input type='password' name='pass'  placeholder="Пароль" />
	<input type='text' name='host' placeholder="Хост" />
	<input type='text' name='database' placeholder="Имя базы данных" />
	<input type='submit' value='Сохранить' name='submit'/>
</form>

<?php
if(!empty($_POST['login']) && isset($_POST['pass']) && !empty($_POST['host']) && !empty($_POST['database']))
	{
	$login=$_POST['login'];
	$pass=$_POST['pass'];
	$host=$_POST['host'];
	$database=$_POST['database'];
	
	$d="<?php

define('mysql_login', \"$login\");			// Логин для доступа к серверу БД
define('mysql_pass', \"$pass\");			// Пароль
define('mysql_host', \"$host\");			// Хост
define('mysql_database', \"$database\");	// Имя БД

?>";
	file_put_contents("../config/database.php",$d);			//Запись конф файла
	echo "Настройки успешно сохранены <br><br>";
	}

?>  

<!-- Создание таблицы articles  и users -->

<form method = "post">
	<input type='submit' value='Создать таблицы в базе данных' name='create_db'/>
</form> 
</html>

<?php 
if(isset($_POST['create_db'])) 
	{
require_once("../config/database.php");
	
	if(!mysql_connect(mysql_host, mysql_login, mysql_pass))		// Подключаемся к MySQL
		{
		die('Не удалось подключиться: ' . mysql_error());
		}
	else 
		{

		if(!mysql_select_db(mysql_database))				// Подключаемся к БД
			{
			die('База данных не найдена: ' . mysql_error());
			}
		else
			{ 												// Создаем таблицы
			mysql_query('SET NAMES utf8');                                
			mysql_query('CREATE TABLE IF NOT EXISTS articles(
							article_id INT(11) not null auto_increment primary key,
							article_title VARCHAR(200) not null,
							article_text LONGTEXT not null,
							article_date TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
							article_category CHAR(30),
							article_descr VARCHAR(120),
							article_key VARCHAR(120)
							)')  or die ("<br>Таблица не создана: " . mysql_error());
			mysql_query('CREATE TABLE IF NOT EXISTS users(
							user_id INT(11) UNSIGNED not null auto_increment primary key,
							user_login CHAR(20) not null,
							user_password VARCHAR(100) not null,
							user_role CHAR(20),
							user_name CHAR(30),
							user_surname CHAR(30),
							user_gender CHAR(10),
							user_birthday DATETIME,
							user_email CHAR(30)
							)')  or die ("<br>Таблица не создана: " . mysql_error()); 
			mysql_query('CREATE TABLE IF NOT EXISTS category(
							category_id INT(11) not null auto_increment primary key,
							article_category CHAR(30) not null
							)')  or die ("<br>Таблица не создана: " . mysql_error());
			echo "Таблицы успешно созданы!";
			echo "<br><br><form action='register.php' method= 'post'>
					<input type='submit' name='admin' value='Зарегистрировать администратора'/>
					</form>";
			}
		}

	}
else
	echo "Создайте таблицы для продолжения"; 
?>