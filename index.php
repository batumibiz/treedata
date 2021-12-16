<?php ob_start() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сравнение Ajacency List и Closure Tables</title>
    <style>
        dl {
            margin: 0;
        }

        dt {
            font-weight: bold;
            margin-left: 1em;
        }

        h2 {
            background-color: #3b3b3b;
            color: white;
            display: block;
            padding: 0.4rem 0.7rem;
        }

        h3 {
            color: darkred;
            margin-bottom: 0.4rem;
        }

        pre {
            color: blue;
        }

        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
        }

        table {
            margin-bottom: 0.8rem;
        }

        th, td {
            padding: 3px;
        }

        .badge-green, .badge-yellow, .badge-red {
            border-radius: 0.5rem;
            display: inline-block;
            padding: 0.2rem 0.5rem;
        }

        .badge-green {
            background-color: lightgreen;
        }

        .badge-yellow {
            background-color: gold;
        }

        .badge-red {
            background-color: #ff6464;
        }

        .task {
            background-color: #dadada;
        }

        .pad {
            padding: 0 1rem 0.5rem 1rem;
        }
    </style>
</head>
<body>
<?php
// Подключаем файл с функциями
require 'includes/functions.php';

// Решение всех задач через массив
require 'includes/array.php';

// Подключаем базу данных
require 'includes/db.php';

// Построение дерева данных
require 'includes/fulltree.php';

// Выборка предков
require 'includes/ancestors.php';

// Выборка детей заданного узла
require 'includes/neighbourhood.php';

?>
</body>
</html>
