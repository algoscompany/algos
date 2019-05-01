<?php
namespace algos\server\factory;

require_once __DIR__ . '/../required/autoload.php';

session_start();

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Consenso;
use algos\server\entity\Finalita;
use DateTime;

class PrivacyProvider {

    private static $instance;

    private function __construct() {}

    public static function instance(): PrivacyProvider {
        if (PrivacyProvider::$instance == NULL)
            PrivacyProvider::$instance = new PrivacyProvider();
        return PrivacyProvider::$instance;
    }

    public function prestaConsenso(int $idFinalita, DateTime $dataOraAccettazione): bool {
        $user = UtenteProvider::instance()->getLoggedUser();
        if ($user != null) {
            $isPres = DbProvider::instance()->selectWhereClause(new Consenso(),
                array(
                    "idFinalita=$idFinalita",
                    "idUtente='" . $user->getEmail() . "'"
                ));
            if ($isPres != null)
                return false;
            
            $app = new Consenso($idFinalita, $user->getEmail(),
                $dataOraAccettazione);
            return DbProvider::instance()->save($app);
        } else
            return false;
    }

    public function revocaConsenso(int $idFinalita): bool {
        return DbProvider::instance()->selectWhereClause(new Consenso(),
            array(
                "idFinalita = $idFinalita",
                "idUtente = " . $_SESSION['user']->getEmail()
            ));
    }

    public function getConsensi(): ?array {
        $user = UtenteProvider::instance()->getLoggedUser();
        if ($user != null) {
            $consensi = DbProvider::instance()->selectWhereClause(
                new Consenso(),
                array(
                    "idUtente = '" . $user->getEmail()."'"
                ));
            return $consensi;
        } else
            return null;
    }

    public function inserisciFinalita(Finalita $finalita): bool {
        return DbProvider::instance()->save($finalita);
    }

    public function eliminaFinalita(Finalita $finalita): bool {
        $app = DbProvider::instance()->selectWhereClause(new Finalita(),
            array(
                "idFinalita = " . $finalita->getId()
            ));
        if ($app != NULL) {
            return DbProvider::instance()->delete($finalita);
        }
        return false;
    }

    public function getFinalita() {
        return DbProvider::instance()->select(new Finalita());
    }

    public function getFinalitaById(int $id) {
        return DbProvider::instance()->selectWhereClause(new Finalita(),
            array(
                "Id = $id"
            ))[0];
    }
}

