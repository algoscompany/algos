<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Utente extends Entity {

    private const TABLENAME = "Utente";

    private $email;

    private $nome;

    private $cognome;

    private $password;

    private $eustress;

    private $ruolo;

    private $token;

    public function __construct($p1 = EMPTYVAL, $p2 = EMPTYVAL, $p3 = EMPTYVAL, $p4 = EMPTYVAL, $p5 = EMPTYVAL) {
//         $this->ruolo = 0;
//         $this->eustress = 0;
//         $this->token = 0;
        
        $args = func_get_args();
        clear_array_args($args);
        call_overload($this, $args, "__construct");
    }

    public function __construct00() {}

    public function __construct0(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function __construct2(string $email, string $nome, string $cognome) {
        $this->email = $email;
        $this->nome = $nome;
        $this->cognome = $cognome;
    }

    public function __construct1(string $email, string $nome, string $cognome,
        string $password) {
        $this->email = $email;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->password = $password;
    }

    public function __construct3(string $email, string $nome, string $cognome,
        string $password, float $eustress) {
        $this->email = $email;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->password = $password;
        $this->eustress = $eustress;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function getCognome(): string {
        return $this->cognome;
    }

    public function setCognome($cognome): void {
        $this->cognome = $cognome;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword($password): void {
        $this->password = $this->encryptPassword($password);
    }

    private function encryptPassword($password): string {
        return md5($password);
    }

    public function getEustress(): float {
        if ($this->eustress == null)
            return 0;
        return $this->eustress;
    }

    public function setEustress(float $eustress): void {
        $this->eustress = $eustress;
    }

    public function getDistress(): float {
        return abs(100 - $this->getEustress());
    }

    public function setDistress(float $distress) {
        $this->setEustress(abs(100 - $distress));
    }

    public function getImmagineProfilo(): string {
        return "profileimages/" . $this->email;
    }

    public function getRuolo(): int {
        return $this->ruolo;
    }

    public function setRuolo(int $ruolo): void {
        $this->ruolo = $ruolo;
    }

    public function getToken(): int {
        return $this->token;
    }

    public function increaseToken(): void {
        $this->token ++;
    }

    public function getTableName(): string {
        return Utente::TABLENAME;
    }

    public function getColumn(): array {
        {
            return array(
                "email" => $this->email,
                "nome" => $this->nome,
                "cognome" => $this->cognome,
                "password" => $this->password,
                "eustress" => $this->eustress,
                "ruolo" => $this->ruolo,
                "token" => $this->token
            );
        }
    }
}

