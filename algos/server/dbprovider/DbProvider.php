<?php
namespace algos\server\dbprovider;

use algos\server\entity\Entity;

class DbProvider implements DbProviderInterface {
    /**Provider per il linguaggio MySQL*/

    public function select(Entity $T): Entity {
        $var = "";
        
    }
    
    public function select(Entity $T, array $whereclause): array {
        
    }

    public function save(Entity $obj): bool {

    }

    public function update(Entity $obj): bool {

    }

    public function saveOrUpdate(Entity $obj): bool {
        if($this->update($obj))
            return true;
        else if($this->save($obj))
            return true;
        else
            return false;
    }

    public function delete(Entity $obj): Entity {

    }
}

