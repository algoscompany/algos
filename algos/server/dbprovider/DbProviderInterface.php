<?php
namespace algos\server\dbprovider;

use algos\server\entity\Entity;

interface DbProviderInterface {

    public function get(Entity $T): Entity;
    
    public function select(Entity $T): array;

    public function selectWhereClause(Entity $T, array $whereclause): array;

    public function save(Entity $obj): bool;

    public function update(Entity $old, Entity $new): bool;

    public function delete(Entity $obj): bool;

    public function beginTransaction(): bool;

    public function commitTransaction(): bool;

    public function rollbackTransaction(): bool;
}

