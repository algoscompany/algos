<?php
namespace algos\server\dbprovider;

use algos\server\entity\Entity;

interface DbProviderInterface{
    public function select(Entity $T): Entity;
    public function select(Entity $T, array $whereclause): array;
    public function save(Entity $obj): bool;
    public function update(Entity $obj): bool;
    public function saveOrUpdate(Entity $obj): bool;
    public function delete(Entity $obj): Entity;
}

