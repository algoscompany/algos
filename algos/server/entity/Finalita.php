<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Finalita extends Entity {

    private $TABLENAME = "Finalita";

    private $id;

    private $descrizione;

    private $fileAllegato;

    public function __construct(int $id = EMPTYVAL, string $descrizione = EMPTYVAL,
        string $fileAllegato = EMPTYVAL) {
        $this->id = $id;
        $this->descrizione = $descrizione;
        $this->fileAllegato = $fileAllegato;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDescrizione(): string {
        return $this->descrizione;
    }

    public function setDescrizione($descrizione): void {
        $this->descrizione = $descrizione;
    }

    public function getFileAllegato(): string {
        return $this->fileAllegato;
    }

    public function setFileAllegato($fileAllegato): void {
        $this->fileAllegato = $fileAllegato;
    }

    public function getTableName(): string {
        return Finalita::TABLENAME;
    }

    public function getColumn(): array {
        return array(
            "id" => $this->id,
            "descrizione" => $this->descrizione,
            "fileAllegato" => $this->fileAllegato
        );
    }
}

