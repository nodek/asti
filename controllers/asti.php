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

require_once('config/config.php');       // Настройки сайта. Пока только путь к шаблону
require_once('config/database.php');     // Настройки БД

class asti
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

	function start()
		{
		require_once(template);     // Загружаем шаблон. Настраивается в config.php
		}

	function q_articles($ID)
		{
		$ID = (int) $ID;
		$query = mysql_query("SELECT article_text FROM articles WHERE article_id=$ID") or die(mysql_error());      // Выбираем содержимое поля article_text из таблицы articles
		$result = mysql_result($query, 0);
		echo $result;                            // Выводим результат
		}
	function __destruct()
		{
		mysql_close();
		}
}

?>