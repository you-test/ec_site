<?php

require_once(__DIR__ . '/config.php');

$pdo = Database::pdo();
$itemInstance = new Items($pdo);

$action = filter_input(INPUT_GET, 'action');
if ($action === 'delete') {
    $editInstance = new Edit($pdo);
    $editInstance->delete();
}

$items = $itemInstance->getItems();

?>
    <h2>管理画面TOP</h2>
    <div class="btn">
        <a href="insert.php">新規登録</a>
        <a href="../index.php" target="_blank">サイト確認</a>
    </div>
    <div class="container">
        <?php foreach ($items as $item): ?>
            <div class="item-block">
                <div class="img-wrapper">
                    <img src="<?= '../' . Utils::h($item->image); ?>" alt="furniture_image">
                </div>
                <div>
                    <p><?= Utils::h($item->name); ?></p>
                    <p>&yen;<?= number_format(Utils::h($item->price)); ?></p>
                </div>
                <p><?= nl2br(Utils::h($item->comment)); ?></p>

                <div class="item-block__btn">
                    <form action="?action=delete" method="post">
                        <input type="hidden" name="id" value="<?= Utils::h($item->id); ?>">
                        <input type="submit" value="削除">
                    </form>
                    <form action="update.php" method="post">
                        <input type="hidden" name="id" value="<?= Utils::h($item->id); ?>">
                        <input type="submit" value="修正">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
