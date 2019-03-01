<?php
namespace algos\server\factory;

use algos\server\utility\Email;
use DateTime;

require_once __DIR__ . '/../required/autoload.php';

session_start();

class UtenteProvider extends AbstractProvider {

    private $instance;

    private function __construct() {
    }

    public function instance(): UtenteProvider {
        if (UtenteProvider::$instance == NULL)
            UtenteProvider::$instance = new UtenteProvider();
        return UtenteProvider::$instance;
    }

    public function registraUtente(string $email, string $nome, string $cognome,
        string $password): bool {
        $user = new Utente($email, $nome, md5($password));
        if (DbProvider::instance()->save($user)) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function login(string $email, string $key): bool {
        $user = DbProvider::instance()->selectWhereClause(Utente,
            array(

                    "email = $email"
            ));
        if ($user != NULL) {
            $keyS = $user->getEmail() . $user->getToken() . $user->getPassword();
            if ($keyS === $key) {
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }

    public function logout(): bool {
        $su = session_unset();
        $sd = session_destroy();
        return (($su && $sd) ? true : false);
    }

    public function cancellaUtente(): bool {
        ;//TODO
    }
    
    public function existEmail(string $email) {
        $user = DbProvider::instance()->selectWhereClause(Utente, 
            array(
                "email = $email"
            ));
        return (($user != NULL) ? true : false);
    }
    
    public function recoverPassword(string $email) : bool{
        $reclink = new RecoverLink($email); 
        if($reclink != NULL){
            $app = $reclink->getScadenza();
            $now = new DateTime('now');
            if($app>$now){
                Email::sendEmail($_SESSION['user']->getEmail());
            }
        }
        return false;
    }
    
    public function resetPassword(string $link, string $key) {
       
        $reclink = DbProvider::instance()->selectWhereClause(RecoverLink,
            array(
                "idUtene = $email"
            ));
    }
}

