<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

require_once(BASEPATH .'/config/database.php');

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
	function start()                                 // Проверяем авторизован ли пользователь
		{
		if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
			{    
			$userdata = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE users_id = '".intval($_COOKIE['id'])."' LIMIT 1"));

			if(($userdata['users_hash'] !== $_COOKIE['hash']) or ($userdata['users_id'] !== $_COOKIE['id']))            // Проверяем куки
				{
				setcookie('id', '', time() - 60*24*30*12, '/');
				setcookie('hash', '', time() - 60*24*30*12, '/');
				setcookie('errors', '0', time() + 60*24*30*12, '/');
				header('Location: login.php'); exit();
				}
			}
		else
			{
			  header('Location: login.php'); exit();
			}

		require_once "views/index.php";             // если авторизован то загружаем views/index.php

		}
	function articles()
		{
		echo "Статьи";
		}
	function content()                             
		{
		if(empty($_GET) or isset($_GET['articles']))       // Если нет GET запроса, либо есть запрос с именем articles то:
			{
			require_once("views/articles.php");           // Подгружаем views/articles.php
			if(isset($_POST['cr_article']))              // Создать статью
				require_once("views/cr_article.php");
				if(!empty($_POST['article_title']) or !empty($_POST['article_text']))
					{
					$a_text = $_POST['article_text'];
					$a_title = $_POST['article_title'];
					mysql_query("INSERT INTO `articles`(`article_title`, `article_text`) VALUES ('$a_title', '$a_text')") or die(mysql_error());
					echo "<p class='p-signin'>Статья успешно добавлена</p><br><br>";
					}
					
			if(isset($_POST['ed_article']) and !empty($_POST['ID']))        // Редактирование статьи
				{
				$ID = $_POST['ID'];
				$query = mysql_query("SELECT article_title, article_text, article_id FROM articles WHERE article_id=$ID") or die(mysql_error());
				while ($result = mysql_fetch_array($query))
					{
					$article_title_ed = $result['article_title'];
					$article_text_ed = $result['article_text'];
					$article_id_ed = $result['article_id'];
					}
				if(empty($article_title_ed) and empty($article_text_ed))
					echo "Нет статьи с таким ID<br><br>"; 
				else require_once("views/ed_article.php");
				}
			if(isset($_POST['submit_ed']))
				{
				$titl_ed = $_POST['article_title_ed'];
				$text_ed = $_POST['article_text_ed'];
				$id_ed = $_POST['article_id_ed'];
				$this->ed_article($id_ed, $titl_ed, $text_ed);
				}
			
			$query = mysql_query("SELECT * FROM articles") or die(mysql_error());           // Отображаем все статьи
			echo "<table class='table table-bordered'><tr><td>ID</td><td>Заголовок</td><td>Дата публикации</td></tr>";
			while ($result = mysql_fetch_array($query))
				{
				echo "<tr>";
				echo "<td>";
				echo $result['article_id'];
				echo "</td>";
				echo "<td>";
				echo $result['article_title'];
				echo "</td>";
				echo "<td>";
				echo $result['article_date'];
				echo "</td>";
				echo "</tr>";
				}
			echo "</table>";
			}
		if(isset($_GET['about']))                        // Отправлен GET запрос с именем about
			require_once("views/about.php");
		}
	function ed_article($id_ed, $titl_ed, $text_ed)
		{
		mysql_query("UPDATE articles SET article_title='$titl_ed', article_text='$text_ed' where article_id='$id_ed'") or die(mysql_error());
		}
	
	}
if(isset($_GET['exit']))                // Выход
	{
	setcookie('id', '', time() - 60*60*24*30, '/');
	setcookie('hash', '', time() - 60*60*24*30, '/');
	header('Location: login.php'); exit();
	} 
?>