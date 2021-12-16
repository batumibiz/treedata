<?php

/**
 * Получаем всех предков указанного узла
 *
 * @param array $data Массив с полным деревом данных
 * @param int $id Идентификатор узла, начиная от которого будем искать предков
 * @return array
 */
function array_ancestors(array $data, int $id = 0): array
{
    static $result;

    if (isset($data[$id])) {
        $result[$id] = $data[$id];
        array_ancestors($data, $result[$id]['parent']);
    }

    return $result;
}

/**
 * Получаем детей (без их потомков) указанного узла
 *
 * @param array $data Массив с полным деревом данных
 * @param int $id Идентификатор узла, детей которого будем искать
 * @return array
 */
function array_neighbourhood(array $data, int $id): array
{
    $result = [];
    //TODO: попробовать найти алогритм побыстрее, без перебора всего массива
    foreach ($data as $key => $value) {
        if ($value['parent'] === $id) {
            $result[$key] = $value;
        }
    }

    return $result;
}

/**
 * Получаем всех потомков указанного узла
 *
 * @param array $data Массив с полным деревом данных
 * @param int $id Идентификатор узла, для которого будем искать потомков
 * @return array
 */
function array_descendants(array $data, int $id): array
{
    return [];
}
