<!--
 * ASTI
 * 
 * @author Eselbaev Asyllan
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
-->
<form method="post">
<br><br>
<div  class="row">
	<div class="col-md-1">
		<p>Фильтр</p>
	</div>
	<div class="col-md-3">
		<?php echo category($category_filter); ?>
	</div>
	<div class="col-md-3">
		<input type="submit" class="btn btn-primary" name="filter" value="Применить"/>
	</div>
</div>
</form>