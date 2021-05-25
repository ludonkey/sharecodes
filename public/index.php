<?php

use Entity\Code;
use Entity\User;
use Entity\Language;
use ludk\Persistence\ORM;
use Controller\AuthController;
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
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordRetype'])) {
            $errorMsg = NULL;
            $criteriaWithlogin = [
                "nickname" => $_POST['username']
            ];
            $usersWithThisNickname = $userRepo->findBy($criteriaWithlogin);
            if (count($usersWithThisNickname) > 0) {
                $errorMsg = "Nickname already used.";
            } else if ($_POST['password'] != $_POST['passwordRetype']) {
                $errorMsg = "Passwords are not the same.";
            } else if (strlen(trim($_POST['password'])) < 8) {
                $errorMsg = "Your password should have at least 8 characters.";
            } else if (strlen(trim($_POST['username'])) < 4) {
                $errorMsg = "Your nickame should have at least 4 characters.";
            }
            if ($errorMsg) {
                include "../templates/RegisterForm.php";
            } else {
                $newUser = new User();
                $newUser->nickname = $_POST['username'];
                $newUser->password = $_POST['password'];
                $manager->persist($newUser);
                $manager->flush();
                $_SESSION['user'] = $newUser;
                header('Location: ?action=display');
            }
        } else {
            include "../templates/RegisterForm.php";
        }
        break;
    case 'logout':
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header('Location: ?action=display');
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'new':
        $languages = $langRepo->findAll();
        if (
            isset($_SESSION['user'])
            && isset($_POST['title'])
            && isset($_POST['desc'])
            && isset($_POST['content'])
            && isset($_POST['languageId'])
        ) {
            $errorMsg = NULL;
            if (strlen(trim($_POST['title'])) < 2) {
                $errorMsg = "Your title should have at least 2 characters.";
            } else if (strlen(trim($_POST['desc'])) < 2) {
                $errorMsg = "Your desc should have at least 2 characters.";
            } else if (strlen(trim($_POST['content'])) == 0) {
                $errorMsg = "Your content shouldn't be empty.";
            } else if (intval($_POST['languageId']) == 0) {
                $errorMsg = "You should choose a language.";
            }
            if ($errorMsg) {
                include "../templates/CreateForm.php";
            } else {
                $language = $langRepo->find($_POST['languageId']);
                $newCode = new Code();
                $newCode->title = trim($_POST['title']);
                $newCode->desc = trim($_POST['desc']);
                $newCode->content = trim($_POST['content']);
                $newCode->created_at = date("Y-m-d H:i:s");
                $newCode->language = $language;
                $newCode->user = $_SESSION['user'];
                $manager->persist($newCode);
                $manager->flush();
                header('Location: ?action=display');
            }
        } else {
            include "../templates/CreateForm.php";
        }
        break;
    case 'display':
    default:
        $controller = new HomeController();
        $controller->display();
        break;
}
