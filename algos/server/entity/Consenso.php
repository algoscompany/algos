<?php
namespace algos\server\entity;

use DateTime;
use algos\server\factory\UtenteProvider;
use algos\server\factory\PrivacyProvider;
require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Consenso extends Entity {

    private const TABLENAME = "Acconsente";

    private $idFinalita;

    private $idUtente;

    private $finalita;

    private $utente;

    private $dataOraAccettazione;
    
    public function __construct($p1 = EMPTYVAL, $p2 = EMPTYVAL, $p3 = EMPTYVAL) {
        $args = func_get_args();
        clear_array_args($args);
        call_overload($this, $args, "__construct");
    }
    
    public function __construct0(){
        $this->dataOraAccettazione = new DateTime();
    }

    public function __construct1(int $idFinalita, String $idUtente,
        DateTime $dataOraAccettazione) {
        $this->idFinalita = $idFinalita;
        $this->idUtente = $idUtente;
        $this->dataOraAccettazione = $dataOraAccettazione;
    }

    public function getFinalita(): Finalita {
        if ($this->finalita == null)
            $this->finalita = PrivacyProvider::instance()->getFinalitaById(
                $this->idFinalita);
        return $this->finalita;
    }

    public function getUtente(): Utente {
        if ($this->utente == null)
            $this->utente = UtenteProvider::instance()->getUtenteFromEmail(
                $this->idUtente);
        return $this->utente;
    }

    public function getDataOraAccettazione(): DateTime {
        return $this->dataOraAccettazione;
    }

    public function getTableName(): string {
        return Consenso::TABLENAME;
    }

    public function getColumn(): array {
        return array(
            "idFinalita" => $this->idFinalita,
            "idUtente" => $this->idUtente,
            "dataOraAccettazione" => $this->dataOraAccettazione->format('Y-m-d H:i:s')
        );
    }
}

