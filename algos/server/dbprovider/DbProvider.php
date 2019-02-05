<?php
namespace algos\server\dbprovider;

use algos\server\entity\Entity;
use Exception;
use mysqli;

class DbProvider implements DbProviderInterface {

    /**
     * Provider per il linguaggio MySQL
     */
    private static $instance;

    private $connection;

    private function __construct() {
        $this->connection = new mysqli('localhost', 'my_user', 'my_password', 'my_db');
        if ($this->connection->connect_error)
            throw new Exception("Database connection error: " . $this->connection->connect_errno);
    }

    public function __destruct() {
        $this->connection->close();
    }

    public static function instance(): DbProviderInterface {
        if (DbProvider::$instance == NULL)
            DbProvider::$instance = new DbProvider();
        return DbProvider::$instance;
    }

    private function formatColmn(array $arr): string {
        $res = "";
        foreach ($arr as $val) {
            $res .= $val . ", ";
        }
        return substr($res, 0, - 1); // elimina l'ultima virgola
    }

    public function select(Entity $T): Entity {
        $var = "SELECT " . $this->formatColmn($T . getColumnName());
        $var .= " FROM " . $T . getTableName();
        
        $res = $this->connection->query($var);
        return $res->fetch_object($T->getClassName());
    }

    public function select(Entity $T, array $whereclause): array {
        $var = "SELECT " . $this->formatColmn($T . getColumnName());
        $var .= " FROM " . $T . getTableName();
        $var .= " WHERE ";
        foreach ($c as $whereclause) {
            $var .= $c . " AND ";
        }
        $sql = substr($var, 0, - 4); // elimina l'AND finale
        
        $res = $this->connection->query($var);
        $arr = array();
        while ($obj = $res->fetch_object($T->getClassName())) {
            $arr[] = $obj;
        }
        
        return $arr;
    }

    public function save(Entity $obj): bool {}

    public function update(Entity $obj): bool {}

    public function saveOrUpdate(Entity $obj): bool {
        if ($this->update($obj))
            return true;
        else if ($this->save($obj))
            return true;
        else
            return false;
    }

    public function delete(Entity $obj): Entity {}
}
