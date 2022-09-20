<?php

namespace Quizz\Controller;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\eleveModel;
use Quizz\Model\QuestionnaireModel;
use Quizz\Service\TwigService;

class eleve implements ControllerInterface
{
    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.

    }
    public function outputEvent()
    {
        // TODO: Implement outputEvent() method.
        $twig = TwigService::getEnvironment();
        // Obj connect Mysql -> Obj Questionnaire

        $eleveModel = new eleveModel();

        // Si y a pas de GET alors j'affiche tout
        return TwigCore::getEnvironment()->render(
            'home/eleve.html.twig',
            [
                'eleves' => $eleveModel->getAllEleve()
            ]);
    }

}
