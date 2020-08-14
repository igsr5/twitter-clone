<?php
session_start();
require('dbconnect.php');

// ログインしているかチェック
if (isset($_SESSION['id']) && $_SESSION['time']+3600 > time()) {
    // ログインしている
    $_SESSION['time']=time();

    $members=$db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));

    $member=$members->fetch();
}else{
    // ログインしていない
    header('Location: login.php');
    exit();
}


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
        <?php echo htmlspecialchars($member['name'],ENT_QUOTES).'さん'; ?>
            <dt>メッセージをどうぞ</dt>
            <dd><textarea name="message" id="" cols="30" rows="10"></textarea></dd>
        </dl>
        <div><input type="submit" value="投稿する"></div>
    </form>
</body>
</html>