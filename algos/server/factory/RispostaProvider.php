<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Risposta;
use algos\server\entity\Utente;
use DateTime;
require_once __DIR__ . '/../required/autoload.php';

class RispostaProvider extends AbstractProvider {

    private static $instance;

    private function __construct() {}

    public static function instance(): RispostaProvider {
        if (RispostaProvider::$instance == NULL)
            RispostaProvider::$instance = new RispostaProvider();
        return RispostaProvider::$instance;
    }

    private function addRisposta(int $domanda, int $punteggio): bool {
        $ris = new Risposta($domanda,
            UtenteProvider::instance()->getLoggedUser()->getEmail(), $punteggio);
        if (DbProvider::instance()->save($ris)) {
            
            return true;
        }
        return false;
    }

    /**
     * Crea una transazione al database per inserire tutte
     * le risposte passate per l'utente loggato.
     * $risposte = (idDomanda, punteggio)
     */
    public function addRisposte(array $risposte) {
        $user = UtenteProvider::instance()->getLoggedUser();
        if ($user != null) {
            DbProvider::instance()->beginTransaction();
            foreach ($risposte as $risposta) {
                $res = $this->addRisposta($risposta->idDomanda,
                    $risposta->punteggio);
                if (! $res) {
                    DbProvider::instance()->rollbackTransaction();
                    return false;
                }
            }
            $oldUser = clone $user;
            $user->setEustress(
                $this->calcEustressForUtente($user));
            
            UtenteProvider::instance()->updateUtente($oldUser, $user);
            UtenteProvider::instance()->refreshLoggedUser();
            
            DbProvider::instance()->commitTransaction();
            return true;
        }
        else
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
        // TODO calc eustress
        return 0;
    }
}

