<?php

/**
 * @var \PDO $db ;
 */

?>
<div class="task">
    <h2>Построение дерева данных</h2>
    <div class="pad">
        <p>Используется для карты сайта и для многоуровневого меню навигации.</p>
        <p><strong>Условие задания</strong></p>
        <ul>
            <li>Запрос ДОЛЖЕН выдать все дерево данных целиком.</li>
            <li>ДОЛЖНА сохраняться иерархическая структура данных.</li>
            <li>НЕЖЕЛАТЕЛЬНО использование рекурсии, вложенных запросов и более одного JOIN.</li>
        </ul>
    </div>
</div>

<h3>Ajacency List</h3>
<dl>
    <dt>Запрос</dt>
    <dd>
        <pre>SELECT id, name FROM nodes
WHERE parent = :parent</pre>
        <p>Вышеуказанный запрос крутится рекурсивно программными методами.</p>
        <?php
        $start = microtime(true);
        // Рекурсивный запрос на получение всего дерева данных
        function fullTree(PDO $db, int $parent = 0, int $depth = 0): array
        {
            static $result;
            $req = $db->query('SELECT id, name, parent FROM nodes WHERE parent = ' . $parent);

            while ($res = $req->fetch()) {
                $id = $res['id'];
                unset($res['id']);
                $res['depth'] = $depth;
                $res['parent'] = (int) $res['parent'];
                $result[$id] = $res;
                fullTree($db, (int) $id, $depth + 1);
            }

            return $result;
        }

        $siteMap = fullTree($db);
        echo '<p>Время выполнения: ' . number_format((microtime(true) - $start), 6) . '</p>';

        // Экспорт карты сайта
        if (isset($_GET['export'])) {
            // Экспортируем в файл PHP
            $export = "<?php\n\nreturn ";
            $export .= var_export($siteMap, true);
            $export .= ';';
            file_put_contents('cache.php', $export);

            // Экспортируем в формат JSON
            $export = json_encode($siteMap, JSON_UNESCAPED_UNICODE);
            file_put_contents('cache.json', $export);

            // Возвращаемся на исходную страницу
            header('Location:.');
            exit();
        }
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php foreach ($siteMap as $key => $value): ?>
                <tr style="color: green">
                    <td><?= $key ?></td>
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
        Оценка снижена за использование рекурсивного запроса.
    </dd>
</dl>
<br>
<h3>Closure Table</h3>
<dl>
    <dt>Запрос</dt>
    <dd>
        <pre>SELECT id, name, node_depth FROM closure c
JOIN nodes n ON c.descendant = n.id
WHERE c.ancestor = 1</pre>
        <?php
        $start = microtime(true);
        $result = $db->query(
            'SELECT id, name, parent, node_depth FROM closure c
            JOIN nodes n ON c.descendant = n.id
            WHERE c.ancestor = 1'
        )->fetchAll();
        echo '<p>Время выполнения: ' . number_format((microtime(true) - $start), 6) . '</p>';
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php foreach ($result as $key => $value): ?>
                <tr style="color: red">
                    <td><?= $key ?></td>
                    <td><?= str_repeat('&mdash;', $value['node_depth']) ?>&nbsp;<?= $value['name'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </dd>
    <dt>Достоинства</dt>
    <dd>
        Получаем все дерево одним запросом без рекурсии.
    </dd>
    <dt>Недостатки</dt>
    <dd>
        Ломается иерархическая структура дерева, что для карты сайта и навигации неприемлемо.
    </dd>
    <dt>Результат</dt>
    <dd>
        <span class="badge-red">Задание не выполнено</span><br>
        Не выполнено условие о сохранении иерархической структуры данных.
    </dd>
</dl>
<br>
