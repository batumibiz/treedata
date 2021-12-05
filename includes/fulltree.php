<?php

/**
 * @var \PDO $db ;
 */

?>

<h2>Построение дерева данных</h2>
<p>Используется для карты сайта и для многоуровневого меню навигации.</p>
<p><strong>Условие задания</strong></p>
<ul>
    <li>Запрос должен выдать все дерево данных целиком.</li>
    <li>Должна сохраняться иерархическая структура данных.</li>
    <li>НЕЖЕЛАТЕЛЬНО использование рекурсии, вложенных запросов и более одного JOIN.</li>
</ul>

<h3>Ajacency List</h3>
<dl>
    <dt>Запрос</dt>
    <dd>
        <pre>SELECT id, name FROM nodes
WHERE parent = :parent</pre>
        Вышеуказанный запрос крутится рекурсивно программными методами.
        <br><br>
        <?php
        require 'Tree.php';
        $tree = new Tree($db);
        $result = $tree->recursiveWalk();
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php foreach ($result as $value): ?>
                <tr style="color: green">
                    <td><?= $value['id'] ?></td>
                    <td><?= str_repeat('&mdash;', $value['depth']) ?>&nbsp;<?= $value['name'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </dd>
    <dt>Достоинства</dt>
    <dd>
        Сохраняет правильную иерархическую структуру данных.<br>
        Вычисляет глубину вложенности "на лету", не требуя для этого отдельного поля таблицы.
    </dd>
    <dt>Недостатки</dt>
    <dd>Используется рекурсивный запрос.</dd>
    <dt>Результат</dt>
    <dd>
        <span class="badge-yellow">Приемлемо</span><br>
        Если не найдется вариант получше, то можно использовать.
    </dd>
</dl>

<h3>Closure Table</h3>
<dl>
    <dt>Запрос</dt>
    <dd>
        <pre>SELECT id, name, node_depth FROM closure c
JOIN nodes n ON c.descendant = n.id
WHERE c.ancestor = 1</pre>
        <?php
        $req = $db->query(
            'SELECT id, name, parent, node_depth FROM closure c
            JOIN nodes n ON c.descendant = n.id
            WHERE c.ancestor = 1'
        );
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php while ($res = $req->fetch()): ?>
                <tr style="color: red">
                    <td><?= $res['id'] ?></td>
                    <td><?= str_repeat('&mdash;', $res['node_depth']) ?>&nbsp;<?= $res['name'] ?></td>
                </tr>
            <?php endwhile ?>
        </table>
    </dd>
    <dt>Достоинства</dt>
    <dd>Получаем все дерево одним запросом без рекурсии.</dd>
    <dt>Недостатки</dt>
    <dd>
        Ломается иерархическая структура дерева, что для карты сайта и навигации неприемлемо.
    </dd>
    <dt>Результат</dt>
    <dd>
        <span class="badge-red">Плохо</span><br>
        Условие задания не выполнено.
    </dd>
</dl>
