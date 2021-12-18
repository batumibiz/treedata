<?php

/**
 * @var \PDO $db ;
 */

?>

<div class="task">
    <h2>Выборка предков</h2>
    <div class="pad">
        <p>В основном используется для Breadcrumb меню.</p>
        <p><strong>Условие задания</strong></p>
        <ul>
            <li>Мы имеем ID = 9.</li>
            <li>Запрос ДОЛЖЕН выдать всех предков узла с указанным ID, до самого старшего (корневого узла).</li>
            <li>ДОЛЖНА быть правильная сортировка от младшего к старшему, или наоборот.</li>
            <li>НЕЖЕЛАТЕЛЬНО использование рекурсии, вложенных запросов и более одного JOIN.</li>
        </ul>
    </div>
</div>

<h3>Ajacency List</h3>
<dl>
    <dt>Запрос</dt>
    <dd>
        <pre>SELECT id, name, parent FROM nodes
WHERE id = :id</pre>
        <p>Вышеуказанный запрос крутится рекурсивно программными методами.</p>
        <?php
        $start = microtime(true);
        function breadcrumb(PDO $db, int $node = 0): array
        {
            static $result;
            $req = $db->query('SELECT id, name, parent FROM nodes WHERE id = ' . $node);

            while ($res = $req->fetch()) {
                $result[] = $res;
                breadcrumb($db, (int) $res['parent']);
            }

            return $result;
        }

        $breadcrumb = breadcrumb($db, 9);
        echo '<p>Время выполнения: ' . number_format((microtime(true) - $start), 6) . '</p>';
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php foreach ($breadcrumb as $value): ?>
                <tr style="color: green">
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['name'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </dd>
    <dt>Достоинства</dt>
    <dd>Без дополнительных затрат обеспечивается правильная сортировка.</dd>
    <dt>Недостатки</dt>
    <dd>Используется рекурсивный запрос.</dd>
    <dt>Результат</dt>
    <dd>
        <span class="badge-yellow">Приемлемо</span><br>
        Оценка снижена за использование рекурсивного запроса.
    </dd>
</dl>
<br>
<h3>Closure Table</h3>
<dl>
    <dt>Запрос</dt>
    <dd>
        <pre>SELECT id, name FROM closure c
JOIN nodes n on c.ancestor = n.id
WHERE c.descendant = 9</pre>
        <?php
        $start = microtime(true);
        $result = $db->query(
            'SELECT id, name FROM closure c
            JOIN nodes n on c.ancestor = n.id
            WHERE c.descendant = 9'
        )->fetchAll();
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
    <dd>
        Получаем результат одним запросом, без рекурсии.<br>
        В несколько раз быстрее, чем Ajacency List
    </dd>
    <dt>Недостатки</dt>
    <dd>
        Нет.
    </dd>
    <dt>Результат</dt>
    <dd>
        <span class="badge-green">Отлично</span>
    </dd>
</dl>
<br>
