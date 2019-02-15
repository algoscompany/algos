<?php
namespace algos\server\factory;

use DateTime;

require_once __DIR__ . '/../required/autoload.php';

class RispostaFactory extends AbstractFactory {

    private $instance;

    private function __construct() {
    }

    public function instance(): RispostaFactory {
        if (RispostaFactory::$instance == NULL)
            RispostaFactory::$instance = new RispostaFactory();
        return RispostaFactory::$instance;
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

