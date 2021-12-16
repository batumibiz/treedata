<?php

/**
 * Получаем указанный узел и всех его предков (breadcrumb)
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
 * Получаем соседние узлы, имеющие общего предка
 *
 * @param array $data Массив с полным деревом данных
 * @param int $ancestor Идентификатор родительского узла
 * @return array
 */
function array_neighbourhood(array $data, int $ancestor): array
{
    $result = [];
    //TODO: попробовать найти алогритм побыстрее, без перебора всего массива
    foreach ($data as $key => $value) {
        if ($value['parent'] === $ancestor) {
            $result[$key] = $value;
        }
    }

    return $result;
}

/**
 * Получаем указанный узел и всех его потомков
 *
 * @param array $data Массив с полным деревом данных
 * @param int $id Идентификатор узла, для которого будем искать потомков
 * @return array
 */
function array_descendants(array $data, int $id): array
{
    return [];
}
