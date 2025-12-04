<?php

 namespace App\Models;

class Catalogue{

    private array $tools=[];


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

   public function findTool(int $id): ?Tool
{
    foreach ($this->tools as $tool) {
        if ($tool->getIndex() === $id) {   
            return $tool;
        }
    }
    return null;
}

    //Supprimer un outil
    public function removeOutils(Tool $tooltoRemove):void{
        $index=$this->findTool($tooltoRemove->getIndex());
        if ($index !==null){
            unset($this->tools[$index]);
            }
        }
    //afficher la liste d'outils
    public function showTools():void{
        
       foreach ($this->tools as $tool){
           $status = $tool->getAvailable() ? "DISPONIBLE" : "LOUE";
           echo $tool->getIndex() . " - " . $tool->getName()
                . " | " . $tool->getDailyPrice() . " €/jour"
                . " | " . $status . "\n";
        }
        echo "\n";
    }
 
    

    
	

}
?>