<?php

namespace Controller;

class HomeController
{
    public function display()
    {
        global $userRepo;
        global $codeRepo;
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
    }
}
