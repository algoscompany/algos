<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Domanda extends Entity {

    private const TABLENAME = "Domanda";

    private $idDomanda;

    private $domanda;
    
    private $visible;
    
    public function __construct($p1 = EMPTYVAL){
        $args = func_get_args();
        clear_array_args($args);
        call_overload($this, $args, "__construct");
    }
    
    public function __construct0(){
        
    }

    public function __construct1(string $domanda) {
        $this->domanda = $domanda;
    }

    public function getIdDomanda(): int {
        return $this->idDomanda;
    }

    public function getDomanda(): string {
        return $this->domanda;
    }

    public function setDomanda(string $domanda) {
        $this->domanda = $domanda;
    }
    
    public function isVisible(): bool{
        return $this->visible;
    }
    
    public function setVisibility(bool $visible): void{
        $this->visible = $visible;
    }

    public function getTableName(): string {
        return Domanda::TABLENAME;
    }

    public function getColumn(): array {
        return array(
            "IdDomanda" => $this->idDomanda,
            "Domanda" => $this->domanda,
            "visible" => $this->visible
        );
    }
}

