<?php

require_once(__DIR__ . '/config.php');

?>

    <h2>新規登録</h2>
    <div class="insert-image-wrapper">
        <img src="../img/item1.jpg" alt="">
    </div>
    <form action="" method="post">
        <label for="name">商品名</label>
        <input type="text" id="name">
        <label for="price">価格</label>
        <input type="text" id="price">
        <label for="image">画像</label>
        <input type="file" id="image">
        <label for="comment">商品説明</label>
        <input type="textarea" id="comment">
        <input type="submit" value="登録">
    </form>



</body>
</html>
