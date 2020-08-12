<?php
    session_start();

    $error=array('name'=>'','email'=>'','password'=>'');

    if(!empty($_POST)){
        // エラー項目の確認
        if($_POST['name']==''){
            $error['name']='blank';
        }
        if($_POST['email']==''){
            $error['email']='blank';
        }
        if(strlen($_POST['password'])<4){
            $error['password']='length';
        }
        if($_POST['password']==''){
            $error['password']='blank';
        }


        if(empty($error)){
            $_SESSION['join']=$_POST;
            header('Location: check.php');
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
</head>
<body>
<p>次のフォームに必要事項をご記入ください。</p>
		<form action="" method="post" enctype="multipart/form-data">
            <dl>
                <dt>ニックネーム<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="name" size="35" maxlength="255" value="<?php empty($_POST) ? print "" : print htmlspecialchars($_POST['name'],ENT_QUOTES); ?>"/>
                    <?php if($error['name']=='blank'): ?>
                    <p>＊ニックネームを入力してください</p>
                    <?php endif; ?>
                </dd>

                <dt>メールアドレス<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="email" size="35" maxlength="255" value="<?php empty($_POST) ? print "" : print htmlspecialchars($_POST['email'],ENT_QUOTES); ?>"/>


                    <?php if($error['email']=='blank'): ?>
                    <p>＊メールアドレスを入力してください</p>
                    <?php endif; ?>
                </dd>

                <dt>パスワード<span class="required">必須</span></dt>
                <dd>
                    <input type="password" name="password" size="10" maxlength="20"/>

                    <?php if($error['password']=='blank'): ?>
                    <p>＊パスワードを入力してください</p>
                    <?php elseif($error['password']=='length'): ?>
                    <p>＊4文字以上入力してください</p>
                    <?php endif; ?>
                </dd>
                <dt>写真など</dt>
                <dd><input type="file" name="image" size="35" /></dd>
            </dl>
            <div><input type="submit" value="入力内容を確認する" /></div>
		</form>
</body>
</html>