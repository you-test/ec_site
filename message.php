<?php

require_once(__DIR__ . '/config.php');

$pdo = Database::pdo();
$itemInstance = new Items($pdo);
$rows = $itemInstance->getCart();
$totalSum = $itemInstance->sum();

?>

<h2>購入完了</h2>
<div class="btn">
    <a href="index.php">トップ</a>
</div>
<p class="mes">
    ご購入ありがとうございます。<br>
    商品の発送は1週間以内を予定しております。<br>
    またのご利用をお待ちしております。
</p>

<div class="container message">
    <h3>購入商品情報</h3>

    <?php foreach ($rows as $key => $row): ?>
        <div class="item-buy">
            <span><?= $row['name']; ?></span>
            <span>&yen;<?= number_format($row['price']); ?></span>
            <span>x <?= $row['num']; ?></span>
        </div>
    <?php endforeach; ?>
    <div>
        <span>合計</span>
        <span>&yen;<?= number_format($totalSum); ?></span>
    </div>
</div>

</body>
</html>
