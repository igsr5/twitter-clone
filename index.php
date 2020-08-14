<?php
session_start();
require('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method='post'>
        <dl>
            <dt>メッセージをどうぞ</dt>
            <dd><textarea name="message" id="" cols="30" rows="10"></textarea></dd>
        </dl>
        <div><input type="submit" value="投稿する"></div>
    </form>
</body>
</html>