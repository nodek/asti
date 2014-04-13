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
		require_once('user.php');
		$user = new user;
		$user->start();
		if($user->logged() == true)
			require_once('views/index.php');
		else
			require_once('views/user/login.php');
		}

	function content()                             
		{
		if(isset($_GET['menu']) && $_GET['menu'] == 'category')			// Категории
			require_once('models/category.php');
		if(isset($_GET['menu']) && $_GET['menu'] == 'elfinder')			// Файловый менеджер
			echo "<link rel='stylesheet' type='text/css' media='screen' href='views/css/elfinder.css'>
			<iframe class='elfinder' src='../modules/elfinder/elfinder.php' width='100%' height='100%' align='center'></iframe>";
		
		if(isset($_GET['menu']) && $_GET['menu'] == 'articles')			// Статьи
			require_once('models/articles.php');
			
		if(isset($_GET['menu']) && $_GET['menu'] == 'about')				// О CMS
			require_once('views/about/about.php');
		
		if(empty($_GET))						// Главная страница
			require_once('views/home.php');
		
		if(isset($_GET['menu']) && $_GET['menu'] == 'settings')
			require_once('models/settings.php');	//Настройки
		}

	function __destruct()
		{
		mysql_close();
		}
	}
?>