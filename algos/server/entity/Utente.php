<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Utente extends Entity {

    private const TABLENAME = "Utente";

    private $username;

    private $nome;

    private $cognome;

    private $password;

    private $eustress;
    
    private $risposte;
    
    private $token;
    
    public function __construct($p1, $p2, $p3, $p4, $p5){
        $args = func_get_args();
        clear_array_args($args);
        call_overload($this, $args, "__construct");
    }

    public function __construct0(string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function __construct1(string $username, string $nome, string $cognome,
        string $password) {
        $this->username = $username;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->password = $password;
    }

    public function __construct2(string $username, string $nome, string $cognome,
        string $password, float $eustress) {
        $this->username = $username;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->password = $password;
        $this->eustress = $eustress;
    }

    public function getUsername(): string {
        return $this->username;
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
    
    public function getPassword(): string{
        return $this->password;
    }

    public function setPassword($password): void {
        $this->password = $this->encryptPassword($password);
    }

    private function encryptPassword($password): string {
        return md5($password);
    }

    public function getEustress(): float {
        return $this->eustress;
    }

    public function setEustress(float $eustress): void {
        $this->eustress = $eustress;
    }

    public function getDistress(): float {
        return abs(100 - $eustress);
    }

    public function setDistress(float $distress) {
        $this->setEustress(abs(100 - $distress));
    }

    public function getImmagineProfilo(): string {
        return "profileimages/" . $this->username;
    }

    public function getTableName(): string {
        return Utente::TABLENAME;
    }
    
    public function getRisposte(): array{
        return $this->risposte;
    }
    
    public function getToken(): int{
        return $this->token;
    }
    
    public function increaseToken(): void{
        $this->token++;
    }

    public function getColumn(): array {
        {
            return array(
                "username" => $this->username,
                "nome" => $this->nome,
                "cognome" => $this->cognome,
                "password" => $this->password,
                "mediaRisposte" => $this->mediaRisposte
            );
        }
    }
}

