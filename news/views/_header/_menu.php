<?php // header('Content-Type: text/html; charset=utf-8')?>

html:5
<div>
	<a href="<?php echo INDEX_URL.'/news/index' ?>">home</a>
	<?php if (Auth::checkLoginActive() !== false):?>
	<a href="<?php echo INDEX_URL.'/news/insert' ?>">insert</a>
	<a href="<?php echo INDEX_URL.'/news/update' ?>">update</a>
	<a href="<?php echo INDEX_URL.'/news/delete' ?>">delete</a>
	<?php endif;?>
	<?php $auth = (Auth::checkLoginActive())? 'logout' : 'login';   ?>
	<a href="<?php echo INDEX_URL.'/auth/' . $auth ?>"><?= $auth?></a>
</div>
<hr>
