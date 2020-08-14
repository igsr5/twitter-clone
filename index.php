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

// 投稿を記録する
if(!empty($_POST)){
    if($_POST['message']!=''){
        $message=$db->prepare('INSERT INTO posts SET member_id=?,message=?,created=NOW()');
        $message->execute(array(
            $member['id'],
            $_POST['message']
        ));

        header('Location: index.php');
        exit();
    }
}

// 投稿を削除する
if(!empty($_REQUEST['delete'])){
    $getId=$db->prepare('SELECT * FROM posts WHERE id=?');
    $post=$getId->execute(array($_REQUEST['delete']));
    $post_num=$post->fetch();
    if($_SESSION['id']==$post_num['member_id']){
        $del=$db->prepare('DELETE FROM posts WHERE id=?');
        $del->execute(array($_REQUEST['delete']));
    }
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
    <!-- 投稿フォーム -->
    <form action="" method='post'>
        <dl>
        <?php echo htmlspecialchars($member['name'],ENT_QUOTES).'さん'; ?>
            <dt>メッセージをどうぞ</dt>
            <dd><textarea name="message" id="" cols="30" rows="10"></textarea></dd>
        </dl>
        <div><input type="submit" value="投稿する"></div>
    </form>

    <!-- 投稿一覧 -->
    <div>
        <?php
        $posts=$db->query('SELECT * FROM posts');
        while($post = $posts->fetch()){
            $members->execute(array($post['member_id']));
            $member=$members->fetch();
            echo '<p>'.$member['name'].':'.$post['message'].'</p>';
            echo '<a href="index.php?res='.htmlspecialchars($post['id'],ENT_QUOTES).'">Re</a>';
            echo '<p>'.$post['created'].'</p>';
            if($post['member_id']==$_SESSION['id']){
                echo '<a href="delete.php?delete='.htmlspecialchars($post['id'],ENT_QUOTES).'">削除</a>';
            }
            echo '<hr>';
        }

        ?>
    </div>
</body>
</html>