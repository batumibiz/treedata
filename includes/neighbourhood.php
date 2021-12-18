<?php

/**
 * @var \PDO $db ;
 */

?>

<div class="task">
    <h2>Выборка соседей</h2>
    <div class="pad">
        <p>Используется для построения дополнительного меню навигации, чтоб показать соседние разделы текущей категории.</p>
        <p><strong>Условие задания</strong></p>
        <ul>
            <li>Мы имеем ID = 8.</li>
            <li>Запрос должен выдать всех соседей, имеющих указанный ID вышестоящего узла (предка).</li>
            <li>НЕДОПУСТИМО использование рекурсии, вложенных запросов и более одного JOIN.</li>
        </ul>
    </div>
</div>

<h3>Ajacency List</h3>
<dl>
    <dt>Запрос</dt>
    <dd>
        <pre>SELECT id, name FROM nodes
WHERE parent = 8</pre>
        <?php
        $start = microtime(true);
        $result = $db->query(
            'SELECT id, name FROM nodes
            WHERE parent = 8'
        )->fetchAll(PDO::FETCH_ASSOC);
        echo '<p>Время выполнения: ' . number_format((microtime(true) - $start), 6) . '</p>';
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php foreach ($result as $value): ?>
                <tr style="color: green">
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['name'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </dd>
    <dt>Достоинства</dt>
    <dd>Простейший и быстрый запрос в одну таблицу.</dd>
    <dt>Недостатки</dt>
    <dd>Нет.</dd>
    <dt>Результат</dt>
    <dd>
        <span class="badge-green">Отлично</span>
    </dd>
</dl>
<br>
<h3>Closure Table</h3>
<dl>
    <dt>Запрос</dt>
    <dd>
        <pre>SELECT id, name FROM closure c
JOIN nodes n on c.descendant = n.id
WHERE c.ancestor = 8</pre>
        <?php
        $start = microtime(true);
        $result = $db->query(
            'SELECT id, name FROM closure c
            JOIN nodes n on c.descendant = n.id
            WHERE c.ancestor = 8'
        )->fetchAll();
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php foreach ($result as $value): ?>
                <tr style="color: red">
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['name'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= '<small>Время выполнения: ' . number_format((microtime(true) - $start), 6) . '</small>' ?>
    </dd>
    <dt>Достоинства</dt>
    <dd>Нет</dd>
    <dt>Недостатки</dt>
    <dd>
        Немного более сложный и ресурсоемкий запрос, чем в случае с Ajacency List.<br>
        Без указания глубины вложенности выдаст родителя и всех нижестоящих потомков.
    </dd>
    <dt>Результат</dt>
    <dd>
        <span class="badge-red">Задание не выполнено</span><br>
        Не выполнено условие "имеем ID = 8", кроме данного параметра нужно еще указывать правильную глубину вложенности.
    </dd>
</dl>
