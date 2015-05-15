<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
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
        <?php foreach($data as $key=>$values): ?>
        <td><?php echo $values['id'];?></td>
        <td><?php echo $values['header'];?></td>
        <td><?php echo $values['date'];?></td>
    <tr>
        <td colspan="3"><?php echo $values['text'];?></td>
    </tr>

    <?php endforeach;?>
    </tr>
</table>
</body>
</html>