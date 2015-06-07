<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
</head>
<body>
<?php require_once __DIR__.'/../_header/_menu.php';?>

<form action="<?=INDEX_URL.'?ctrl=News&act=view' ?>" method="POST">
	<select name="column">
		<option value="id">id</option>
		<option selected value="header">header</option>		
		<option value="text">text</option>	 	
	</select>
	<input type="text" name="searchValue" />
	<input type="submit" value="search"/>
</form>

	<table border="1">
		<tr>
			<th>Id</th>
			<th>Header</th>
			<th>Date</th>
		</tr>
		<tr>
			<th colspan="3">Article</th>
		</tr>
		<tr>
        <?php foreach($items as $item): ?>
        <td><?php echo $item->id;?></td>
			<td><?php echo $item->header;?></td>
			<td><?php echo $item->date;?></td>
		
		
		<tr>
			<td colspan="3"><?php echo $item->text;?></td>
		</tr>

    <?php endforeach;?>
    </tr>
	</table>
</body>
</html>