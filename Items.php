<?php

class Items
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    //商品情報の取得
    public function getItems()
    {
        $stmt = $this->pdo->query("SELECT * FROM items ORDER BY id DESC");
        $items = $stmt->fetchAll();
        return $items;
    }

    // actionによって処理を分岐
    public function branchCart()
    {
        $action = filter_input(INPUT_GET, 'action');

        switch ($action) {
            case 'add':
                $this->add();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                break;
        }
    }

    // 商品をカートに追加
    public function add()
    {
        $id = filter_input(INPUT_POST, 'id');
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');
        $num = filter_input(INPUT_POST, 'num');

        // 既にカートに入っている商品への数量追加処理
        if (isset($_SESSION['cart'])) {
            $rows = $_SESSION['cart'];
            foreach ($rows as $key => $row) {
                if ($key == $id) {
                    $num = $num + $row['num'];
                }
            }
        }

        if ($num != '') {
            $_SESSION['cart'][$id] = [
                'name'  => $name,
                'price' => $price,
                'num'   => $num,
            ];
        }
    }

    // 選択したカート内の商品を削除
    public function delete() {
        $id = filter_input(INPUT_POST, 'id');
        unset($_SESSION['cart'][$id]);
    }

    // カートに表示する商品の取得
    public function getCart()
    {
        $rows = $_SESSION['cart'] ? $_SESSION['cart'] : [];
        return $rows;
    }
}
