<?php
namespace algos\server\entity;

use DateTime;

class Risposta extends Entity {

    private const TABLENAME = "Risposta";

    private $data;

    private $idDomanda;

    private $idUtente;

    private $domanda;

    private $utente;

    private $punteggio;

    public function __construct(domanda $domanda, int $utente) {
        $this->domanda = $domanda;
        $this->idUtente = $utente;
    }

    public function __construct(DateTime $data, int $iDdomanda, int $idUtente,
        domanda $domanda, Utente $utente, int $punteggio) {
        $this->data = $data;
        $this->iDdomanda = $iDdomanda;
        $this->idUtente = $idUtente;
        $this->domanda = $domanda;
        $this->utente = $utente;
        $this->punteggio = $punteggio;
    }

    public function getData(): DateTime {
        return $this->data;
    }

    public function getDomanda(): Domanda {
        return $this->domanda;
    }

    public function getUtente(): Utente {
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

