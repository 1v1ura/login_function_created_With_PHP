<?php

  error_reporting(E_ALL);
  ini_set('display_errors', 'On');

  if(!empty($_POST)){ // formから送信された値があるか判定
    // エラーメッセージ用の定数を定義
    define('MSG01', '入力必須です');
    define('MSG02', 'emailの形式で入力してください');
    define('MSG03', 'パスワード（再入力）が合っていません');
    define('MSG04', '半角英数字のみご利用いただけます');
    define('MSG05', '6文字以上で入力ください');

    // エラーを格納する配列を定義
    $err_msg = array();

    // formに値が入力されているかチェック
    if (empty($_POST['email'])) { $err_msg['email'] = MSG01; }
    if (empty($_POST['pass'])) { $err_msg['pass'] = MSG01; }
    if (empty($_POST['pass_retype'])) { $err_msg['pass_retype'] = MSG01; }

    // formに値が入力されている場合は、入力値の妥当性をチェック
    if(empty($err_msg)){
      // formに入力された値を変数に格納
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $pass_re = $_POST['pass_retype'];

      // email形式かチェック
      if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
        $err_msg['email'] = MSG02;
      }

      // パスワードと再入力パスワードが同一かチェック
      if($pass !== $pass_re) {
        $err_msg['pass'] = MSG03;
      }

      // print_r($err_msg);

      if(empty($err_msg)){
        if(!preg_match('/^[a-zA-Z0-9]+$/', $pass)) {
          $err_msg['pass'] = MSG04;
        } elseif (strlen($pass) < 6) {
          $err_msg['pass'] = MSG05;
        }
      }

      if(empty($err_msg)) {
        header('Location:mypage.php');
      }
    }

    
  }
 
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TOP | login_function_created_With_PHP</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>ユーザー登録</h1>
    <form action="" method="post">
        <span class="err_msg"><?php if(!empty($err_msg['email'])) echo $err_msg['email']; ?></span>
        <input type="text" name="email" placeholder="email" value="<?php echo $_POST['email']; ?>">

        <span class="err_msg"><?php if(!empty($err_msg['pass'])) echo $err_msg['pass']; ?></span>
        <input type="text" name="pass" placeholder="パスワード" value="<?php echo $_POST['pass']; ?>">

        <span class="err_msg"><?php if(!empty($err_msg['pass_retype'])) echo $err_msg['pass_retype']; ?></span>
        <input type="text" name="pass_retype" placeholder="パスワード(再入力)" value="<?php echo $_POST['pass_retype']; ?>">

        <input type="submit" value="送信">
    </form>
    <a href="mypage.php">マイページへ</a>
</body>
</html>