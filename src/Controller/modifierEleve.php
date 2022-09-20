<?php

namespace Quizz\Controller;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\eleveModel;
use Quizz\Model\QuestionnaireModel;
use Quizz\Service\TwigService;


class modifierEleve implements ControllerInterface
{
    private $post;
    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
        }
        if (!empty($tabInput["POST"]))
        {
            if ($_POST["login"]==null)
            {
                echo "remplire le login.\n";
            }
            else if ($_POST["nom"]==null)
            {
                echo "remplire le nom.\n";
            }
            else if ($_POST["prenom"]==null)
            {
                echo "remplire le prenom.\n";
            }
            else
            {
                //instancie un
                $eleveModel = new eleveModel();
                $this->post = $tabInput["POST"];
                $eleveModel->modifEleve($this->post["login"], $this->post["nom"], $this->post["prenom"],$this->id);
            }
        }
    }
    public function outputEvent()
    {
        $eleveModel = new eleveModel();

        // Obj connect Mysql -> Obj Questionnaire

        return TwigService::getEnvironment()->render('home/modifEleve.html.twig', [
            'param' => $eleveModel->getIdEleve($this->id)
        ]);

    }
}