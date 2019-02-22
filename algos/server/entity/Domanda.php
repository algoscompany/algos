<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';

class Domanda extends Entity {

    private const TABLENAME = "Domanda";

    private $idDomanda;

    private $domanda;
    
    private $visible;

    public function __construct(string $domanda) {
        $this->domanda = $domanda;
    }

    public function getIdDomanda(): int {
        return $this->idDomanda;
    }

    public function getDomanda(): string {
        return $this->domanda;
    }

    public function setIdDomanda($idDomanda) {
        $this->idDomanda = $idDomanda;
    }

    public function setDomanda($domanda) {
        $this->domanda = $domanda;
    }
    
    public function getVisible(): bool{
        $this->visible;
    }
    
    public function setVisible($visible): void{
        $this->visible = $visible;
    }

    public function getTableName(): string {
        return Domanda::TABLENAME;
    }

    public function getColumn(): array {
        return array(
            "IdDomanda" => $this->idDomanda,
            "Domanda" => $this->domanda
        );
    }
}

