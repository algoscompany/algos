<?php
namespace algos\server\dbprovider;

use algos\server\entity\Entity;

interface DbProviderInterface {

    public function select(Entity $T): Entity;

    public function selectWhereClause(Entity $T, array $whereclause): array;

    public function save(Entity $obj): bool;

    public function update(Entity $obj): bool;

    public function delete(Entity $obj): Entity;

    public function beginTransaction(): bool;

    public function commitTransaction(): bool;

    public function rollbackTransaction(): bool;
}

