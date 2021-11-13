<?php

require 'vendor/autoload.php';

$connection = Atlas\Pdo\Connection::new(
    'mysql:host=localhost;dbname=cms',
    'root',
    '120963'
);

echo '<h1>CMS</h1>';
