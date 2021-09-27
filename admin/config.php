<?php

session_start();

define('DSN', 'mysql:host=localhost;dbname=ec_furniture;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'sato1987');

require_once(__DIR__ . '/../Database.php');
require_once(__DIR__ . '/../Utils.php');
require_once(__DIR__ . '/../Items.php');
require_once(__DIR__ . '/header.php');
