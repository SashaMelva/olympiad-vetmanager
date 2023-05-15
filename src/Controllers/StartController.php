<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\Data\DataForRedis;
use App\Services\Response;
use App\Services\View;
use App\Services\ViewPath;

session_start();

class StartController
{
    public function viewInstructions(): void
    {
        $html = (string)new View(ViewPath::Start);
        $templateWithContent = new View(ViewPath::TemplateContent, ['content' => $html]);
        (new Response((string)$templateWithContent))->echo();
    }

    public function viewTasksPreparation(): void
    {
        $redis = new DataForRedis();
        $login = $redis->getDataFileForTaskByUser($_SESSION["userId"], 'login');
        $password = $redis->getDataFileForTaskByUser($_SESSION["userId"], 'password');

        $html = new View(ViewPath::TasksPreparation, ['login' => $login, 'password' => $password]);
        $templateWithContent = new View(ViewPath::TemplateContent, ['content' => $html]);
        (new Response((string)$templateWithContent))->echo();
    }
}