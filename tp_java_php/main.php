<?php

require_once __DIR__ . '/Models/Tool.php';
require_once __DIR__ . '/Models/Catalogue.php';
require_once __DIR__ . '/Services/LocationService.php';

use App\Models\Catalogue;
use App\Models\Tool;
use App\Service\LocationService;


//Initialisation des données
$perceuse =new Tool(1,"Perceuse",15.0);
$ponceuse =new Tool(2,"Ponceuse",12.5);
$tondeuse =new Tool(3,"Tondeuse",25.0);
$marteauPiqueur =new Tool(4,"Marteau Piqueur",40.0);
$echelle =new Tool(5,"Echelle",10.0);

//Ajout a la liste 
$catalogue = new Catalogue;
$catalogue->addTool($perceuse);
$catalogue->addTool($ponceuse);
$catalogue->addTool($tondeuse);
$catalogue->addTool($marteauPiqueur);
$catalogue->addTool($echelle);

//Service
$service = new LocationService();



//Fonction pour recuperer ce que l'utilisateur a taper 
function readLineInput(string $prompt): string {
    echo $prompt;
    $line = fgets(STDIN);
    if ($line === false) {
        return "";
    }
    return trim($line);
}

//Variable si l'utilisateur veut quitter
$quit = false;

//Tant qu'on ne quitte pas 
while (!$quit) {
    //Montre le texte de choix
    echo "=====================================\n";
    echo "   Mini systeme de location d'outils \n";
    echo "=====================================\n";
    echo "1. Lister les outils\n";
    echo "2. Louer un outil\n";
    echo "3. Retourner un outil\n";
    echo "4. Quitter\n";

    //Demande de choix a l'utilisateur
   $choiceLine = readLineInput("Votre choix : ");
    if ($choiceLine === ""){
        continue;
    }
    $choice = (int)$choiceLine;
   

    switch ($choice) {

    case 1:
        // Afficher la liste des outils
        $catalogue->showTools();
        break;   

    case 2:
        // Demande l'index de l’outil à louer
        $indexLine = readLineInput("\nEntrez l'index de l'outil à louer : ");

        // vérification (on vérifie $indexLine, pas $choiceLine)
        if (!ctype_digit($indexLine)) {
            echo "Choix invalide.\n\n";
            break;  
        }

        $index = (int)$indexLine;
        $service->rentTool($catalogue, $index);
        break;

    case 3:
        // Demande l'index de l’outil à retourner
        $indexLine = readLineInput("\nEntrez l'index de l'outil à retourner : ");

        // vérification
        if (!ctype_digit($indexLine)) {
            echo "Choix invalide.\n\n";
            break;
        }

        $index = (int)$indexLine;
        $service->returnTool($catalogue, $index);
        break;

    case 4:
        $quit = true;
        echo "Au revoir !\n";
        break;
    
    default:
        echo "Choix invalide.\n";
        break;
   
}

}
