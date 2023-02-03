<?php

namespace KilianJaen\Ranking\Services\Ranking\InsertScore;

use KilianJaen\Ranking\Models\User;
use KilianJaen\Ranking\Services\User\GetUserData\Query;
use KilianJaen\Ranking\Services\User\GetUserData\QueryHandler;
use KilianJaen\Ranking\Services\User\SaveUserData\Command as SaveUserCommand;
use KilianJaen\Ranking\Services\User\SaveUserData\CommandHandler as SaveUserCommandHandler;

class CommandHandler
{
    const RELATIVE_TYPE = "relative";
    const ABSOLUTE_TYPE = "absolute";

    public function execute(Command $command): array
    {

        $userDataQuery        = new Query($command->getUserId());
        $userDataQueryHandler = new QueryHandler();

        $user = $userDataQueryHandler->execute($userDataQuery);

        return match ($command->getType()) {
            self::RELATIVE_TYPE => $this->relativeType($command, $user),
            self::ABSOLUTE_TYPE => $this->absoluteType($command, $user),
            default => ['status' => 404, 'result' => 'Invalid parameters'],
        };
    }

    public function relativeType(Command $command, ?User $user): array
    {
        $isNewUser = false;

        try {
            if (empty($user)) {
                $isNewUser = true;
                $user = new User($command->getUserId(), 0);
            }

            $userScore = $user->getScore();
            $newUserScore = $userScore + ($command->getScore());
            $newUserScore = ($newUserScore > 0)? $newUserScore : 0;

            $user->setScore($newUserScore);

            $saveUserCommand = new SaveUserCommand($user);
            $saveUserCommandHandler = new SaveUserCommandHandler();
            $saveUserCommandHandler->execute($saveUserCommand, $isNewUser);
        } catch (\Exception $e) {
            return ['status' => 404, 'result' => $e->getMessage()];
        }

        return ['status' => 200, 'result' => 'Saved Data'];
    }

    public function absoluteType(Command $command, ?User $user): array
    {
        $isNewUser = false;
        try {
            if (empty($user)) {
                $isNewUser = true;
                $user = new User($command->getUserId(), $command->getScore());
            } else {
                $user->setScore($command->getScore());
            }

            $saveUserCommand = new SaveUserCommand($user);
            $saveUserCommandHandler = new SaveUserCommandHandler();
            $saveUserCommandHandler->execute($saveUserCommand, $isNewUser);
        } catch (\Exception $e) {
            return ['status' => 404, 'result' => $e->getMessage()];
        }

        return ['status' => 200, 'result' => 'Saved Data'];
    }
}