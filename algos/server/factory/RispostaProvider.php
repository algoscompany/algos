<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Domanda;
use algos\server\entity\Risposta;
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

    public function addRisposta(Domanda $domanda): bool{
        return DbProvider::instance()->save($domanda);;
    }
    
    public function getRisposte(DateTime $datetime): array {
        return DbProvider::instance()->selectWhereClause(Risposta, 
            array(
                "data = ".$datetime->format("YYYY-mm-dd")
            ));
    }
    
    public function getRisposta(int $idDomanda, DateTime $date): Risposta{
        return DbProvider::instance()->selectWhereClause(Risposta, 
            array(
                "idDomanda = $idDomanda",
                "data = ".$date->format("YYYY-mm-dd")
            ));
    }
    
    public function getEustress(): float{
        //TODO;
    }
}

