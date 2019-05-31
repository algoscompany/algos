<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Risposta;
use algos\server\entity\Utente;
use DateTime;
require_once __DIR__ . '/../required/autoload.php';

class RispostaProvider extends AbstractProvider {

    private static $instance;

    private function __construct() {
    }

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
            $user->setEustress($this->calcEustressForUtente($user));

            $uu = UtenteProvider::instance()->updateUtente($oldUser, $user);
            if ($uu) {
                DbProvider::instance()->commitTransaction();
            } else {
                DbProvider::instance()->rollbackTransaction();
                return false;
            }
            UtenteProvider::instance()->refreshLoggedUser();
            return true;
        } else
            return false;
    }

    public function getRisposte(DateTime $datetime): array {
        return DbProvider::instance()->selectWhereClause(Risposta,
            array(

                    "data = " . $datetime->format("YYYY-mm-dd"),
                    "idUtente = " .
                    UtenteProvider::instance()->getLoggedUser()
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

    public function getStatForUser(string $email) {
        /**
         * Restituisce gli ultimi 7 giorni
         */
        if ($email != null) {
            $res = DbProvider::instance()->selectWhereClause(new Risposta(), array(
                "idUtente = '" . $email . "'"
            ));
            
            if($res != null){
                $arr = array();
                foreach($res as $r){
                    $arr[$r->getData()->format("Y-m-d")][] = $r->getPunteggio();
                }
                foreach($arr as $k => $a){
                    $sum = 0;
                    $count = 0;
                    foreach($a as $i){
                        $sum = $sum + $i;
                        $count++;
                    }
                    if($count != 0)
                        $arr[$k] = round($sum / $count, 2);
                    else
                        $arr[$k] = 0;
                }
            }
            return $arr;
        }
        else
            return null;
    }

    public function isTestEffettuatoOggi(): bool {
        $usr = UtenteProvider::instance()->getLoggedUser();
        if ($usr != null) {
            $oggi = new DateTime("now");
            $res = DbProvider::instance()->selectWhereClause(new Risposta(),
                array(

                        "idUtente = '" . $usr->getEmail() . "'",
                        "DATE(Data) = '" . $oggi->format("Y-m-d") . "'"
                ));
            return ($res != null ? true : false);
        }
    }

    public function calcEustressForUtente(Utente $u): float {
        $res = DbProvider::instance()->selectWhereClause(new Risposta(),
            array(

                    "IdUtente = '" . $u->getEmail() . "'",
                    "DATE(Data) > (NOW() - INTERVAL 7 DAY)"
            ));

        if ($res != null) {
            // CALCOLO L'ARRAY ASSOCIATIVO VALORE - MEDIA PUNTEGGIO RISPOSTE
            $risposte = array();
            foreach ($res as $v) {
                $risposte[$v->getData()->format("Y-m-d")][] = $v;
            }

            $eventi = array();
            foreach ($risposte as $k => $v) {
                $sum = 0;
                $count = 0;
                foreach ($v as $r) {
                    $sum = $sum + $r->getPunteggio();
                    $count ++;
                }
                if ($count != 0)
                    $eventi[$k] = $sum / $count;
                else
                    $eventi[$k] = 0;
            }
            // sort($eventi);

            // RIEMPIO L'ARRAY DOVE MANCANO I VALORI
            if ($eventi)
                $begin = new DateTime(max(array_keys($eventi)));
            $end = clone $begin;
            $end->modify("-6 day");

            while ($begin >= $end) {
                $format = $begin->format("Y-m-d");
                if (! array_key_exists($format, $eventi)) {
                    $eventi[$format] = 0;
                }
                $begin->modify("-1 day");
            }
            krsort($eventi);

            // CALCOLO EUSTRESS
            // X punteggio
            // W peso
            // XW punteggio pesato
            $W = 0;
            $XW = 0;

            $w = 7;
            foreach ($eventi as $v) {
                $x = $v;
                $xw = $x * $w;
                if ($x != 0)
                    $W = $W + $w;
                $XW = $XW + $xw;
                $w --;
            }

            if ($W != 0) {
                $eustress = $XW / $W;
                return round((($eustress / 5) * 100), 0);
            } else
                return 0;
        } else
            return 0;
    }
}

