<?php

namespace Quizz\Controller;

use Quizz\Model\eleveModel;
use Quizz\Service\TwigService;

class supprimeEleve implements \Quizz\Core\Controller\ControllerInterface
{

    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
            $eleveModel = new eleveModel();
            $eleveModel->supprimeEleve($this->id);
        }
    }

    public function outputEvent()
    {
        // TODO: Implement outputEvent() method.
        $twig = TwigService::getEnvironment();
        // Obj connect Mysql -> Obj Questionnaire


        echo $twig->render('questionnaire/list.html.twig', [
        ]);
    }
}