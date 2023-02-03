<?php

namespace KilianJaen\Ranking\Services\User\GetUserData;

use KilianJaen\Ranking\Controllers\FileController;
use KilianJaen\Ranking\Models\User;

class QueryHandler
{
    public function execute(Query $query): ?User
    {
        $file = new FileController();
        $fileInfo = $file->getFile();
        foreach ($fileInfo as $params) {
            if ($params['userId'] === $query->getUserId()) {
                return new User($params['userId'], $params['score']);
            }
        }
        return null;
    }
}