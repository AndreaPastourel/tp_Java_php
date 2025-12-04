<?php
namespace App\Service;

use App\Models\Catalogue;
use App\Models\Tool;

class LocationService{


    //Recuperer le coup total 
    public function totalCoast(Tool $tool, int $nbDays): ?float{
        $price= $tool->getDailyPrice();
        if ($nbDays>0){
            return $price*$nbDays;
        }
        else {
            echo "Le nombre de jour doit etre superieur à 0";
            return null;
        }
    }


    //Louer un objet 
    public function rentTool(Catalogue $catalogue,int $index){
        $tool=$catalogue->findTool($index);

        if ($tool !== null){
            $toolAvailable=$tool->getAvailable();
            if ($toolAvailable === true){
                //Demande a l'utilisateur d'entrer le nombre de jour
                echo "Entrer un nombre de jour(s) : ";
                $nbDaily = trim(fgets(STDIN));

                //Calcul le coup total 
                $totalCoast=$this->totalCoast($tool,$nbDaily);

                //L'objet devient indisponible
                $tool->setAvailable(false);

                //Recap
                echo "\n---------- Recapitulatif ----------\n";
                echo "Outil : " . $tool->getName() . "\n";
                echo "Duree : " . $nbDaily . " jour(s)\n";
                echo "Prix par jour : " . $tool->getDailyPrice() . " €\n";
                echo "Prix total : " . $totalCoast . " €\n";
                echo "-----------------------------------\n\n";

            }
            else {
                echo $tool->getName()." est deja loué\n";
            }
        }
        else {
            echo "Index incorrect\n";
        }
    }

    //Rendre un objet
    public function returnTool(Catalogue $catalogue,int $index){
        $tool=$catalogue->findTool($index);

        if ($index !== null){
            $toolAvailable=$tool->getAvailable();
            if ($toolAvailable === false){
                $tool->setAvailable(true);
                 echo "Outil " . $tool->getName() . " retourne. Il est maintenant disponible.\n\n";
            }
            else {
                echo $tool->getName()." est deja disponible\n\n";
            }
        }
        else {
            echo "Index incorrect";
        }
    }

     

    

}

?>