<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

define('_Asti', 1);

require_once("controllers/asti.php");

$asti = new asti;
$asti->start();   //Загружаем шаблон

?>