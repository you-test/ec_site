<?php

require_once(__DIR__ . '/config.php');

$pdo = Database::pdo();
$itemInstance = new Items($pdo);
$items = $itemInstance->getItems();

?>
    <h2>商品一覧</h2>
    <div class="btn">
        <a href="cart.php">カート</a>
    </div>
    <div class="container">

        <?php foreach ($items as $item): ?>
            <div class="item-block">
                <div class="img-wrapper">
                    <img src="<?= 'img/item'. Utils::h($item->id) . '.jpg'; ?>" alt="furniture_image">
                </div>
                <div>
                    <p><?= Utils::h($item->name); ?></p>
                    <p>&yen;<?= number_format(Utils::h($item->price)); ?></p>
                </div>
                <p><?= nl2br(Utils::h($item->comment)); ?></p>
                <div class="num">
                    <p>数量</p>
                    <form action="cart.php?action=add" method="post">
                        <input type="text" name="num">
                        <input type="hidden" name="id" value="<?= Utils::h($item->id); ?>">
                        <input type="hidden" name="name" value="<?= Utils::h($item->name); ?>">
                        <input type="hidden" name="price" value="<?= Utils::h($item->price); ?>">
                        <input type="submit" value="カートに入れる">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</body>
</html>
