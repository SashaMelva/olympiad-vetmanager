<?php

namespace App\Controllers;

use App\Services\Data\DataForJonFile;
use App\Services\Data\DataForRedis;
use App\Services\Response;
use App\Services\Task\TaskCollection;
use App\Services\View;
use App\Services\ViewPath;
use Exception;

class AuthorizationController
{

    public function viewAuthentication(): void
    {
        $this->defaultSessionData();
        $html = new View(ViewPath::ModalAuthorizationWindow);
        $templateWithContent = new View(ViewPath::TemplateContent, ['content' => $html]);
        (new Response((string)$templateWithContent))->echo();
    }

    /** @throws Exception */
    public function registerUser(string $firstName, string $lastName, string $middleName, string $email): void
    {
        if (empty($firstName) || empty($lastName) || empty($middleName) || empty($email)) {
            throw new Exception('Not valid user data');
        }

        $dataForJonFile = new DataForJonFile();

        $userId = $dataForJonFile->getAvailableUserId();
        $_SESSION["userId"] = $userId;

        if (empty($userId)) {
            throw new Exception('No logins available');
        }

        $loginAndPassword = $dataForJonFile->getLoginAndPasswordAndTemplateForUserId($userId);
        $template = $dataForJonFile->getTemplateTask();
        $testData = (new TaskCollection($template))->generateData();
        $variant = ["variant" => (string)rand(1, 2)];

        $fullNameParticipant = [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "middleName" => $middleName,
            "email" => $email
        ];

        $userData = array_merge($fullNameParticipant, $loginAndPassword, $testData, $variant);
        (new DataForRedis())->putNewDataFileForTaskArray($userId, $userData);
    }

    private function defaultSessionData(): void
    {
        $_SESSION["ResultPercentage"] = '0%';
        $_SESSION["TimeEndTask"] = ["minutes" => "00", "seconds" => "00"];
    }
}