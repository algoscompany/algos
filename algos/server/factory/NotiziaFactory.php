<?php
namespace algos\server\factory;

require_once __DIR__ . '/../required/autoload.php';

class NotiziaFactory extends AbstractFactory {

    private $instance;

    private function __construct() {
    }

    public function instance(): NotiziaFactory {
        if (NotiziaFactory::$instance == NULL)
            NotiziaFactory::$instance = new NotiziaFactory();
            return NotiziaFactory::$instance;
    }

    public function addNotizia($param): bool {
        ;
    }

    public function getNotizia($param): Notizia {
        ;
    }

    public function getNotizieByDomanda(int $idDomanda): array {
        // DbProvider::instance()->selectWhereClause(Domanda, array("idDomanda=$idDomanda"));
    }

    public function removeNotizia($param): Notizia{
        ;
    }

    public function updateNotizia($param): void {
        ;
    }
}

