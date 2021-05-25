<?php

namespace Controller;

use Entity\Code;
use Entity\Language;
use ludk\Http\Request;
use ludk\Controller\AbstractController;
use ludk\Http\Response;

class ContentController extends AbstractController
{
    function create(Request $request): Response
    {
        $langRepo = $this->getOrm()->getRepository(Language::class);
        $manager = $this->getOrm()->getManager();
        $languages = $langRepo->findAll();
        if (
            $request->getSession()->has('user')
            && $request->request->has('title')
            && $request->request->has('desc')
            && $request->request->has('content')
            && $request->request->has('languageId')
        ) {
            $errorMsg = NULL;
            if (strlen(trim($request->request->get('title'))) < 2) {
                $errorMsg = "Your title should have at least 2 characters.";
            } else if (strlen(trim($request->request->get('desc'))) < 2) {
                $errorMsg = "Your desc should have at least 2 characters.";
            } else if (strlen(trim($request->request->get('content'))) == 0) {
                $errorMsg = "Your content shouldn't be empty.";
            } else if (intval($request->request->get('languageId')) == 0) {
                $errorMsg = "You should choose a language.";
            }
            if ($errorMsg) {
                $data = array(
                    "errorMsg" => $errorMsg,
                    "languages" => $languages
                );
                return $this->render("CreateForm.php", $data);
            } else {
                $language = $langRepo->find($request->request->get('languageId'));
                $newCode = new Code();
                $newCode->title = trim($request->request->get('title'));
                $newCode->desc = trim($request->request->get('desc'));
                $newCode->content = trim($request->request->get('content'));
                $newCode->created_at = date("Y-m-d H:i:s");
                $newCode->language = $language;
                $newCode->user = $request->getSession()->get("user");
                $manager->persist($newCode);
                $manager->flush();
                return $this->redirectToRoute("display");
            }
        } else {
            $data = array(
                "languages" => $languages
            );
            return $this->render("CreateForm.php", $data);
        }
    }
}
