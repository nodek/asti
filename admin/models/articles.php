<?php
/**
 * ASTI
 * 
 * @author Eselbaev Asyllan
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

if(isset($_POST['submit_cr']) && !empty($_POST['article_title']) && !empty($_POST['article_text']))  //Запись в БД
	{
	if(strlen($_POST['article_title']) <= 180)
		{
		if(preg_match('/^[а-яa-z\s]+$/iu', $_POST['article_category']) || empty($_POST['article_category']))
			{
			if(isset($_POST['article_key']) && !empty($_POST['article_key']))
				{
				$key = $_POST['article_key'];
				$c_key = $this->s_key($key);
				}
			else
				$c_key = "";
			if(isset($_POST['article_descr']) && !empty($_POST['article_descr']))
				{
				$descr = $_POST['article_descr'];
				$c_descr = $this->s_title($descr);
				}
			else
				$c_descr = "";
			$c_text = base64_encode($_POST['article_text']);
			$title = $_POST['article_title'];
			$c_title = $this->s_title($title);
			$category = $_POST['article_category'];
			$c_category = $this->s_name($category);
			mysql_query("INSERT INTO `articles`(`article_title`, `article_text`, `article_category`, `article_descr`, `article_key`) 
						VALUES ('$c_title', '$c_text', '$c_category', '$c_descr', '$c_key')") or die(mysql_error());
			echo "<p class='p-signin'>Материал успешно добавлен</p><br><br>";
			}
		else
			echo "Имя категории может состоять только из букв";
		}
	else
		echo "Заголовок не должен превышать 180 символов";
	}
		
if(isset($_POST['ed_article']) and !empty($_POST['ID']))				// Редактирование материала
	{
	$ID = $_POST['ID'];
	$ID = (int) $ID;
	$query = mysql_query("SELECT `article_title`, `article_text`, `article_category`, `article_id`, `article_descr`, `article_key` FROM `articles` WHERE `article_id`=$ID") or die(mysql_error());
	while ($result = mysql_fetch_array($query))
		{
		$article_descr_ed = $result['article_descr'];
		$article_key_ed = $result['article_key'];
		$article_title_ed = htmlspecialchars(stripslashes($result['article_title']));
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
	if(strlen($_POST['article_title_ed']) <= 180)
		{
		if(preg_match('/^[а-яa-z\s]+$/iu', $_POST['article_category'])  || $_POST['article_category'] == "")
			{
			if(isset($_POST['article_key_ed']) && !empty($_POST['article_key_ed']))
				{
				$key = $_POST['article_key_ed'];
				$key_ed = $this->s_key($key);
				}
			else
				$key_ed = "";
			if(isset($_POST['article_descr_ed']) && !empty($_POST['article_descr_ed']))
				{
				$descr = $_POST['article_descr_ed'];
				$descr_ed = $this->s_title($descr);
				}
			else
				$descr_ed = "";
			$cat = $_POST['article_category'];
			$cat_ed = $this->s_name($cat);
			$title = $_POST['article_title_ed'];
			$title_ed = $this->s_title($title);
			$text_ed = base64_encode($_POST['article_text_ed']);
			$id_ed = $_POST['article_id_ed'];
			$id_ed = (int) $id_ed;
			mysql_query("UPDATE `articles` SET `article_title`='$title_ed', `article_text`='$text_ed', `article_category`='$cat_ed', `article_descr`='$descr_ed', `article_key`='$key_ed' where `article_id`='$id_ed'") or die(mysql_error());
			echo "<p class='p-signin'>Редактирование успешно завершено</p><br><br>";
			}
		else
			echo "Имя категории может состоять только из букв";
		}
	else
		echo "Заголовок не должен превышать 180 символов";
	}
	
if(isset($_POST['delete']) and !empty($_POST['del_id']))						// Удалить материал
	{
	$del_id = $_POST['del_id'];
	$del_id = (int) $del_id;
	$sql = mysql_query("DELETE FROM `articles` WHERE `article_id`='$del_id'") or die(mysql_error());
	}

$category_filter = " ";
require_once('views/articles/filter_article.php');						//Фильтр

if(isset($_POST['filter']) && isset($_POST['article_category']) && preg_match('/^[а-яa-z\s]+$/iu', $_POST['article_category']) && !empty($_POST['article_category']))
	{
	$category = $_POST['article_category'];
	$category_f = $this->s_name($category);
	$query = mysql_query("SELECT * FROM `articles` WHERE `article_category` = '$category_f'") or die(mysql_error());	
	}
else
	$query = mysql_query("SELECT * FROM `articles`") or die(mysql_error());

echo "<table class='table table-bordered'><tr><td>ID</td><td>Заголовок</td><td>Категория</td><td>Дата публикации</td><td></td></tr>";			// Отображаем материалы
while ($result = mysql_fetch_array($query))
	{
	$del_id = $result['article_id'];
	echo "<tr>";
	echo "<td>";
	echo $result['article_id'];
	echo "</td>";
	echo "<td>";
	echo $result['article_title'];
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
	if(preg_match('/^[а-яa-z\s]+$/iu', $article_category_ed) || $article_category_ed == "")
		{
		$article_category = $article_category_ed;
		$find = mysql_query("SELECT COUNT(`article_category`) FROM `category`") or die(mysql_error());
		echo "<select class='form-control' name='article_category'>";
		if(mysql_result($find, 0) == 0)
			echo "<option value=''></option>";
		else
			{
			$query = mysql_query("SELECT `article_category` FROM `category`") or die(mysql_error());
			while ($result = mysql_fetch_array($query))
				{
				$cat = $result['article_category'];
				if($cat == $article_category)
					echo "<option selected='$cat' value='$cat'>$cat</option>";
				else
					echo "<option value='$cat'>$cat</option>";
				}
			}
		echo "</select>";
		}
	else
		echo "Имя категории может состоять только из букв";
	}
?>