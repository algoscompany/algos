<?php
namespace algos\server\entity;

use DateTime;

class RecoverLink extends Entity
{

    private $link;
    
    private $scadenza;
    
    private $idUtente;
    
    private $utente;

    public function __construct(string $link, DateTime $scadenza, int $idUtente)
    {
        $this->link = $link;
        $this->scadenza = $scadenza;
        $this->idUtente = $idUtente;
    }
    
    public function __construct(int $idUtente){
        $this->idUtente = $idUtente;
        $this->initRecoverLink();
    }
    
    private function initRecoverLink(){
        
    }
    
    public function getLink(): string
    {
        return $this->link;
    }
    
    public function getScadenza(): DateTime
    {
        return $this->scadenza;
    }
    
    public function setUtilizzato(): void
    {
        return $this->scadenza = new DateTime('now');
    }
    
    public function getUtente(): Utente
    {
        return $this->utente;
    }
    
    public function getTableName(): string
    {
        return RecoverLink::TABLENAME;
    }

    public function getColumn(): array
    {
        return array(
            "link" => $this->link,
            "scadenza" => $this->scadenza,
            "idUtente" => $this->idUtente
        );
    }

}

