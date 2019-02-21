<?php
namespace algos\server\factory;

use DateTime;

require_once __DIR__ . '/../required/autoload.php';

class RispostaProvider extends AbstractProvider {

    private $instance;

    private function __construct() {
    }

    public function instance(): RispostaProvider {
        if (RispostaProvider::$instance == NULL)
            RispostaProvider::$instance = new RispostaProvider();
        return RispostaProvider::$instance;
    }

    public function addRisposta(int $idDomanda, int $punteggio): bool{
        ;
    }
    
    public function getRisposte(DateTime $datetime): array {
        ;
    }
    
    public function getRisposta(int $idDomanda, DateTime $date): Risposta{
        ;
    }
    
    public function getEustress(): float{
        ;
    }
}

