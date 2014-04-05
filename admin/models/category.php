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

require_once('views/category.php');					// Отображаем views/category.php

if(isset($_POST['cr_category']))						// Создать категорию
	require_once('views/cr_category.php');

if(!empty($_POST['category_name']))  //Запись в БД
	{
	$c_name = mysql_real_escape_string($_POST['category_name']);
	mysql_query("INSERT INTO category(article_category) VALUES ('$c_name')") or die(mysql_error());
	echo "<p class='p-signin'>Категория успешно добавлена</p><br><br>";
	}
		
if(isset($_POST['ed_category']) and !empty($_POST['ID_category']))				// Редактирование категории
	{
	$ID = mysql_real_escape_string($_POST['ID_category']);
	$query = mysql_query("SELECT article_category FROM category WHERE category_id=$ID") or die(mysql_error());
	while ($result = mysql_fetch_array($query))
		{
		$article_category_ed = $result['article_category'];
		}
	if(empty($article_category_ed))
		echo "Нет категории с таким ID<br><br>"; 
	else 
		require_once('views/ed_category.php');
	}
if(isset($_POST['category_id_ed']) && isset($_POST['category_name_ed']) && isset($_POST['submit_ed']))											// Запись в БД
	{
	$cat_ed = mysql_real_escape_string($_POST['category_name_ed']);
	$id_ed = mysql_real_escape_string($_POST['category_id_ed']);
	mysql_query("UPDATE category SET article_category='$cat_ed' where category_id='$id_ed'") or die(mysql_error());
	echo "<p class='p-signin'>Редактирование успешно завершено</p><br><br>";
	}

if(isset($_POST['delete']) and !empty($_POST['del_id']))
	{
	$del_id = mysql_real_escape_string($_POST['del_id']);
	$sql = mysql_query("DELETE FROM category WHERE category_id='$del_id'") or die(mysql_error());
	}
	
$query = mysql_query("SELECT * FROM category") or die(mysql_error());			// Отображаем все категории
echo "<table class='table table-bordered'><tr><td>ID</td><td>Категория</td><td></td></tr>";
while ($result = mysql_fetch_array($query))
	{
	$del_id = $result['category_id'];
	echo "<tr>";
	echo "<td>";
	echo $result['category_id'];
	echo "</td>";
	echo "<td>";
	echo $result['article_category'];
	echo "</td>";
	echo "<td>";
	require "views/delete.php";
	echo "</td>";
	echo "</tr>";
	}
echo "</table>";

?>