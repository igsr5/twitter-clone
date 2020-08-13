<?php
session_start();

if(!isset($_SESSION['join'])){
	header('Location: index.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録　｜確認｜</title>
</head>
<body>
    <form action="" method="post">
		<dl>
		<dt>ニックネーム</dt>
		<?php echo htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES); ?>
		<dd>
		</dd>
		<dt>メールアドレス</dt>
		<?php echo htmlspecialchars($_SESSION['join']['email'],ENT_QUOTES); ?>
		<dd>
		</dd>
		<dt>パスワード</dt>
		<dd>
		【表示されません】
		</dd>
		<dt>写真など</dt>
		<img src="../member_picture/<?php echo htmlspecialchars($_SESSION['join']['image'],ENT_QUOTES); ?>" alt="" width="100px" height="100px">
		<dd>
		</dd>
		</dl>
		<div>
            <a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <inputtype="submit" value="登録する" />
        </div>
	</form>
</body>
</html>