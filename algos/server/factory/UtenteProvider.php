<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Utente;
require_once __DIR__ . '/../required/autoload.php';

session_start();

class UtenteProvider extends AbstractProvider {

    private static $instance;

    private function __construct() {}

    public static function instance(): UtenteProvider {
        if (UtenteProvider::$instance == NULL)
            UtenteProvider::$instance = new UtenteProvider();
        return UtenteProvider::$instance;
    }

    public function registraUtente(string $email, string $nome, string $cognome,
        string $password): bool {
        $user = new Utente($email, $nome, $cognome, md5($password));
        if (DbProvider::instance()->save($user)) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function login(string $email, string $key): bool {
        $users = DbProvider::instance()->selectWhereClause(new Utente(),
            array(
                
                "email = '$email'"
            ));
        $user = ($users != null ? $users[0] : null);
        if ($user != NULL) {
            $keyS = md5(
                $user->getEmail() . $user->getToken() . $user->getPassword());
            if ($keyS === $key) {
                //aggiorno il token
                $oldUser = clone $user;
                $user->increaseToken();
                UtenteProvider::instance()->updateUtente($oldUser, $user);
                
                //imposto la sessione
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }

    public function getLoggedUser(): ?Utente {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];
        else
            return null;
    }
    
    public function refreshLoggedUser() : bool{
        if($this->getLoggedUser() != null){
            $up = $this->getUtenteFromEmail($_SESSION['user']->getEmail());
            $_SESSION['user'] = $up;
            
            return true;
        }else
            return false;
    }

    public function updateUtente(Utente $old, Utente $new): bool {
        return DbProvider::instance()->update($old, $new);
    }

    public function getUtenteFromEmail(string $email): Utente {
        $user = DbProvider::instance()->selectWhereClause(new Utente(),
            array(
                
                "email = '$email'"
            ));
        return $user[0];
    }

    public function logout(): bool {
        if ($this->getLoggedUser() === null)
            return false;
        $su = session_unset();
        $sd = session_destroy();
        return (($su && $sd) ? true : false);
    }

    public function cancellaUtente(): bool {
        if ($this->getLoggedUser() === null)
            return false;
        $del = DbProvider::instance()->delete($this->getLoggedUser());
        if (($del)) {
            $this->logout();
            return true;
        } else
            return false;
    }

    public function existEmail(string $email): bool {
        $user = DbProvider::instance()->selectWhereClause(new Utente(),
            array(
                "email = '$email'"
            ));
        return (($user != NULL) ? true : false);
    }

    public function recoverPassword(string $email): bool {
        $reclink = DbProvider::instance()->selectWhereClause(RecoverLink,
            array(
                "idUtente = $email"
            ));
        if ($reclink != NULL) {
            $reclink->getScadenza(); // TODO finire scadenza < oggi
        }
        return false;
    }

    public function resetPassword(string $email, string $key): bool {
        ; // TODO reset password
    }
}

