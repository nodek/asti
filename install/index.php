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
	$line['login']="3";
	$line['pass']="4";
	$line['host']="5";
	$line['database']="6"; 
		
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
	file_put_contents("../config/database.php",$d);
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
			{ 												// Создаем 2 таблицы
			mysql_query('SET NAMES utf8');                                
			mysql_query('CREATE TABLE IF NOT EXISTS articles(
							article_id INTEGER not null auto_increment primary key,
							article_title VARCHAR(120) not null,
							article_text LONGTEXT not null,
							article_date TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
							article_category VARCHAR(30)
							)')  or die ("<br>Таблица не создана: " . mysql_error());
			mysql_query('CREATE TABLE IF NOT EXISTS users(
							users_id INT(11) UNSIGNED not null auto_increment primary key,
							users_login VARCHAR(20) not null,
							users_password VARCHAR(32) not null,
							users_hash VARCHAR(32) not null
							)')  or die ("<br>Таблица не создана: " . mysql_error()); 
			mysql_query('CREATE TABLE IF NOT EXISTS category(
							category_id INTEGER not null auto_increment primary key,
							article_category VARCHAR(30) not null
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