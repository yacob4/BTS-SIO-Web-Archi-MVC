<?php

namespace Quizz\Controller;

use Quizz\Model\eleveModel;
use Quizz\Service\TwigService;

class ajoutEleve implements \Quizz\Core\Controller\ControllerInterface
{
    private $post;
    private $success;
    public function inputRequest(array $tabInput)
    {
        $eleveModel = NEW eleveModel();
        // TODO: Implement inputRequest() method.
        if (!empty($tabInput["POST"]))
        {
            //verifier si le login est pas vide
            if ($_POST["login"]==null)
            {
                echo "remplire le login.\n";
            }
            else if ($_POST["mdp"]==null)
            {
                echo "remplire le mdp.\n";
            }
            //verifier quil ecrit le meme mdp dans les 2 champs mdp
            else if ($_POST["mdp"]!=$_POST["mdp2"])
            {
                echo "le mdp nest pas le meme .\n";
            }
            else if ($_POST["nom"]==null)
            {
                echo "remplire le nom.\n";
            }
            else if ($_POST["prenom"]==null)
            {
                echo "remplire le prenom.\n";
            }
            //verifier si le mdp est assez grand
            else if (strlen($_POST["mdp"])<=3)
            {
                echo "mot de passe trop petit .\n";
            }
            else
            {
                //verifier si l'email est correct
                if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                {
                    //verifier si l'email existe deja ou pas
                    if ($eleveModel->verifEmail($_POST["email"])==true)
                    {
                        //crympter le mdp
                        $encryptedPasssword = password_hash($this->post["mdp"],PASSWORD_DEFAULT,['cost' => 10]);
                        $this->post = $tabInput["POST"];

                        //mettre les donner en parametre pour cree un eleve
                        $eleveModel->creeEleve($this->post["login"], $encryptedPasssword, $this->post["nom"], $this->post["prenom"], $this->post["email"]);
                        $this->success = true;
                    }
                    else
                    {
                        echo "l'email est deja utiliser \n";
                    }

                }
                else
                {
                    echo "l'email nest pas conforme \n";
                }
            }
        }
    }

    public function outputEvent()
    {
        // TODO: Implement outputEvent() method.
        // Obj connect Mysql -> Obj Questionnaire


        if($this->success == true){
            header('Location:/eleve');
        }
        else{
            return TwigService::getEnvironment()->render('home/ajouter.html.twig');
        }
    }
}