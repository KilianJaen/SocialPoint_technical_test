<?php

namespace KilianJaen\Ranking\Services\User\SaveUserData;

use KilianJaen\Ranking\Controllers\FileController;
use \KilianJaen\Ranking\Services\Ranking\CalculatePositions\Command as calculateCommand;
use \KilianJaen\Ranking\Services\Ranking\CalculatePositions\CommandHandler as calculateCommandHandler;

class CommandHandler
{
    public function execute(Command $command, bool $isNewUser = false): void
    {
        try {
            $file = new FileController();
            $fileInfo = $file->getFile();

            if ($isNewUser) {
                $fileInfo[] = ['userId' => $command->getUser()->getId(), 'score' => $command->getUser()->getScore(), 'position' => 0];
            } else {
                foreach ($fileInfo as &$params) {
                    if ($params['userId'] === $command->getUser()->getId()) {
                        $params['score'] = $command->getUser()->getScore();
                    }
                }
            }

            $calculatePositionsCommand = new calculateCommand($fileInfo);
            $calculatePositionsCommandHandler = new calculateCommandHandler();

            $recalculatedFile = $calculatePositionsCommandHandler->execute($calculatePositionsCommand);

            $file->insertData($recalculatedFile);
        } catch (\Exception $e) {
            throw new \Exception("Error saving user data");
        }
    }
}