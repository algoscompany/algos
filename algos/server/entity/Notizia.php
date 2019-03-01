<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Notizia extends Entity {

    private const TABLENAME = "Notizia";

    private $idNotizia;

    private $titolo;

    private $corpo;

    private $fonte;

    private $punteggio;

    private $idCategoria;

    private $idDomanda;

    private $suggest;       //suggerimento o musica

    private $link;

    private $categoria;

    private $domanda;
    
    public function __construct($p1, $p2, $p3, $p4, $p5, $p6){
        $args = func_get_args();
        clear_array_args($args);
        call_overload($this, $args, "__construct");
    }

    public function __construct0(string $titolo, int $punteggio, int $idCategoria,
        int $idDomanda) {
        $this->titolo = $titolo;
        $this->punteggio = $punteggio;
        $this->tidCategoria = $idCategoria;
        $this->idDomanda = $idDomanda;
    }

    public function __construct1(string $titolo, string $corpo, string $fonte,
        int $punteggio, int $idCategoria, int $idDomanda) {
        $this->titolo = $titolo;
        $this->corpo = $corpo;
        $this->fonte = $fonte;
        $this->punteggio = $punteggio;
        $this->tidCategoria = $idCategoria;
        $this->idDomanda = $idDomanda;
    }

    public function __construct2(string $titolo, string $link, int $punteggio,
        int $idCategoria, int $idDomanda) {
        $this->titolo = $titolo;
        $this->punteggio = $punteggio;
        $this->tidCategoria = $idCategoria;
        $this->idDomanda = $idDomanda;
    }
    
    public function getIdNotizia(){
        return $this->idNotizia;
    }

    public function getTitolo() {
        return $this->titolo;
    }

    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }

    public function getCorpo() {
        return $this->corpo;
    }

    public function setCorpo($corpo) {
        if ($this->isSuggest())
            $this->corpo = $corpo;
    }

    public function getFonte() {
        return $this->fonte;
    }

    public function setFonte($fonte) {
        if ($this->isSuggest())
            $this->fonte = $fonte;
    }

    public function getPunteggio() {
        return $this->punteggio;
    }

    public function setPunteggio($punteggio) {
        $this->punteggio = $punteggio;
    }

    public function isSuggest() {
        return $this->type;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        if (! $this->isSuggest())
            $this->link = $link;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getDomanda() {
        return $this->domanda;
    }

    public function setDomanda($domanda) {
        $this->domanda = $domanda;
    }

    public function getTableName(): string {
        return Notizia::TABLENAME;
    }

    public function getColumn(): array {
        return array(
            "idNotizia" => $this->idNotizia,
            "titolo" => $this->titolo,
            "corpo" => $this->corpo,
            "fonte" => $this->fonte,
            "punteggio" => $this->punteggio,
            "suggest" => $this->suggest,
            "link" => $this->link,
            "idCategoria" => $this->idCategoria,
            "idDomanda" => $this->idDomanda
        );
    }
}

