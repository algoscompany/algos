<?php
namespace algos\server\entity;

use DateTime;
use algos\server\factory\UtenteProvider;
use algos\server\factory\PrivacyProvider;
require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Consenso extends Entity {

    private $TABLENAME = "Acconsente";

    private $idFinalita;

    private $idUtente;

    private $finalita;

    private $utente;

    private $dataOraAccettazione;

    public function __construct(int $idFinalita = EMPTYVAL, String $idUtente = EMPTYVAL,
        DateTime $dataOraAccettazione = EMPTYVAL) {
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
            "dataOraAccettazione" => $this->dataOraAccettazione
        );
    }
}

