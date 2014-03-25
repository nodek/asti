<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

define('BASEPATH', '../');
$error[0] = 'Включите куки';
$error[1] = 'Авторизуйтесь';
  # Функция для генерации случайной строки
  function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
  }
 
  # Если есть куки с ошибкой то выводим их в переменную и удаляем куки
  if (isset($_COOKIE['errors'])){
      $errors = $_COOKIE['errors'];
      setcookie('errors', '', time() - 60*24*30*12, '/');
  }

  # Подключаем контроллер
  include '/controllers/admin.php';
  $login=new admin;
  if(isset($_POST['submit']))
  {
   
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $data = mysql_fetch_assoc(mysql_query("SELECT users_id, users_password FROM `users` WHERE `users_login`='".mysql_real_escape_string($_POST['login'])."' LIMIT 1"));
     
    # Соавниваем пароли
    if($data['users_password'] === md5(md5($_POST['password'])))
	{
      # Генерируем случайное число и шифруем его
      $hash = md5(generateCode(10));
           
      # Записываем в БД новый хеш авторизации и IP
      mysql_query("UPDATE users SET users_hash='".$hash."' WHERE users_id='".$data['users_id']."'") or die("MySQL Error: " . mysql_error());
       
      # Ставим куки
      setcookie("id", $data['users_id'], time()+60*60*24*30);
      setcookie("hash", $hash, time()+60*60*24*30);
       
      # Переадресовываем браузер на страницу проверки нашего скрипта
      header("Location: index.php"); exit();
    }
    else
    {
      print "<p class='p-signin'>Вы ввели неправильный логин/пароль</p>";
    }
  }
 include("/views/login.php"); 

  # Проверяем наличие в куках номера ошибки
 if (isset($errors)) {print '<h4>'.$error[$errors].'</h4>';}

1?>