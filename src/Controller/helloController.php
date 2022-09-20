<?php

namespace Quizz\Controller;

use Quizz\Model\QuestionnaireModel;
use Quizz\Service\TwigService;

class helloController implements \Quizz\Core\Controller\ControllerInterface
{
    private $id;

    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
        }
    }

    public function outputEvent()
    {
        // TODO: Implement outputEvent() method.
        $twig = TwigService::getEnvironment();
        // Obj connect Mysql -> Obj Questionnaire


        echo $twig->render('home/hello.html.twig', [
            "tableau" =>[1,2,3,4,5,6],
            'param' => $this->id
        ]);
    }
}