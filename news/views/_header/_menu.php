<?php header('Content-Type: text/html; charset=utf-8')?>
<div>
	<a href="<?php echo INDEX_URL.'/News/index' ?>">home</a>
	<a href="<?php echo INDEX_URL.'/News/insert' ?>">insert</a>
	<a href="<?php echo INDEX_URL.'/News/update' ?>">update</a>	
	<a href="<?php echo INDEX_URL.'/News/delete' ?>">delete</a>
	<?php $auth = (Auth::checkLoginActive())? 'logout' : 'login';   ?>
	<a href="<?php echo INDEX_URL.'/auth/' . $auth ?>"><?= $auth?></a>
</div>
<hr>
