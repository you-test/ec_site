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
            case 'change':
                $this->changeNum();
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
        $image = filter_input(INPUT_POST, 'image');
        $num = filter_input(INPUT_POST, 'num');

        // 既にカートに入っている商品への数量追加処理
        if (isset($_SESSION['cart'])) {
            $rows = $_SESSION['cart'];
            foreach ($rows as $key => $row) {
                if ($key == $id) {
                    if (!$num == '')
                    $num = $num + $row['num'];
                }
            }
        }

        if ($num != '') {
            $_SESSION['cart'][$id] = [
                'name'  => $name,
                'price' => $price,
                'image' => $image,
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
        $rows = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        return $rows;
    }

    public function changeNum()
    {
        $id = filter_input(INPUT_POST, 'id');
        $num = filter_input(INPUT_POST, 'num');
        if ($num == '') {
            $num = 0;
        }
        $_SESSION['cart'][$id]['num'] = $num;
    }

    // 商品の合計表示
    public function sum()
    {
        $totalSum = 0;

        if (isset($_SESSION['cart'])) {
            $rows = $_SESSION['cart'];
            foreach ($rows as $key => $row) {
                $sum = $row['price'] * $row['num'];
                $totalSum += $sum;
            }
        }

        return $totalSum;
    }

    public function reset()
    {
        unset($_SESSION['cart']);
    }
}
