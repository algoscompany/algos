<?php
namespace algos\server\dbprovider;

use algos\server\entity\Entity;

class DbProvider implements DbProviderInterface {

    /**
     * Provider per il linguaggio MySQL
     */
    
    private static $instance;
    private $connection;
    
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
        $var = "SELECT " . $this->formatColmn($T . getColumnName());
        $var .= " FROM " . $T.getTableName();
        $var .= " WHERE ";
        foreach ($c as $whereclause){
            $var .= $c . " AND ";
        }
        var $sql = substr($var, 0, - 4);    //elimina l'AND finale
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
