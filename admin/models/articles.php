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

require_once('views/articles.php');					// Отображаем views/articles.php

if(isset($_POST['cr_article']))						// Создать материал
	require_once('views/cr_article.php');

if(!empty($_POST['article_title']) or !empty($_POST['article_text']))  //Запись в БД
	{
	$a_text = mysql_real_escape_string($_POST['article_text']);
	$a_title = mysql_real_escape_string($_POST['article_title']);
	$a_category = mysql_real_escape_string($_POST['article_category']);
	mysql_query("INSERT INTO articles(article_title, article_text, article_category) VALUES ('$a_title', '$a_text', '$a_category')") or die(mysql_error());
	echo "<p class='p-signin'>Материал успешно добавлен</p><br><br>";
	}
		
if(isset($_POST['ed_article']) and !empty($_POST['ID']))				// Редактирование материала
	{
	$ID = $_POST['ID'];
	$query = mysql_query("SELECT article_title, article_text FROM articles WHERE article_id=$ID") or die(mysql_error());
	while ($result = mysql_fetch_array($query))
		{
		$article_title_ed = $result['article_title'];
		$article_text_ed = $result['article_text'];
		}
	if(empty($article_title_ed) and empty($article_text_ed))
		echo "Нет материала с таким ID<br><br>"; 
	else 
		require_once('views/ed_article.php');
	}
if(isset($_POST['submit_ed']) && isset($_POST['article_title_ed']) && isset($_POST['article_text_ed']) && isset($_POST['article_category']))			// Запись в БД
	{
	$cat = mysql_real_escape_string($_POST['article_category']);
	$titl_ed = mysql_real_escape_string($_POST['article_title_ed']);
	$text_ed = mysql_real_escape_string($_POST['article_text_ed']);
	$id_ed = mysql_real_escape_string($_POST['article_id_ed']);
	mysql_query("UPDATE articles SET article_title='$titl_ed', article_text='$text_ed', article_category='$cat' where article_id='$id_ed'") or die(mysql_error());
	echo "<p class='p-signin'>Редактирование успешно завершено</p><br><br>";
	}
	
if(isset($_POST['delete']) and !empty($_POST['del_id']))
	{
	$del_id = mysql_real_escape_string($_POST['del_id']);
	$sql = mysql_query("DELETE FROM articles WHERE article_id='$del_id'") or die(mysql_error());
	}
	
$query = mysql_query("SELECT * FROM articles") or die(mysql_error());			// Отображаем все материалы
echo "<table class='table table-bordered'><tr><td>ID</td><td>Заголовок</td><td>Категория</td><td>Дата публикации</td><td></td></tr>";
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

?>