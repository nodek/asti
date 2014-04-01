<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

defined('_Asti') or die;
 
require_once('../config/database.php');

class admin
	{
	function __construct()
		{
		// Соединение с сервером БД
		mysql_connect(mysql_host, mysql_login, mysql_pass) or die ("Ошибка соединения: ". mysql_error());
		// Установка кодировки
		mysql_query("set names utf8") or die ("Ошибка в запросе: " . mysql_error());
		// Выбрать БД
		mysql_select_db(mysql_database) or die("Ошибка подключения к БД: ". mysql_error());
		}
	function start()							// Проверяем авторизован ли пользователь
		{
		require_once('models/auth.php');
		}

	function content()                             
		{
		if(isset($_GET['articles']))			// Статьи
			{
			require_once('models/articles.php');
			}
		if(isset($_GET['about']))				// О CMS
			require_once('views/about.php');
		
		if(empty($_GET))						// Главная страница
			require_once('views/home.php');
		if(isset($_GET['settings']))
			require_once('views/settings.php');	//Настройки
		}
	function category()
		{
		$query = mysql_query("SELECT article_category FROM category") or die(mysql_error());
		echo "<select class='form-control' name='article_category'>";
		while ($result = mysql_fetch_array($query))
			{
			$cat = $result['article_category'];
			echo "<option value='$cat'>$cat</option>";
			}
		echo "</select>";
		}
	}
if(isset($_GET['exit']))						// Выход
	{
	setcookie('id', '', time() - 60*60*24*30);
	setcookie('hash', '', time() - 60*60*24*30);
	header('Location: login.php'); exit();
	} 
?>