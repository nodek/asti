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

require_once('views/articles/articles.php');					// Отображаем views/articles.php

if(isset($_POST['cr_article']))						// Создать материал
	{
	$article_category_ed = "";
	require_once('views/articles/cr_article.php');
	}

if(!empty($_POST['article_title']) or !empty($_POST['article_text']))  //Запись в БД
	{
	if(preg_match('/^[а-яa-z]+$/iu', $_POST['article_category']) || $_POST['article_category'] == "")
		{
		$a_text = base64_encode($_POST['article_text']);
		$a_title = base64_encode(strip_tags($_POST['article_title']));
		$a_category = $_POST['article_category'];
		mysql_query("INSERT INTO `articles`(`article_title`, `article_text`, `article_category`) VALUES ('$a_title', '$a_text', '$a_category')") or die(mysql_error());
		echo "<p class='p-signin'>Материал успешно добавлен</p><br><br>";
		}
	else
		echo "Имя категории может состоять только из букв";
	}
		
if(isset($_POST['ed_article']) and !empty($_POST['ID']))				// Редактирование материала
	{
	$ID = $_POST['ID'];
	$ID = (int) $ID;
	$query = mysql_query("SELECT `article_title`, `article_text`, `article_category`, `article_id` FROM `articles` WHERE `article_id`=$ID") or die(mysql_error());
	while ($result = mysql_fetch_array($query))
		{
		$article_title_ed = stripslashes(htmlspecialchars(base64_decode($result['article_title'])));
		$article_text_ed = stripslashes(base64_decode($result['article_text']));
		$article_category_ed = $result['article_category'];
		$article_id_ed = $result['article_id'];
		}
	if(empty($article_id_ed))
		echo "Нет материала с таким ID<br><br>"; 
	else 
		require_once('views/articles/ed_article.php');
	}
if(isset($_POST['submit_ed']) && isset($_POST['article_title_ed']) && isset($_POST['article_text_ed']) && isset($_POST['article_category']))			// Запись в БД
	{
	if(preg_match('/^[а-яa-z]+$/iu', $_POST['article_category'])  || $_POST['article_category'] == "")
		{
		$cat = $_POST['article_category'];
		$titl_ed = base64_encode(strip_tags($_POST['article_title_ed']));
		$text_ed = base64_encode($_POST['article_text_ed']);
		$id_ed = $_POST['article_id_ed'];
		$id_ed = (int) $id_ed;
		mysql_query("UPDATE `articles` SET `article_title`='$titl_ed', `article_text`='$text_ed', `article_category`='$cat' where `article_id`='$id_ed'") or die(mysql_error());
		echo "<p class='p-signin'>Редактирование успешно завершено</p><br><br>";
		}
	else
		echo "Имя категории может состоять только из букв";
	}
	
if(isset($_POST['delete']) and !empty($_POST['del_id']))
	{
	$del_id = $_POST['del_id'];
	$del_id = (int) $del_id;
	$sql = mysql_query("DELETE FROM `articles` WHERE `article_id`='$del_id'") or die(mysql_error());
	}
	
$query = mysql_query("SELECT * FROM `articles`") or die(mysql_error());			// Отображаем все материалы
echo "<table class='table table-bordered'><tr><td>ID</td><td>Заголовок</td><td>Категория</td><td>Дата публикации</td><td></td></tr>";
while ($result = mysql_fetch_array($query))
	{
	$del_id = $result['article_id'];
	echo "<tr>";
	echo "<td>";
	echo $result['article_id'];
	echo "</td>";
	echo "<td>";
	echo base64_decode($result['article_title']);
	echo "</td>";
	echo "<td>";
	echo $result['article_category'];
	echo "</td>";
	echo "<td>";
	echo $result['article_date'];
	echo "</td>";
	echo "<td>";
	require "views/delete.php";
	echo "</td>";
	echo "</tr>";
	}
echo "</table>";

function category($article_category_ed)			// Отображаем категории
	{
	if(preg_match('/^[а-яa-z]+$/iu', $article_category_ed) || $article_category_ed == "")
		{
		$article_category = $article_category_ed;
		$query = mysql_query("SELECT `article_category` FROM `category`") or die(mysql_error());
		echo "<select class='form-control' name='article_category'>";
		while ($result = mysql_fetch_array($query))
			{
			$cat = $result['article_category'];
			if($cat == $article_category)
				echo "<option selected='$cat' value='$cat'>$cat</option>";
			else
				echo "<option value='$cat'>$cat</option>";
			}
		echo "</select>";
		}
	else
		echo "Имя категории может состоять только из букв";
	}
?>