<?php
namespace algos\server\factory;

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
        ;
    }
    
    public function getDomande(): array{
        ;
    }
    
    public function getDomanda(int $idDomanda): Domanda {
        ;
    }
    
    public function removeDomanda(Domanda $domanda): Domanda{
        ;
    }
    
    public function updateDomanda(Domanda $old, Domanda $new): void {
        ;
    }
    
}

