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

<!-- Редактирование файла config.php -->

<form method='post'>
	<textarea name='config' cols='90' rows='10'><?PHP echo file_get_contents("../config/config.php","r");?></textarea>
	<input type='submit' value='Сохранить' name='submit'/></p>
</form>

<?php
	if(!empty($_POST['config']))
		{ 
		$b=$_POST['config'];
		file_put_contents("../config/config.php",$b);
		echo "<script language='JavaScript' type='text/javascript'>window.location.replace('install.php')</script>";
		}
?>				 

<!-- Редактирование файла database.php -->

<form action='' method='post'>
	<textarea name='database' cols='90' rows='10'><?PHP echo file_get_contents("../config/database.php","r");?></textarea>
	<input type='submit' value='Сохранить' name='submit'/>
</form>

<?php
	if(!empty($_POST['database']))
		{ 
		$d=$_POST['database'];
		file_put_contents("../config/database.php",$d);
		echo "<script language='JavaScript' type='text/javascript'>window.location.replace('install.php')</script>";
		}
?>

<!-- Создание базы данных и таблицы articles -->

<form method = "post">
	<input type='submit' value='Создать базу данных' name='create_db'/>
</form> 

<?php
require_once("../config/database.php");

	if(isset($_POST['create_db'])) 
		{
		if(!mysql_connect(mysql_host, mysql_login, mysql_pass))     // Подключаемся к MySQL
			{
			die('Не удалось подключиться: ' . mysql_error());
			}
		else 
			{
			if(!mysql_query("CREATE DATABASE IF NOT EXISTS asti DEFAULT CHARACTER SET utf8"))       // Создаем БД
				{
				die('Не удалось создать БД: ' . mysql_error());
				}
			else
				{
				if(!mysql_select_db(mysql_database))                           // Подключаемся к созданной БД
					{
					die('База данных не найдена: ' . mysql_error());
					}
				else
					{                                                          // Создаем 2 таблицы
					mysql_query('SET NAMES utf8');                                
					mysql_query('CREATE TABLE IF NOT EXISTS articles(
									article_id INTEGER not null auto_increment primary key,
									article_title VARCHAR(120) not null,
									article_text LONGTEXT not null,
									article_date TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
									category_id INTEGER
									)')  or die ("<br>Таблица не создана: " . mysql_error());
					mysql_query('CREATE TABLE IF NOT EXISTS users(
									users_id INT(11) UNSIGNED not null auto_increment primary key,
									users_login VARCHAR(20) not null,
									users_password VARCHAR(32) not null,
									users_hash VARCHAR(32) not null
									)')  or die ("<br>Таблица не создана: " . mysql_error()); 
					echo "База данных успешно создана!";
					echo "<br><br><form action='register.php' method= 'post'>
							<input type='submit' name='admin' value='Зарегистрировать администратора'/>
							</form>";
					}
				}
			}
	
		}
	else
		echo "Создайте базу данных для продолжения";
?>
                    
</html>