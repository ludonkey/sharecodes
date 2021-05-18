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
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $criteriaWithloginAndPawword = [
                "nickname" => $_POST['username'],
                "password" => $_POST['password']
            ];
            $usersWithThisNicknameAndPassword = $userRepo->findBy($criteriaWithloginAndPawword);
            if (count($usersWithThisNicknameAndPassword) == 1) {
                $_SESSION['user'] = $usersWithThisNicknameAndPassword[0];
                header('Location: ?action=display');
            } else {
                $errorMsg = "Wrong login and/or password.";
                include "../templates/LoginForm.php";
            }
        } else {
            include "../templates/LoginForm.php";
        }
        break;
    case 'new':
        break;
    case 'display':
    default:
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
        break;
}
