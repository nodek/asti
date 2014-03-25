<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

define ('BASEPATH', dirname(__FILE__));

require_once("controllers/asti.php");

$asti = new asti;
$asti->start();   //Загружаем шаблон

?>