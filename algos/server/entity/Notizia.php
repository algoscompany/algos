<?php
namespace algos\server\entity;

use algos\server\factory\CategoriaProvider;
use algos\server\factory\DomandaProvider;
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

    // suggerimento o musica
    private $link;

    private $categoria;

    private $domanda;

    public function __construct($p1 = EMPTYVAL, $p2 = EMPTYVAL, $p3 = EMPTYVAL, $p4 = EMPTYVAL, $p5 = EMPTYVAL,
        $p6 = EMPTYVAL) {
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

    public function getIdNotizia() {
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
        return (($this->link == null) ? true : false);
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        if (! $this->isSuggest())
            $this->link = $link;
    }

    public function getCategoria(): Categoria {
        if ($this->categoria == null)
            $this->categoria = CategoriaProvider::instance()->getCategoria(
                $this->idCategoria);
        return $this->categoria;
    }

    public function setCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
        $this->categoria = null;
    }

    public function getDomanda() {
        if ($this->domanda = null)
            $this->domanda = DomandaProvider::instance()->getDomanda(
                $this->idDomanda);
        return $this->domanda;
    }

    public function setDomanda($idDomanda) {
        $this->idDomanda = $idDomanda;
        $this->domanda = null;
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
            "link" => $this->link,
            "idCategoria" => $this->idCategoria,
            "idDomanda" => $this->idDomanda
        );
    }
    
    public function __toString(){
        return $this->getIdNotizia();
    }
}

