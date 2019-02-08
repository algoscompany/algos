<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';

class Categoria extends Entity {

    private const TABLENAME = "Categoria";

    private $idCategoria;

    private $nome;

    public function __construct(string $nome) {
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
                "Nome" => $this->nome
        );
    }
}

