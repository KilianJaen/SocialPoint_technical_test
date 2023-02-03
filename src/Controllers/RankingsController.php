<?php

namespace KilianJaen\Ranking\Controllers;

use KilianJaen\Ranking\Services\Ranking\GetRanking\Query as GetRankingQuery;
use KilianJaen\Ranking\Services\Ranking\GetRanking\QueryHandler as GetRankingQueryHandler;

class RankingsController
{
   public function getAction(array $params): array
    {
        if (!$this->validateParameters($params)) {
            return ['status' => 404, 'result' => 'Invalid parameters'];
        }

        $getRankingQuery = new GetRankingQuery(strtolower($params["type"]));
        $getRankingQueryHandler = new GetRankingQueryHandler();

        return $getRankingQueryHandler->execute($getRankingQuery);
    }

    private function validateParameters(array $params): bool
    {
        if (!array_key_exists("type", $params) && !is_string($params["type"])) {
            return false;
        }
        return true;
    }
}