<?php

//Stockage des données dans les tableaux
// Les index sont defini par la place que les outils ont dans le tableau
$toolNames = [
    "Perceuse",
    "Ponceuse",
    "Tondeuse",
    "Marteau piqueur",
    "Echelle"
];

//Stockage des prix
//Index tool = index price
$pricesPerDay = [
    15.0,
    12.5,
    25.0,
    40.0,
    10.0
];
//Stockage de la disponibilité 
//Index= available = index tool
$available = [
    true,
    true,
    true,
    true,
    true
];


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

    //On lit le choix et on test si c'est un nombre
    $choiceLine = readLineInput("Votre choix : ");
    if (!ctype_digit($choiceLine)) {
        echo "Choix invalide.\n\n";
        continue;
    }
    $choice = (int)$choiceLine;

    //SI le choix est 1 alors on liste en fonction de l'index
    if ($choice === 1) {
        echo "\nListe des outils :\n";
        for ($i = 0; $i < count($toolNames); $i++) {
            $status = $available[$i] ? "DISPONIBLE" : "LOUE";
            echo $i . " - " . $toolNames[$i]
                . " | " . $pricesPerDay[$i] . " €/jour"
                . " | " . $status . "\n";
        }
        echo "\n";
    //Sinon si 2 alors on demande a l'utilisateur l'index de larticle à loué 
    } elseif ($choice === 2) {
        $indexLine = readLineInput("\nEntrez l'index de l'outil a louer : ");
        //Test si c'est un nombre
        if (!ctype_digit($indexLine)) {
            echo "Index invalide.\n\n";
            continue;
        }
        $index = (int)$indexLine;

        //Si l'index ne correspond pas
        if ($index < 0 || $index >= count($toolNames)) {
            echo "Aucun outil pour cet index.\n\n";
            continue;
        }

        //Si l'outils est deja loué
        if ($available[$index] === false) {
            echo "Outil deja loue. Impossible de le louer a nouveau.\n\n";
            continue;
        }

        //Demande le jour de location
        $daysLine = readLineInput("Nombre de jours de location : ");
        if (!ctype_digit($daysLine)) {
            echo "Nombre de jours invalide.\n\n";
            continue;
        }
        $days = (int)$daysLine;

        //SI le jour est negatif
        if ($days <= 0) {
            echo "Le nombre de jours doit etre strictement positif.\n\n";
            continue;
        }

        //Calcul du prix et stockage
        $totalPrice = $days * $pricesPerDay[$index];
        $available[$index] = false;

        //reacap 
        echo "\n---------- Recapitulatif ----------\n";
        echo "Outil : " . $toolNames[$index] . "\n";
        echo "Duree : " . $days . " jour(s)\n";
        echo "Prix par jour : " . $pricesPerDay[$index] . " €\n";
        echo "Prix total : " . $totalPrice . " €\n";
        echo "-----------------------------------\n\n";

    } elseif ($choice === 3) {
        // Retourner un outil
        $indexLine = readLineInput("\nEntrez l'index de l'outil a retourner : ");
        //Verfier si la saisie est un chiffre
        if (!ctype_digit($indexLine)) {
            echo "Index invalide.\n\n";
            continue;
        }
        $index = (int)$indexLine;

        //Verifier si l'index est dedans
        if ($index < 0 || $index >= count($toolNames)) {
            echo "Aucun outil pour cet index.\n\n";
            continue;
        }
        //Verifie si l'outil etait deja dispo
        if ($available[$index] === true) {
            echo "Cet outil est deja marque comme disponible.\n\n";
            continue;
        }
        //Retourner l'outils
        $available[$index] = true;
        echo "Outil " . $toolNames[$index] . " retourne. Il est maintenant disponible.\n\n";

    } elseif ($choice === 4) {
        //Alors on quitte
        $quit = true;
        echo "Au revoir !\n";
    } else {
        //Si le choix n'est pas entre 1 et 4 alors erreur
        echo "Choix invalide.\n\n";
    }
}