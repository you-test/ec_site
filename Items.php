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
}
