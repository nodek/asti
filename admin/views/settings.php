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

?>
<link href="views/css/settings.css" rel="stylesheet">
<p>Шаблон по умолчанию</p>
<?php t_default() ?>
<div class="jumbotron template">
	<p>Установить шаблон по умолчанию</p>
	<div>
		<form method="post">
			<?php template();?>
			<input type="submit" name="submit_template" class="btn btn-primary active" align="right" value="Установить" />
		</form>
	</div>
</div>