<?php

 namespace App\Models;

class Catalogue{

    private array $tools;

    //Getter
    public function getTools(): array {
        return $this->tools;
    }

    //Setter
	public function setTools(array $tools): void {
        $this->tools = $tools;
    }

    //Ajouter un outil
    public function addTool(Tool $tool) :void{
       $this->tools[]=$tool;
    }
    //rechercher un outil

    public function findTool(Tool $toolToFind): ?int{
    foreach ($this->tools as $index => $tool) {
        if ($tool->getIndex() === $toolToFind->getIndex()) {
            return $index;
        }
    }
    return null; 
    }

    //Supprimer un outil
    public function removeOutils(Tool $tooltoRemove):void{
        $index=$this->findTool($tooltoRemove);
        if ($index !==null){
            unset($this->tools[$index]);
            }
        }
    
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
 
    //Constructeur
	public function __construct(array $tools){
        $this->tools = $tools;
    }

    
	

}
?>