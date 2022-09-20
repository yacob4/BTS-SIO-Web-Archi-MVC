<?php

namespace Quizz\Model;

use Quizz\Core\Service\DatabaseService;
use Quizz\Entity\Etudiant;
use Quizz\Entity\Questionnaire;

class eleveModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    /**
     * @return array
     */
    public function getAllEleve()
    {
        $requete = $this->bdd->prepare('SELECT * 
                                            FROM `etudiants` ');
        $requete->execute();
        $tabEleve = [];

        foreach ($requete->fetchAll() as $value)
        {
            $eleve = new Etudiant();
            $eleve ->setIdEtudiant ($value["idEtudiant"]);
            $eleve ->setLogin($value["login"]);
            $eleve ->setNom($value["nom"]);
            $eleve ->setPrenom($value["prenom"]);
            $eleve ->setEmail($value["email"]);
            $tabEleve[] = $eleve;
        }

        return $tabEleve;
    }
    public function getIdEleve(int $id)
    {
        $requete = $this->bdd->prepare('SELECT * 
                                            FROM etudiants 
                                            where idEtudiant = ' . $id);
        $requete->execute();
        $result = $requete->fetch();

        $eleve = new Etudiant();
        $eleve->setIdEtudiant($result["idEtudiant"]);
        $eleve ->setLogin($result["login"]);
        $eleve ->setNom($result["nom"]);
        $eleve ->setPrenom($result["prenom"]);
        $eleve ->setEmail($result["email"]);

        return  $eleve;
    }
    public function creeEleve(string $login,string $mdp,string $nom,string $prenom,string $email)
    {
        $requete = $this->bdd->prepare("INSERT INTO etudiants (login, motDePasse, nom, prenom, email) 
                                            VALUES ( '$login', '$mdp', '$nom', '$prenom', '$email')");
        $requete->execute();
    }
    public function supprimeEleve(int $id)
    {
        $requete = $this->bdd->prepare('DELETE FROM etudiants 
                                            WHERE `etudiants`.`idEtudiant` ='. $id);
        $requete->execute();
    }
    public function modifEleve(string $login,string $nom,string $prenom,int $id)
    {
        $requete = $this->bdd->prepare("UPDATE etudiants
                                            SET login = '{$login}' ,nom ='{$nom}.',prenom ='{$prenom}'
                                            WHERE idEtudiant = {$id};");
        $requete->execute();
    }
    public function verifEmail(string $email)
    {
        $requete = $this->bdd->prepare("SELECT email
                                            FROM etudiants
                                            WHERE email  ='{$email}';");
        $requete->execute();
        $result = $requete->fetch();
        if ($result["email"]==null)
        {
            return true ;
        }
        else
        {
            return false;
        }
    }



}
