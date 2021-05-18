<?php

use Entity\Code;
use Entity\User;
use Entity\Language;
use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$orm = new ORM(__DIR__ . '/../Resources');

$manager = $orm->getManager();

$codeRepo = $orm->getRepository(Code::class);
$userRepo = $orm->getRepository(User::class);
$langRepo = $orm->getRepository(Language::class);

$codes = [];

if (isset($_GET["search"])) {
    $strToSearch = $_GET["search"];
    $posOfTheAtCharacter = strpos($strToSearch, "@");

    if ($posOfTheAtCharacter === 0) {
        $userName = substr($strToSearch, 1);
        $users = $userRepo->findBy(array("nickname" => $userName));
        if (count($users) == 1) {
            $codes = $codeRepo->findBy(array("user" => $users[0]->id));
        }
    } else {
        $codes = $codeRepo->findBy(
            array("desc" => "%$strToSearch%")
        );
    }
} else {
    $codes = $codeRepo->findAll();
}

include "../templates/display.php";

$action = $_GET["action"] ?? "display";
switch ($action) {
    case 'register':
        break;
    case 'logout':
        break;
    case 'login':
        break;
    case 'new':
        break;
    case 'display':
    default:
        break;
}
