<?php

class Edit
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // 新規登録
    public function insert()
    {
        if (filter_input(INPUT_POST, 'submit')) {
            $name = filter_input(INPUT_POST, 'name');
            $price = filter_input(INPUT_POST, 'price');
            $image = $_FILES['image'];
            $comment = filter_input(INPUT_POST, 'comment');

            // 画像の入力情報の受け取り処理
            $imagePath = 'img/' . $image['name']; //移動先のパス
            $movedPath = '../'. $imagePath;
            $moved = move_uploaded_file($image['tmp_name'], $movedPath);
            if ($moved !== true) {
                echo 'アップロードエラーが発生しました。';
                return;
            }

            // データベースへの登録
            $stmt = $this->pdo->prepare("INSERT INTO items (name, price, comment, image)
                VALUES (:name, :price, :comment, :image)");
            $stmt->bindValue('name', $name, PDO::PARAM_STR);
            $stmt->bindValue('price', $price, PDO::PARAM_INT);
            $stmt->bindValue('comment', $comment, PDO::PARAM_STR);
            $stmt->bindValue('image', $imagePath, PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    // 修正画面での登録済み情報取得
    public function getRegisteredItem()
    {
        $id = filter_input(INPUT_POST, 'id');
        $stmt = $this->pdo->query("SELECT * FROM items WHERE id = $id");
        $item = $stmt->fetch();
        return $item;
    }

    // 商品情報の修正登録
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id');
            $name = filter_input(INPUT_POST, 'name');
            $price = filter_input(INPUT_POST, 'price');
            $price = str_replace(',', '', $price); //number_format(string)からintへ
            $registeredImage = filter_input(INPUT_POST, 'image');
            $comment = filter_input(INPUT_POST, 'comment');
            // 画像の変更の有無を確認
            if ($_FILES['image']['name']) {
                $image = $_FILES['image'];
            } else {
                $image = [];
            }
            // 画像変更の有無で処理を分岐
            if ($image) {
                $imagePath = 'img/' . $image['name']; //移動先のパス
                $movedPath = '../'. $imagePath;
                $moved = move_uploaded_file($image['tmp_name'], $movedPath);
                if ($moved !== true) {
                    echo 'アップロードエラーが発生しました。';
                    return;
                }
            } else {
                $imagePath = $registeredImage;
            }
            // DBへの登録
            $stmt = $this->pdo->prepare("UPDATE items
                SET
                    name = :name,
                    price = :price,
                    comment = :comment,
                    image = :image
                WHERE
                    id = :id
            ");
            $stmt->bindValue('name', $name, PDO::PARAM_STR);
            $stmt->bindValue('price', $price, PDO::PARAM_INT);
            $stmt->bindValue('comment', $comment, PDO::PARAM_STR);
            $stmt->bindValue('image', $imagePath, PDO::PARAM_STR);
            $stmt->bindValue('id', $id, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: index.php');
        }
    }

    public function delete()
    {
        $id = filter_input(INPUT_POST, 'id');
        $stmt = $this->pdo->prepare("DELETE FROM items WHERE id = :id");
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
