<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сравнение Ajacency List и Closure Tables</title>
    <style>
        h3 {
            margin-left: 1.2em;
        }

        pre{
            color: blue;
        }

        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
            color: green;
        }

        th, td {
            padding: 3px;
        }
    </style>
</head>
<body>
<?php
// Подключаем базу данных
require 'includes/db.php';

// Выборка детей заданного узла
require 'includes/neighbourhood.php';
?>
</body>
</html>
