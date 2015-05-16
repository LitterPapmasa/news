<a href="<?php echo INDEX_URL.'?ctrl=News&act=index' ?>">home</a>
<a href="<?php echo INDEX_URL.'?ctrl=News&act=insert' ?>">insert</a>
<h3>
<?php if (isset($this->data['message'])) echo $this->data['message'];?>
</h3>
<form action="<?php echo INDEX_URL.'?ctrl=News&act=insert' ?>" method="post">
	Header: <input type="text" name="header" /><br>
	<textarea type="text" name="text" /></textarea>
	<br> <input type="submit" value="add" />
</form>