<?php
namespace algos\server\entity;

class Utente extends Entity
{
    
    private const TABLENAME="Utente";
    private $username;
    private $nome;
    private $cognome;
    private $password;
    private $mediaRisposte;
    
    public function __construct(string $username, string $password){
        $this->username = $username;
        $this->password = $password;
    }
    
    public function __construct(string $username, string $nome, string $cognome, string $password){
        $this->username = $username;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->password = $password;
    }
    
    public function __construct(string $username, string $nome, string $cognome, string $password, float $mediaRisposte){
        $this->username = $username;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->password = $password;
        $this->mediaRisposte = $mediaRisposte;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
    
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getCognome(): string
    {
        return $this->cognome;
    }
    
    public function setCognome($cognome): void
    {
        $this->cognome = $cognome;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }
    
    private function encryptPassword($password): string
    {
        //TODO
    }
    
    public function getMediaRisposte(): float
    {
        return $this->mediaRisposte;
    }

    public function setMediaRisposte($mediaRisposte): void
    {
        $this->mediaRisposte = $mediaRisposte;
    }
    
    public function getImmagineProfilo(): string
    {
        //TODO
    }
    public function getTableName(): string
    {
        
    }

    public function getColumn(): array
    {
        
    }

}

