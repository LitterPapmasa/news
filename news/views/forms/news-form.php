<?php require_once __DIR__.'/../_header/_menu.php';?>

<?php if(isset($update) and $update === true) {
			$action =  INDEX_URL.'?ctrl=News&act=update';
	  	} else {
		  	$action = INDEX_URL.'?ctrl=News&act=insert';
	  	}
?>
<h3>
<?php if (isset($message)) echo $message;?>
</h3>
<sub><?php if (!empty($lastId)) echo "last id: " . $lastId; ?></sub>
<form action="<?=$action ?>" method="post">
	<?php if(isset($update) and $update === true): ?>
		id: <input type="text" name="id" /><br>
	<?php endif;?>
	Header: <input type="text" name="header" /><br>	
	<textarea type="text" name="text" /></textarea>
	<br> <input type="submit" value="add" />
</form>