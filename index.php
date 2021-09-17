<?php

require_once(__DIR__ . '/config.php');

$pdo = Database::pdo();
$itemInstance = new Items($pdo);
$items = $itemInstance->getItems();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>EC furniture</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>EC furniture</h1>
    <h2>商品一覧</h2>
    <div class="btn tocart">
        <a href="">カート</a>
    </div>
    <div class="container">

        <?php foreach ($items as $item): ?>
        <div class="item-block">
            <div class="img-wrapper">
                <img src="<?= 'img/item'. Utils::h($item->id) . '.jpg'; ?>" alt="furniture_image">
            </div>
            <div>
                <p><?= Utils::h($item->name); ?></p>
                <p>&yen;<?= Utils::h($item->price); ?></p>
            </div>
            <p><?= nl2br(Utils::h($item->comment)); ?></p>
            <div class="num">
                <p>数量</p>
                <form action="post">
                    <input type="text">
                    <input type="submit" value="カートに入れる">
                </form>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

</body>
</html>
