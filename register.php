<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Users.php');

$pdo = Database::pdo();
$usersInstance = new Users($pdo);

$message = $usersInstance->register();
?>

<h2>ユーザー情報登録</h2>
<div class="login">
  <p><?= $message ?></p>
  <form action="" method="post">
    <label for="name">ユーザーネーム</label>
    <input type="text" name="name" id="name">
    <label for="pass">パスワード</label>
    <input type="text" name="pass" id="pass">
    <input type="submit" value="登録">
    <a href="login.php">ログインページ</a>
  </form>
</div>
