<?php
namespace algos\server\factory;

require_once __DIR__ . '/../required/autoload.php';

class DomandaFactory extends AbstractFactory {

    private $instance;

    private function __construct() {
    }

    public function instance(): DomandaFactory {
        if (DomandaFactory::$instance == NULL)
            DomandaFactory::$instance = new DomandaFactory();
        return DomandaFactory::$instance;
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

