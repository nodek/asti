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
		$dir = "../";
		require_once('../components/user/user.php');
		$user = new user;
		$user->start($dir);
		if($user->logged() == true)
			require_once('views/index.php');
		else
			require_once('views/user/login.php');
		}

	function content()                             
		{
		if(isset($_GET['menu_category']))			// Категории
			require_once('models/category.php');
		if(isset($_GET['menu_elfinder']))			// Файловый менеджер
			echo "<link rel='stylesheet' type='text/css' media='screen' href='views/css/elfinder.css'>
			<iframe class='elfinder' src='../modules/elfinder/elfinder.php' width='100%' height='100%' align='center'></iframe>";
		
		if(isset($_GET['menu_articles']))			// Статьи
			require_once('models/articles.php');
			
		if(isset($_GET['menu_about']))				// О CMS
			require_once('views/about.php');
		
		if(empty($_GET))						// Главная страница
			require_once('views/home.php');
		
		if(isset($_GET['menu_settings']))
			require_once('models/settings.php');	//Настройки
		}

	function __destruct()
		{
		mysql_close();
		}
	}
?>