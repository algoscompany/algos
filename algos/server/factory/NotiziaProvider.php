<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Domanda;
use algos\server\entity\Notizia;
use algos\server\entity\Risposta;
use algos\server\entity\Utente;

require_once __DIR__ . '/../required/autoload.php';

class NotiziaProvider extends AbstractProvider {

    private static $instance;

    private function __construct() {
    }

    public static function instance(): NotiziaProvider {
        if (NotiziaProvider::$instance == NULL)
            NotiziaProvider::$instance = new NotiziaProvider();
        return NotiziaProvider::$instance;
    }

    public function addNotizia(Notizia $notizia): bool {
        return DbProvider::instance()->save($notizia);
    }

    public function getNotizia(int $id): ?Notizia {
        $arr = DbProvider::instance()->selectWhereClause(new Notizia(),
            array(
                    "idNotizia = " . $id
            ));
        if($arr != null)
            return $arr[0];
        else
            return null;
    }

    public function getNotizieByDomanda(int $idDomanda): array {
        return DbProvider::instance()->selectWhereClause(new Notizia(),
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

    public function updateNotizia(Notizia $old, Notizia $new): bool {
        return DbProvider::instance()->update($old, $new);
    }
    
    public function getCustomNotizie(Utente $u) : array{
        $dom = $this->getMediaRispostePerDomanda($u);
        $notizieToShow = $this->getNotizieToShow($dom);
        
        return $notizieToShow;
    }
    
    private function getMediaRispostePerDomanda(Utente $u): array {
        $domris = array();
        $domande = DbProvider::instance()->select(new Domanda());
        
        foreach ($domande as $domanda) {
            $risposte = DbProvider::instance()->selectWhereClause(
                new Risposta(),
                array(
                    "idDomanda = " . $domanda->getIdDomanda(),
                    "idUtente = '" . $u->getEmail() ."'"
                ));
            
            $sum = 0;
            foreach ($risposte as $risposta) {
                $sum += $risposta->getPunteggio();
            }
            $avg = $sum / count($risposte);
            $domris[$domanda->getIdDomanda()] = $avg;
        }
        return $domris;
    }
    
    private function getNotizieToShow(array $dom): array {
        $notizieToShow = array();
        foreach ($dom as $d => $avg) {
            $notizie = NotiziaProvider::instance()->getNotizieByDomanda($d);

            foreach ($notizie as $notizia) {
                if (($notizia->getPunteggio() >= floor($avg)) &&
                    ($notizia->getPunteggio() <= ceil($avg))) {
                        $notizieToShow[] = $notizia;
                    }
            }
        }
        return $notizieToShow;
    }
}

