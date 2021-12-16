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
                    <th>id</th>
                    <th>name</th>
                </tr>
                <?php foreach ($data as $key => $value): ?>
                    <tr style="color: green">
                        <td><?= $key ?></td>
                        <td><?= str_repeat('&mdash;', $value['depth']) ?>&nbsp;<?= $value['name'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </dd>
    </dl>

    <dl style="margin-top: 1rem">
        <dt>Предки</dt>
        <dd>
            <table>
                <tr>
                    <th>id</th>
                    <th>name</th>
                </tr>
                <?php $ancestors = array_ancestors($data, 9) ?>
                <?php foreach ($ancestors as $key => $value): ?>
                    <tr style="color: green">
                        <td><?= $key ?></td>
                        <td><?= $value['name'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <?php
            // Показываем Breadcrumb меню
            $breadcrumb = [];
            foreach ($ancestors as $key => $value) {
                $breadcrumb[] = '<a href="#' . $key . '">' . $value['name'] . '</a>';
            }
            ?>
            <p>
                Пример Breadcrumb меню<br>
                <?= implode(' | ', array_reverse($breadcrumb)) ?>
            </p>
        </dd>
    </dl>

    <dl style="margin-top: 1rem">
        <dt>Соседи</dt>
        <dd>
            <table>
                <tr>
                    <th>id</th>
                    <th>name</th>
                </tr>
                <?php foreach (array_neighbourhood($data, 8) as $key => $value): ?>
                    <tr style="color: green">
                        <td><?= $key ?></td>
                        <td><?= $value['name'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </dd>
    </dl>

    <dl style="margin-top: 1rem">
        <dt>Потомки</dt>
        <dd>
            <?php foreach (array_descendants($data, 8) as $key => $value): ?>
                <tr style="color: green">
                    <td><?= $key ?></td>
                    <td><?= $value['name'] ?></td>
                </tr>
            <?php endforeach ?>
        </dd>
    </dl>
<?php else: ?>
    <p>Пожалуйста обновите кэш</p>
<?php endif ?>
