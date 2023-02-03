<?php

namespace KilianJaen\Ranking\Services\Ranking\GetRelativeRanking;

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

        $positions = $this->createArrayPositions($query->getRanking());
        if (empty($positions)) {
            return $response;
        }

        $ranking = [];
        foreach ($fileInfo as $userInfo) {
            if (in_array($userInfo['position'], $positions)) {
                $ranking[] = $userInfo;
            }
        }
        return ['status' => 200, 'result' => $ranking];
    }

    private function createArrayPositions(string $atRanking): array
    {
        $positions = [];
        $cleanedRanking = str_replace('at', '', $atRanking);
        $rankingParams = explode('/', $cleanedRanking);
        $position = isset($rankingParams[0]) ? (int)$rankingParams[0] : null;
        $upDownUsers = isset($rankingParams[1]) ? (int)$rankingParams[1] : null;

        if (!empty($position) && $upDownUsers) {
            $startCounter = $position - $upDownUsers;
            $finishCounter = $position + $upDownUsers;
            for ($counter = $startCounter; $counter <= $finishCounter; $counter++) {
                $positions[] = $counter;
            }
        }

        return $positions;
    }

    private function validateParameters(Query $query, Environment $environment): bool
    {
        if (!in_array($query->getRanking(), $environment->getRelativeRankingTypes())) {
            return false;
        }
        return true;
    }
}

