<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Domanda;
use algos\server\entity\Risposta;
use algos\server\entity\Utente;
use DateTime;
require_once __DIR__ . '/../required/autoload.php';

class RispostaProvider extends AbstractProvider {

    private $instance;

    private function __construct() {}

    public function instance(): RispostaProvider {
        if (RispostaProvider::$instance == NULL)
            RispostaProvider::$instance = new RispostaProvider();
        return RispostaProvider::$instance;
    }

    public function addRisposta(Domanda $domanda, int $punteggio): bool {
        $ris = new Risposta($domanda->getIdDomanda(),
            UtenteProvider::instance()->getLoggedUser()->getUsername(),
            $punteggio);
        if (DbProvider::instance()->save($ris)) {
            UtenteProvider::instance()->getLoggedUser()->setEustress(
                calcEustressForUtente(
                    UtenteProvider::instance()->getLoggedUser()));
            return true;
        }
        return false;
    }

    public function getRisposte(DateTime $datetime): array {
        return DbProvider::instance()->selectWhereClause(Risposta,
            array(
                "data = " . $datetime->format("YYYY-mm-dd"),
                "idUtente = " . UtenteProvider::instance()->getLoggedUser()
                    ->getUsername()
            ));
    }

    public function getRisposta(int $idDomanda, DateTime $date): Risposta {
        return DbProvider::instance()->selectWhereClause(Risposta,
            array(
                "idDomanda = $idDomanda",
                "data = " . $date->format("YYYY-mm-dd")
            ));
    }

    public function calcEustressForUtente(Utente $u): float {
        //TODO calc eustress
        
    }
}

