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

	function s_name($name)
		{
		$name1 = strip_tags(preg_replace('/[\#\/\'\%\`\&\,\.\"\?\@]/','',$name));
		if(get_magic_quotes_gpc() == 1)
			$name2 = stripslashes($name1);
		else
			$name2 = $name1;

		$s_name = mysql_real_escape_string($name2);
		return $s_name;
		}
		
	function s_title($title)
		{
		$title1 = strip_tags(preg_replace('/[\#\/\'\%\`\&]/','',$title));
		if(get_magic_quotes_gpc() == 1)
			$title2 = stripslashes($title1);
		else
			$title2 = $title1;

		$s_title = mysql_real_escape_string($title2);
		return $s_title;
		}

	function __destruct()
		{
		mysql_close();
		}
	}
?>