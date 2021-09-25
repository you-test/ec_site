<?php

require_once(__DIR__ . '/config.php');


$num = filter_input(INPUT_POST, 'num');

$pdo = Database::pdo();
$itemInstance = new Items($pdo);
$itemInstance->branchCart();
$rows = $itemInstance->getCart();
print_r($rows);

?>

<h2>カート</h2>
    <div class="btn tocart">
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
                            <p>&yen;<?= $row['price']; ?></p>
                            <div class="num">
                                <p>数量</p>
                                <form action="" method="post">
                                    <input type="text" value="<?= $row['num']; ?>">
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
                <span>&yen;202,000</span>
                <form action="">
                    <input type="submit" value="購入する">
                </form>

            </div>
        </div>


    </div>

</body>
</html>
