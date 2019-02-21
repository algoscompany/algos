<?php
namespace algos\server\factory;

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

    public function registraUtente(string $username, string $nome, string $cognome, $password) {
        ;
    }

    public function login(string $username, string $key): bool {
        ;
    }

    public function logout(): bool {
        $su = session_unset();
        $sd = session_destroy();
        return (($su && $sd) ? true : false);
    }

    public function cancellaUtente(): bool {
        ;
    }
}
