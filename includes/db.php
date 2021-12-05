<?php

$config = require 'config.php';

$db = new PDO(
    'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'],
    $config['db_user'],
    $config['db_pass'],
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
