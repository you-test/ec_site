<?php

require_once(__DIR__ . '/config.php');


$num = filter_input(INPUT_POST, 'num');

$pdo = Database::pdo();
$itemInstance = new Items($pdo);
$itemInstance->branchCart();
$rows = $itemInstance->getCart();
$totalSum = $itemInstance->sum();

?>

<h2>カート</h2>
    <div class="btn">
        <a href="./">トップ</a>
    </div>
    <div class="container cart-container">

        <div class="cart-inner">
            <div class="cart-list">
                <?php foreach ($rows as $key => $row): ?>
                    <div class="item-block_cart">
                        <div class="img-wrapper_cart">
                            <img src="<?= 'img/item'. $key . '.jpg'; ?>" alt="furniture">
                        </div>
                        <div class="cart-item-info">
                            <p><?= $row['name']; ?></p>
                            <p>&yen;<?= number_format($row['price']); ?></p>
                            <div class="num">
                                <p>数量</p>
                                <form action="?action=change" method="post">
                                    <input type="text" name="num" value="<?= $row['num']; ?>" class="cart-num">
                                    <input type="hidden" name="id" value="<?= $key; ?>">
                                </form>
                                <form action="cart.php?action=delete" method="post">
                                    <input type="submit" value="削除">
                                    <input type="hidden" value="<?= $key ?>" name="id">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="buy">
                <p>商品合計</p>
                <span>&yen;<?= number_format($totalSum); ?></span>
                <form action="message.php">
                    <input type="submit" value="購入する">
                </form>

            </div>
        </div>


    </div>

</body>
</html>
