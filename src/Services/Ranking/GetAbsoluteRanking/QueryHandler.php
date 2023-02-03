<?php

namespace KilianJaen\Ranking\Services\Ranking\GetAbsoluteRanking;

use KilianJaen\Ranking\Controllers\FileController;
use KilianJaen\Ranking\Models\Environment;

class QueryHandler
{
    public function execute(Query $query): array
    {
        $response = ['status' => 404, 'result' => "Invalid parameters"];
        $environment = new Environment();

        if (!$this->validateParameters($query, $environment)) {
            return $response;
        }

        $file = new FileController();
        $fileInfo = $file->getFile();
        if (empty($fileInfo)) {
            return ['status' => 200, 'result' => 'The score list is empty'];
        }

        $topRanking = (int)(str_replace('top', '', $query->getRanking()));
        $ranking = [];
        foreach ($fileInfo as $userInfo) {
            if ($userInfo['position'] < $topRanking) {
                $ranking[] = $userInfo;
            }
        }

        return ['status' => 200, 'result' => $ranking];
    }

    private function validateParameters(Query $query, Environment $environment): bool
    {
        if (!in_array($query->getRanking(), $environment->getAbsoluteRankingTypes())) {
            return false;
        }
        return true;
    }
}