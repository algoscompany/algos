<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Categoria extends Entity {

    private const TABLENAME = "Categoria";

    private $idCategoria;

    private $nome;
    
    public function __construct($p1 = EMPTYVAL, $p2 = EMPTYVAL){
        $args = func_get_args();
        clear_array_args($args);
        call_overload($this, $args, "__construct");
    }

    public function __construct0(string $nome) {
        $this->nome = $nome;
    }
    
    public function __construct1(int $id, string $nome) {
        $this->idCategoria = $id;
        $this->nome = $nome;
    }
    
    public function getIdCategoria(): int {
        return $this->idCategoria;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getTableName(): string {
        return Categoria::TABLENAME;
    }

    public function getColumn(): array {
        return array(
                "idCategoria" => $this->idCategoria,
                "nome" => $this->nome
        );
    }
}

