<!--
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
-->
<?php

defined('_Asti') or die;

?>
<h2 align="center">Редактировать категорию</h2>
<br>
<p>Категория</p>
<form method="post">
<input type="hidden" name="category_id_ed" value="<?php echo $ID_ed ?>"/>
<input type="text" class="form-control" name="category_name_ed" value="<?php echo $article_category_ed ?>" /><br><br>
<span class="btn-right"><input type="submit" name="submit_ed" class="btn btn-primary btn-lg active" align="right" value="Сохранить" /></span>
</form>
