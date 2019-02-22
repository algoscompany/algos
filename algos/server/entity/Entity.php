<?php
namespace algos\server\entity;

abstract class Entity {
    abstract public function getTableName(): string;
    abstract public function getColumn(): array;
    
}