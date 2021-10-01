<?php

require_once(__DIR__ . '/config.php');

$pdo = Database::pdo();

$editInstance = new Edit($pdo);

// ボタン押下時の分岐処理
$action = filter_input(INPUT_GET, 'action');
if ($action === 'update') {
    // 更新ボタン押下時の新しい情報の登録処理
    $editInstance->update();
}

// 登録済み情報の取得
$item = $editInstance->getRegisteredItem();

?>

    <h2>商品情報の修正</h2>
    <div class="btn">
        <a href="index.php">トップ</a>
    </div>
    <div class="container register-container">
        <div class="img-wrapper register-img">
            <img src="<?= '../' . Utils::h($item->image); ?>" alt="item-image">
        </div>
        <form action="?action=update" method="post" class="register-form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= Utils::h($item->id); ?>">
            <input type="hidden" name="image" value="<?= Utils::h($item->image); ?>">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" value="<?= Utils::h($item->name); ?>">
            <label for="price">価格</label>
            <input type="text" id="price" name="price" value="<?= number_format(Utils::h($item->price)); ?>">
            <label for="image">画像</label>
            <input type="file" id="image" name="image">
            <label for="comment">商品説明</label>
            <textarea id="comment" cols="30" rows="10" name="comment"><?= Utils::h($item->comment); ?>
            </textarea>
            <input type="submit" value="更新" name="submit">
        </form>
    </div>
</body>
</html>
