<?php
namespace algos\server\entity;

class Notizia extends Entity
{

    private const TABLENAME="Notizia";
    private $idNotizia;
    private $titolo;
    private $corpo;
    private $fonte;
    private $punteggio;
    private $idCategoria;
    private $idDomanda;
    private $categoria;
    private $domanda;
    
    private $type;
    private $link;
    
    

    public function __construct(string $titolo, int $punteggio, int $idCategoria, int $idCategoria)
    {
        $this->titolo = $titolo;
        $this->punteggio = $punteggio;
        $this->tidCategoria = $idCategoria;
        $this->idDomanda = $idDomanda;
    }
    
    public function __construct(int $idNotizia, string $titolo, string $corpo, string $fonte, int $punteggio, int $idCategoria, int $idCategoria)
    {
        $this->idNotizia = $idNotizia;
        $this->titolo = $titolo;
        $this->corpo = $corpo;
        $this->fonte = $fonte;
        $this->punteggio = $punteggio;
        $this->tidCategoria = $idCategoria;
        $this->idDomanda = $idDomanda;
    }
    
    public function getTitolo()
    {
        return $this->titolo;
    }
    
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }

    public function getCorpo()
    {
        return $this->corpo;
    }
    
    public function setCorpo($corpo)
    {
        $this->corpo = $corpo;
    }

    public function getFonte()
    {
        return $this->fonte;
    }
    
    public function setFonte($fonte)
    {
        $this->fonte = $fonte;
    }

    public function getPunteggio()
    {
        return $this->punteggio;
    }
    
    public function setPunteggio($punteggio)
    {
        $this->punteggio = $punteggio;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }
    
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getDomanda()
    {
        return $this->domanda;
    }
    
    public function setDomanda($domanda)
    {
        $this->domanda = $domanda;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getLink()
    {
        return $this->link;
    }
    
    public function setLink($link)
    {
        $this->link = $link;
    }
    
    public function getTableName(): string
    {
        return Notizia::TABLENAME;
    }
    
    public function getColumn(): array{
        {
            return array(
                "idNotizia" => $this->idNotizia,
                "titolo" => $this->titolo,
                "corpo" => $this->corpo,
                "fonte" => $this->fonte,
                "punteggio" => $this->punteggio,
                "idCategoria" => $this->idCategoria,
                "idDomanda" => $this->idDomanda,
                "categoria" => $this->categoria,
                "domanda" => $this->domanda
            );
        }
    }
}

