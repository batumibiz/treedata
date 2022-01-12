<div class="task">
    <h2>Используем массив</h2>
    <div class="pad">
        <p>
            Для данного задания база данных вообще не задействована.<br>
            Вместо этого используется файл-кэш с массивом, представляющим собой полное дерево данных.<br>
            Кэш с полным деревом данных формируется с помощью Ajacency List, пример запроса представлен выше.
        </p>
        <p><strong>Условие задания</strong></p>
        <ul>
            <li>Все задачи ДОЛЖНЫ быть решены путем использования файла-кэша с массивом данных.</li>
            <li>НЕДОПУСТИМО использование базы данных.</li>
            <li>
                Выполнить следующие задачи:
                <ul>
                    <li>Полное дерево данных</li>
                    <li>Узел [9] и все его предки</li>
                    <li>Соседи с общим предком [8]</li>
                    <li>Узел [5] и вся ветвь его потомков</li>
                </ul>
            </li>
        </ul>
        <p><a href="?export">Обновить кэш данных</a></p>
    </div>
</div>

<?php if (is_file('cache.php')): ?>
    <?php
    // Читаем кэш в формате PHP
    $start = microtime(true);
    $data = include 'cache.php';
    $phpCacheTime = number_format((microtime(true) - $start), 6);
    ?>

    <dl style="margin-top: 1rem">
        <dt>Полное дерево данных</dt>
        <dd>
            <p>
                Время выполнения: 0<br>
                <small>Данные, полученные из кэш-файла уже являются готовым отсортированным деревом,
                поэтому никакая дополнительная обработка не проводится.</small>
            </p>
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
    <br>
    <dl style="margin-top: 1rem">
        <dt>Узел [9] и все его предки</dt>
        <dd>
            <?php
            $start = microtime(true);
            $ancestors = array_ancestors($data, 9);
            echo '<p>Время выполнения: ' . number_format((microtime(true) - $start), 6) . '</p>';
            ?>
            <table>
                <tr>
                    <th>id</th>
                    <th>name</th>
                </tr>
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
                <?= implode(' / ', array_reverse($breadcrumb)) ?>
            </p>
        </dd>
    </dl>
    <br>
    <dl style="margin-top: 1rem">
        <dt>Соседи с общим предком [8]</dt>
        <dd>
            <?php
            $start = microtime(true);
            $neighbourhood = array_neighbourhood($data, 8);
            echo '<p>Время выполнения: ' . number_format((microtime(true) - $start), 6) . '</p>';
            ?>
            <table>
                <tr>
                    <th>id</th>
                    <th>name</th>
                </tr>
                <?php foreach ($neighbourhood as $key => $value): ?>
                    <tr style="color: green">
                        <td><?= $key ?></td>
                        <td><?= $value['name'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </dd>
    </dl>
    <br>
    <dl style="margin-top: 1rem">
        <dt>Узел [5] и вся ветвь его потомков</dt>
        <dd>
            <?php
            $start = microtime(true);
            $descendants = array_descendants($data, 5);
            echo '<p>Время выполнения: ' . number_format((microtime(true) - $start), 6) . '</p>';
            ?>
            <table>
                <tr>
                    <th>id</th>
                    <th>name</th>
                </tr>
                <?php foreach ($descendants as $key => $value): ?>
                    <tr style="color: green">
                        <td><?= $key ?></td>
                        <td><?= str_repeat('&mdash;', $value['depth'] - 1) ?>&nbsp;<?= $value['name'] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </dd>
    </dl>
    <br>
<?php else: ?>
    <p>Пожалуйста обновите кэш</p>
<?php endif ?>
