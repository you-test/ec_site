<?php

class Database
{
    public static function pdo()
    {
        try {
            $pdo = new PDO(
                DSN,
                DB_USER,
                DB_PASS
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
