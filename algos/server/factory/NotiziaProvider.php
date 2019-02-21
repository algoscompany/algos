<?php
namespace algos\server\factory;

require_once __DIR__ . '/../required/autoload.php';

class NotiziaProvider extends AbstractProvider {

    private $instance;

    private function __construct() {
    }

    public function instance(): NotiziaProvider {
        if (NotiziaProvider::$instance == NULL)
            NotiziaProvider::$instance = new NotiziaProvider();
        return NotiziaProvider::$instance;
    }

    public function addNotizia(Notizia $notizia): bool {
        return DbProvider::instance()->save($notizia);
    }

    public function getNotizia(int $id): Notizia {
        return DbProvider::instance()->selectWhereClause(Notizia,
            array(
                    "idNotizia = " . $id
            ))[0];
    }

    public function getNotizieByDomanda(int $idDomanda): array {
        return DbProvider::instance()->selectWhereClause(Domanda,
            array(
                    "idDomanda=$idDomanda"
            ));
    }

    public function removeNotizia(int $id): Notizia {
        $not = $this->getNotizia($id);
        $res = NULL;
        if(!NULL)
            $res = DbProvider::instance()->delete($not);
        return $res;
    }

    public function updateNotizia($param): void {
        ;//TODO
    }
}

