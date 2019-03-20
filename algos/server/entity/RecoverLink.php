<?php
namespace algos\server\entity;

use DateTime;
use algos\server\factory\UtenteProvider;
use algos\server\config\Configuration;
require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class RecoverLink extends Entity {

    private $link;

    private $scadenza;

    private $idUtente;

    private $utente;

    public function __construct($p1, $p2, $p3) {
        $args = func_get_args();
        clear_array_args($args);
        call_overload($this, $args, "__construct");
    }

    public function __construct0(string $link, DateTime $scadenza, int $idUtente) {
        $this->link = $link;
        $this->scadenza = $scadenza;
        $this->idUtente = $idUtente;
    }

    public function __construct1(int $idUtente) {
        $this->idUtente = $idUtente;
        $this->initRecoverLink();
    }

    private function initRecoverLink(): void {
        $this->link = md5(uniqid($this->getUtente()->getUsername(), true));
        $this->scadenza = new DateTime(
            Configuration::instance()->getParam("scadenzaRecoverLink"));
    }

    public function getLink(): string {
        return $this->link;
    }

    public function getScadenza(): DateTime {
        return $this->scadenza;
    }

    public function setUtilizzato(): void {
        return $this->scadenza = new DateTime('now');
    }

    public function getUtente(): Utente {
        if ($this->utente == null)
            $this->utente = UtenteProvider::instance()->getUtenteFromEmail(
                $this->idUtente);
        return $this->utente;
    }

    public function getTableName(): string {
        return RecoverLink::TABLENAME;
    }

    public function getColumn(): array {
        return array(
            "link" => $this->link,
            "scadenza" => $this->scadenza,
            "idUtente" => $this->idUtente
        );
    }
}

