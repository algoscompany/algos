<?php
namespace algos\server\entity;

use DateTime;
use algos\server\factory\DomandaProvider;
use algos\server\factory\UtenteProvider;
require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Risposta extends Entity {

    private const TABLENAME = "Risposta";

    private $data;

    private $idDomanda;

    private $idUtente;

    private $domanda;

    private $utente;

    private $punteggio;

    public function __construct($p1, $p2, $p3, $p4) {
        $args = func_get_args();
        clear_array_args($args);
        call_overload($this, $args, "__construct");
    }

    public function __construct0(int $idDomanda, int $idUtente, int $punteggio) {
        $this->idDomanda = $idDomanda;
        $this->idUtente = $idUtente;
        $this->punteggio = $punteggio;
        $this->data = new DateTime("now");
    }

    public function __construct1(DateTime $data, int $idDomanda, int $idUtente,
        int $punteggio) {
        $this->data = $data;
        $this->idDomanda = $idDomanda;
        $this->idUtente = $idUtente;
        $this->punteggio = $punteggio;
    }

    public function getData(): DateTime {
        return $this->data;
    }

    public function getDomanda(): Domanda {
        if ($this->domanda == null)
            $this->domanda = DomandaProvider::instance()->getDomanda(
                $this->idDomanda);
        return $this->domanda;
    }

    public function getUtente(): Utente {
        if ($this->utente == null)
            $this->utente = UtenteProvider::instance()->getUtenteFromEmail(
                $this->idUtente);
        return $this->utente;
    }

    public function getPunteggio(): int {
        return $this->punteggio;
    }

    public function getTableName(): string {
        return Risposta::TABLENAME;
    }

    public function getColumn(): array {
        return array(
            "Data" => $this->data,
            "Domanda" => $this->idDomanda,
            "Utente" => $this->idUtente,
            "Punteggio" => $this->punteggio
        );
    }
}

