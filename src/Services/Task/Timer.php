<?php declare(strict_types=1);

namespace App\Services\Task;

use VetmanagerApiGateway\Exception\VetmanagerApiGatewayException;


class Timer
{
    public function startTimer(): void
    {
        $_SESSION["StartTime"] = time();
        header('Location: /task?id=1');
    }

    /**
     * @return array{minutes:int, seconds:int}
     */
    public function getTimerAsArray(): array
    {
        $currentTime = time();
        $timeDifference = $currentTime - $_SESSION["StartTime"];

        return $this->convertTimeOnMinuteAndSecond($timeDifference);
    }

    public function getTimerAsString(): string
    {
        $arrayTime = $this->getTimerAsArray();

        return $arrayTime["minutes"] . ":" . $arrayTime["seconds"];
    }

    /**
     * @throws VetmanagerApiGatewayException
     */
    public function storeTaskValue(): void
    {
        $_SESSION["ResultPercentage"] = (new PercentageCompletion())->checkCompletedTasksForUserInPercents() . '%';
        (new PercentageCompletion())->storePercentageCompletionIntoRedis();
        $_SESSION["TimeEndTask"] = $this->getTimerAsArray();
        header('Location: /result');
    }

    /**
     * @throws VetmanagerApiGatewayException
     */
    public function storeTaskValueForEndTime(): void
    {
        $_SESSION["ResultPercentage"] = (new PercentageCompletion())->checkCompletedTasksForUserInPercents() . '%';
        (new PercentageCompletion())->storePercentageCompletionIntoRedis();
        $_SESSION["TimeEndTask"] = $this->getTimerAsArray();
        header('Location: /end_time');
    }

    private function convertTimeOnMinuteAndSecond(int $timeDifference): array
    {
        return [
            'minutes' => $this->beautifulTimeForJS((int)round($timeDifference / 60)),
            'seconds' => $this->beautifulTimeForJS($timeDifference % 60)
        ];
    }

    private function beautifulTimeForJS(int $time): string
    {
        if ($time < 10) {
            return "0" . $time;
        }

        return (string)$time;
    }
}