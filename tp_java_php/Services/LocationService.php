<?php
namespace App\Service;

use App\Models\Catalogue;
use App\Models\Tool;

class LocationService{


    //Louer un objet 
    public function rentTool(Catalogue $catalogue,Tool $tool){
        $index=$catalogue->findTool($tool);

        if ($index !== null){
            $toolAvailable=$tool->getAvailable();
            if ($toolAvailable === true){
                $tool->setAvailable(false);
            }
            else {
                echo $tool->getName()+" est deja loué";
            }
        }
    }

    //Rendre un objet
    public function returnTool(Catalogue $catalogue,Tool $tool){
        $index=$catalogue->findTool($tool);

        if ($index !== null){
            $toolAvailable=$tool->getAvailable();
            if ($toolAvailable === false){
                $tool->setAvailable(true);
            }
            else {
                echo $tool->getName()+" est deja disponible";
            }
        }
    }



}

?>