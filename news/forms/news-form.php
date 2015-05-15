<h3>
<?php if (isset($message)) echo $message;?>
</h3>
<form action="insert.php" method="post">
    Header: <input type="text" name="header"/><br>
    <textarea type="text" name="text"/></textarea><br>
    <input type="submit" value="add"/>
</form>