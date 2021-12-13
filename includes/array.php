<div class="task">
    <h2>Используем массив</h2>
    <div class="pad">
        <p>
            Для данного задания база данных вообще не задействована.<br>
            Вместо этого используется файл-кэш с массивом, представляющим собой полное дерево данных.<br>
            Кэш с полным деревом данных формируется с помощью Ajacency List, пример запроса представлен в следующем разделе.
        </p>
        <p><strong>Условие задания</strong></p>
        <ul>
            <li>Все задачи ДОЛЖНЫ быть решены путем использования файла-кэша с массивом данных.</li>
            <li>НЕДОПУСТИМО использование базы данных.</li>
        </ul>
        <p><a href="?export">Обновить кэш данных</a></p>
    </div>
</div>

<?php if (is_file('sitemap.php')): ?>
    <?php $data = include 'sitemap.php' ?>
    <dl style="margin-top: 1rem">
        <dt>Дерево данных</dt>
        <dd>
            <table>
                <tr>
                    <th>nodes.id</th>
                    <th>nodes.name</th>
                </tr>
                <?php foreach ($data as $value): ?>
                    <tr style="color: green">
                        <td><?= $value['id'] ?></td>
                        <td><?= str_repeat('&mdash;', $value['depth']) ?>&nbsp;<?= $value['name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </dd>
    </dl>

    <dl style="margin-top: 1rem">
        <dt>Предки</dt>
        <dd>
        </dd>
    </dl>

    <dl style="margin-top: 1rem">
        <dt>Соседи</dt>
        <dd>
        </dd>
    </dl>

    <dl style="margin-top: 1rem">
        <dt>Потомки</dt>
        <dd>
        </dd>
    </dl>
<?php else: ?>
    <p>Пожалуйста обновите кэш</p>
<?php endif; ?>
