<?php

namespace KilianJaen\Ranking\Services\Ranking\CalculatePositions;

class CommandHandler
{
    public function execute(Command $command): array
    {
        $usersInfo = $command->getUsersInfo();

        $scores = array_column($usersInfo, 'score');
        array_multisort($scores, SORT_DESC, $usersInfo);

        $position = 1;
        foreach ($usersInfo as &$params) {
            $params['position'] = $position;
            $position++;
        }

        return $usersInfo;
    }
}