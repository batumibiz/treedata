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
        function fullTree(PDO $db, int $parent = 0, int $depth = 0): array
        {
            static $result;
            $req = $db->query('SELECT id, name FROM nodes WHERE parent = ' . $parent);

            while ($res = $req->fetch()) {
                $res['depth'] = $depth;
                $result[] = $res;
                fullTree($db, (int) $res['id'], $depth + 1);
            }

            return $result;
        }

        $siteMap = fullTree($db);

        // Экспорт карты сайта
        if (isset($_GET['export'])) {
            $export = "<?php\n\nreturn ";
            $export .= var_export($siteMap, true);
            $export .= ';';
            file_put_contents('sitemap.php', $export);
            header('Location:.');
            exit();
        }
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php foreach ($siteMap as $value): ?>
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
        Оценка снижена за использование рекурсивного запроса.
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
    <dd>
        Получаем все дерево одним запросом без рекурсии.
    </dd>
    <dt>Недостатки</dt>
    <dd>
        Ломается иерархическая структура дерева, что для карты сайта и навигации неприемлемо.
    </dd>
    <dt>Результат</dt>
    <dd>
        <span class="badge-red">Плохо</span><br>
        Не выполнено условие о сохранении иерархической структуры данных.
    </dd>
</dl>
