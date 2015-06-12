<?php require_once __DIR__.'/../_header/_menu.php';?>

<h1>
Authorization
</h1>
<p style="color: red"><?php if (isset($message)) echo $message;?></p>

<form action="<?=INDEX_URL . '/auth/login'; ?>" method="post">	
		Login: <input type="text" name="login" /><br>	
		Password: <input type="text" name="pass" /><br>		
	<br> <input type="submit" value="GO" />
</form>