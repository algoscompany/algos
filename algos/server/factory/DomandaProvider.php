<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Domanda;

require_once __DIR__ . '/../required/autoload.php';

class DomandaProvider extends AbstractProvider {

    private $instance;

    private function __construct() {
    }

    public function instance(): DomandaProvider {
        if (DomandaProvider::$instance == NULL)
            DomandaProvider::$instance = new DomandaProvider();
        return DomandaProvider::$instance;
    }
    
    public function addDomanda(Domanda $domanda): bool {
        return DbProvider::instance()->save($domanda);
    }
    
    public function getDomande(): array{
        return DbProvider::instance()->select(Domanda);
    }
    
    public function getDomanda(int $idDomanda): Domanda {
        return DbProvider::instance()->selectWhereClause(Domanda, 
            array(
                "idDomanda = $idDomanda"
            ));
    }
    
    public function removeDomanda(Domanda $domanda): Domanda{
        return DbProvider::instance()->delete($domanda);
    }
    
    public function updateDomanda(Domanda $old, Domanda $new): void {
        //TODO;
    }
    
}

