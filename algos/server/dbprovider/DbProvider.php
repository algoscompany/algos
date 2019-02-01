<?php
namespace algos\server\dbprovider;

use algos\server\entity\Entity;

class DbProvider implements DbProviderInterface {

    /**
     * Provider per il linguaggio MySQL
     */
    
    private static $instance;
    
    private function __construct(){
        
    }
    
    public static function instance(): DbProviderInterface {
        if(DbProvider::$instance == NULL)
            DbProvider::$instance = new DbProvider();
        return DbProvider::$instance;
    }
    
    private function formatColmn(array $arr): string {
        $res = "";
        foreach ($arr as $val) {
            $res .= $val . ", ";
        }
        return substr($res, 0, - 1);    //elimina l'ultima virgola
    }

    public function select(Entity $T): Entity {
        $var = "SELECT " . $this->formatColmn($T . getColumnName());
        $var .= " FROM " . $T.getTableName();
    }

    public function select(Entity $T, array $whereclause): array {
    }

    public function save(Entity $obj): bool {
    }

    public function update(Entity $obj): bool {
    }

    public function saveOrUpdate(Entity $obj): bool {
        if ($this->update($obj))
            return true;
        else if ($this->save($obj))
            return true;
        else
            return false;
    }

    public function delete(Entity $obj): Entity {
    }
}
