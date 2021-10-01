<?php

require_once(__DIR__ . '/config.php');

$pdo = Database::pdo();
$editInstance = new Edit($pdo);
$editInstance->insert();
?>

    <h2>新規登録</h2>
    <div class="btn">
        <a href="index.php">トップ</a>
    </div>
    <div class="container register-container">
        <div class="img-wrapper register-img">
            <img src="" alt="">
        </div>
        <form action="" method="post" class="register-form" enctype="multipart/form-data">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name">
            <label for="price">価格</label>
            <input type="text" id="price" name="price">
            <label for="image">画像</label>
            <input type="file" id="image" name="image">
            <label for="comment">商品説明</label>
            <textarea id="comment" cols="30" rows="10" name="comment"></textarea>
            <input type="submit" value="登録" name="submit">
        </form>
    </div>
</body>
</html>
