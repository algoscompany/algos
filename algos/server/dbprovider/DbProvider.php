<?php
namespace algos\server\dbprovider;

use algos\server\entity\Entity;

class DbProvider implements DbProviderInterface{
    public function select(Entity $T): Entity
    {}

    public function save(Entity $obj): bool
    {}

    public function update(Entity $obj): bool
    {}

    public function delete(Entity $obj): Entity
    {}

    public function saveOrUpdate(Entity $obj): bool
    {}

    
}

