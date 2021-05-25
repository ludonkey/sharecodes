<?php

use Entity\Code;
use Entity\User;
use Entity\Language;
use ludk\Persistence\ORM;
use Controller\AuthController;
use Controller\ContentController;
use Controller\HomeController;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$orm = new ORM(__DIR__ . '/../Resources');

$manager = $orm->getManager();

$codeRepo = $orm->getRepository(Code::class);
$userRepo = $orm->getRepository(User::class);
$langRepo = $orm->getRepository(Language::class);

$action = $_GET["action"] ?? "display";
switch ($action) {
    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'new':
        $controller = new ContentController();
        $controller->create();
        break;
    case 'display':
    default:
        $controller = new HomeController();
        $controller->display();
        break;
}
