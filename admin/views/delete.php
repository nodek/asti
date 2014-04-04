<?php

defined('_Asti') or die;

?>
<form class='del' method='post'>
<input type='hidden' name='del_id' value="<?php echo $del_id; ?>"/>
<input type='submit' name='delete' class='btn btn-primary btn-xs active del' align='right' value='Удалить'>
</form>