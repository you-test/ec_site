<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Users.php');

$pdo = Database::pdo();
$userInstance = new Users($pdo);

$userInstance->login();

?>

<h2>ログイン</h2>
<form action="" method="post">
  <label for="name">ユーザーネーム</label>
  <input type="text" name="name" id="name">
  <label for="pass">パスワード</label>
  <input type="text" name="pass" id="pass">
  <input type="submit" value="ログイン">
</form>