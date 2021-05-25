<?php

namespace Controller;

use Entity\Code;
use Entity\User;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function display(Request $request): Response
    {
        $userRepo = $this->getOrm()->getRepository(User::class);
        $codeRepo = $this->getOrm()->getRepository(Code::class);
        $codes = [];
        if ($request->query->has("search")) {
            $strToSearch = $request->query->get("search");
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
        $data = array(
            "codes" =>  $codes
        );
        return $this->render("display.php", $data);
    }
}
