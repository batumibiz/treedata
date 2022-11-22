<?php

namespace Treedata;

class ArrayTree
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Получаем указанный узел и всех его предков (breadcrumb)
     */
    function ancestors(int $id = 0): array
    {
        static $result;

        if (isset($this->data[$id])) {
            $result[$id] = $this->data[$id];
            $this->ancestors($result[$id]['parent']);
        }

        return $result;
    }

    /**
     * Получаем соседние узлы, имеющие общего предка
     */
    function neighbourhood(int $ancestor): array
    {
        $result = [];
        //TODO: попробовать найти алогритм побыстрее, без перебора всего массива
        foreach ($this->data as $key => $value) {
            if ($value['parent'] === $ancestor) {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Получаем указанный узел и всех его потомков
     */
    function descendants(int $id): array
    {
        static $result = [];

        if (isset($this->data[$id])) {
            $result[$id] = $this->data[$id];

            foreach ($this->data as $key => $value) {
                if ($value['parent'] === $id) {
                    $this->descendants($key);
                }
            }
        }

        return $result;
    }
}
