<?php

class Users
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  //ユーザーの登録処理
  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = filter_input(INPUT_POST, 'name');
      $pass = filter_input(INPUT_POST, 'pass');
      $passHash = password_hash($pass, PASSWORD_DEFAULT);

      $stmt = $this->pdo->prepare("SELECT * FROM users where name = :name");
      $stmt->bindValue(':name', $name);
      $stmt->execute();
      $dataObj = $stmt->fetch();
      $registeredName = $dataObj->name;

      if ($name === $registeredName) {
        $message = 'すでにこちらのお名前は使われています！残念！！';
        return $message;
      } else {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, pass) VALUES (:name, :pass)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':pass', $passHash);
        $stmt->execute();

        header('Location: login.php');
      }
    }
  }



  //ログイン処理
  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = filter_input(INPUT_POST, 'name');
      $pass = filter_input(INPUT_POST, 'pass');

      $stmt = $this->pdo->prepare("SELECT * FROM users where name = :name");
      $stmt->bindValue(':name', $name);
      $stmt->execute();
      $stPass = $stmt->fetch();

      if ($stPass !== false) {
        $passdata = $stPass->pass;

        if (password_verify($pass, $passdata)) {
          header('Location: index.php');
        } else {
          $message = 'パスワードまたはユーザーネームが違います！！';
          return $message;
        }
      } else {
        $message = 'パスワードまたはユーザーネームが違います！！';
        return $message;
      }

    }
  }
}
