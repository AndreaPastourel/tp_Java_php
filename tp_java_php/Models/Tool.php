<?php 
    namespace App\Models;

    class Tool{
        private int $index;
        private string $name;
        private float $dailyPrice;
        private bool $available;


        //Constructeur
    public function __construct(int $index,string $name, float $dailyPrice){
        $this->index=$index;
        $this->name = $name;
        $this->dailyPrice = $dailyPrice;
        $this->available = true;
    }


        
        //Getter
        public function getIndex(): int {
            return $this->index;
        }

        public function getName(): string {
            return $this->name;
        }

        public function getDailyPrice(): float {
            return $this->dailyPrice;
        }

        public function getAvailable(): bool {
            return $this->available;
        }

        //Setter
        public function setIndex(string $index): void {
            $this->index = $index;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }

        public function setDailyPrice(float $dailyPrice): void {
            $this->dailyPrice = $dailyPrice;
        }

        public function setAvailable(bool $available): void {
            $this->available = $available;
        }

        
	
	
	

    }

?>