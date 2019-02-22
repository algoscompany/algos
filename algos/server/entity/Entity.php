<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';

abstract class Entity {

    abstract public function getTableName(): string;

    abstract public function getColumn(): array;

    public function getClassName(): string {
        return get_class($this);
    }
}