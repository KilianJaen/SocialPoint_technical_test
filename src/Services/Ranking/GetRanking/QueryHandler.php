<?php

namespace KilianJaen\Ranking\Services\Ranking\GetRanking;

use KilianJaen\Ranking\Models\Environment;
use KilianJaen\Ranking\Services\Ranking\GetAbsoluteRanking\Query as AbsoluteRankingQuery;
use KilianJaen\Ranking\Services\Ranking\GetAbsoluteRanking\QueryHandler as AbsoluteRankingQueryHandler;
use KilianJaen\Ranking\Services\Ranking\GetRelativeRanking\Query as RelativeRankingQuery;
use KilianJaen\Ranking\Services\Ranking\GetRelativeRanking\QueryHandler as RelativeRankingQueryHandler;

class QueryHandler
{
    public function execute(Query $query): array
    {
        $response = ['status' => 404, 'result' => "Invalid parameters"];

        $environment = new Environment();
        if (!$this->validateParameters($query, $environment)) {
            return $response;
        }

        if (in_array($query->getType(), $environment->getAbsoluteRankingTypes())) {
            $response = $this->getAbsoluteRanking($query->getType());
        } elseif (in_array($query->getType(), $environment->getRelativeRankingTypes())) {
            $response = $this->getRelativeRanking($query->getType());
        }

        return $response;
    }

    private function getRelativeRanking(string $type): array
    {
        $absoluteRankingQuery = new RelativeRankingQuery($type);
        $absoluteRankingQueryHandler = new RelativeRankingQueryHandler();

        return $absoluteRankingQueryHandler->execute($absoluteRankingQuery);
    }

    private function getAbsoluteRanking(string $type): array
    {
        $absoluteRankingQuery = new AbsoluteRankingQuery($type);
        $absoluteRankingQueryHandler = new AbsoluteRankingQueryHandler();

        return $absoluteRankingQueryHandler->execute($absoluteRankingQuery);
    }

    private function validateParameters(Query $query, Environment $environment): bool
    {
        if (empty($query->getType()) || ((!in_array($query->getType(), $environment->getAbsoluteRankingTypes()) && !in_array($query->getType(), $environment->getRelativeRankingTypes())))) {
            return false;
        }

        return true;
    }
}