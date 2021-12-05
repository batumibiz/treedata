<?php

/**
 * @var \PDO $db ;
 */

?>

<hr>
<h2>Выборка детей заданного узла</h2>
<p>Используется для построения дополнительного меню навигации, чтоб показать соседние разделы текущей категории.<br>
    Запрос должен выдать детей узла [8], без родителей и внуков.</p>

<h3>Ajacency List</h3>
<ul>
    <li><strong>Запрос</strong>:
        <pre>SELECT id, name FROM nodes
WHERE parent = 8</pre>
        <?php
        $req = $db->query(
            'SELECT id, name FROM nodes
                WHERE parent = 8'
        );
        ?>
        <table>
            <tr>
                <th>nodes.id</th>
                <th>nodes.name</th>
            </tr>
            <?php while ($res = $req->fetch()): ?>
                <tr>
                    <td><?= $res['id'] ?></td>
                    <td><?= $res['name'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <br>
    </li>
    <li><strong>Достоинства:</strong>: простейший запрос в одну таблицу без рекурсий.</li>
    <li><strong>Недостатки:</strong>: нет.</li>
    <li><strong>Результат</strong>: Отлично! Рекомендовано к применению.</li>
</ul>
