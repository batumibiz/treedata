<?php

declare(strict_types=1);

class Tree
{
    private PDO $pdo;
    private array $result;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function recursiveWalk(int $parent = 0, int $depth = 0): array
    {
        $req = $this->pdo->query('SELECT id, name FROM nodes WHERE parent = ' . $parent);

        while ($res = $req->fetch()) {
            $res['depth'] = $depth;
            $this->result[] = $res;
            $this->recursiveWalk((int) $res['id'], $depth + 1);
        }

        return $this->result;
    }
}
