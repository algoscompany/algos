<?php
namespace algos\server\entity;

use DateTime;

require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Consenso extends Entity
{

    private $TABLENAME="Acconsente";
    
    private $idFinalita;
    
    private $idUtente;
    
    private $finalita;
    
    private $utente;
    
    private $dataOraAccettazione;

    public function __construct(int $idFinalita, String $idUtente, DateTime $dataOraAccettazione)
    {
        $this->idFinalita = $idFinalita;
        $this->idUtente = $idUtente;
        $this->dataOraAccettazione = $dataOraAccettazione;
    }
    
    public function getFinalita(): Finalita
    {
        return $this->finalita;
    }
    
    public function getUtente(): Utente
    {
        return $this->utente;
    }
    
    public function getDataOraAccettazione(): DateTime
    {
        return $this->dataOraAccettazione;
    }
    
    public function getTableName(): string
    {
        return Consenso::TABLENAME;
    }

    public function getColumn(): array
    {
        return array(
            "idFinalita" => $this->idFinalita,
            "idUtente" => $this->idUtente,
            "dataOraAccettazione" => $this->dataOraAccettazione
        );
    }
}

