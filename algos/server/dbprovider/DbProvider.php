<?php
namespace algos\server\dbprovider;

use algos\server\config\Configuration;
use algos\server\entity\Entity;
use Exception;
use mysqli;
require_once __DIR__ . '/../required/autoload.php';

class DbProvider implements DbProviderInterface {

    /**
     * Provider per il linguaggio MySQL
     */
    private static $instance;

    private $connection;

    private function __construct() {
        $this->connection = new mysqli(
            Configuration::instance()->getParam("host"),
            Configuration::instance()->getParam("username"),
            Configuration::instance()->getParam("password"),
            Configuration::instance()->getParam("dbname"),
            Configuration::instance()->getParam("port"));
        if ($this->connection->connect_error)
            throw new Exception(
                "Database connection error: " . $this->connection->connect_errno);
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
        foreach ($arr as $k => $v) {
            $res .= $k . ", ";
        }
        return substr($res, 0, - 2); // elimina l'ultima virgola
    }

    public function get(Entity $T): Entity {
        $var = "SELECT " . $this->formatColmn($T->getColumn());
        $var .= " FROM " . $T->getTableName();
        
        $res = $this->connection->query($var);
        return $res->fetch_object($T->getClassName());
    }

    public function select(Entity $T): array {
        $var = "SELECT " . $this->formatColmn($T->getColumn());
        $var .= " FROM " . $T->getTableName();
        
        $res = $this->connection->query($var);
        $arr = array();
        while ($obj = $res->fetch_object($T->getClassName())) {
            $arr[] = $obj;
        }
        return $arr;
    }

    public function selectWhereClause(Entity $T, array $whereclause): array {
        $var = "SELECT " . $this->formatColmn($T->getColumn());
        $var .= " FROM " . $T->getTableName();
        $var .= " WHERE ";
        foreach ($whereclause as $c) {
            $var .= $c . " AND ";
        }
        $sql = substr($var, 0, - 4); // elimina l'AND finale
        
        $res = $this->connection->query($sql);
        // echo $sql;
        $arr = array();
        while ($obj = $res->fetch_object($T->getClassName())) {
            $arr[] = $obj;
        }
        return $arr;
    }

    public function save(Entity $obj): bool {
        $sql = "INSERT INTO " . $obj->getTableName();
        $sql .= " (" . $this->formatColmn($obj->getColumn()) . ") ";
        $sql .= "VALUES (";
        foreach ($obj->getColumn() as $k => $v) {
            if ($v === null)
                $sql .= " NULL,";
            else
                $sql .= "'$v',";
        }
        $sql = substr($sql, 0, - 1);
        $sql .= ") ";
        
        //echo "$sql <br/>";
        return (($this->connection->query($sql)) ? true : false);
    }

    public function update(Entity $old, Entity $new): bool {
        $sql = "UPDATE " . $old->getTableName() . " SET ";
        foreach ($new->getColumn() as $k => $v) {
            if ($v === null)
                $sql .= $k . " = NULL,";
            else
                $sql .= $k . " = '" . $v . '\',';
        }
        $sql = substr($sql, 0, - 1);
        
        $sql .= " WHERE ";
        foreach ($old->getColumn() as $k => $v) {
            if ($v === null)
                $sql .= $k . " IS NULL AND ";
            else
                $sql .= $k . " = '" . $v . '\' AND ';
        }
        $sql = substr($sql, 0, - 4);
        
        return ($this->connection->query($sql) ? true : false);
    }

    public function delete(Entity $obj): bool {
        $sql = "DELETE FROM " . $obj->getTableName();
        $sql .= " WHERE ";
        foreach ($obj->getColumn() as $k => $v){
            if ($v === null)
                $sql .= $k . " IS NULL AND ";
            else
                $sql .= $k . " = '" . $v . '\' AND ';
        }
        $sql = substr($sql, 0, - 4);
        
        if ($this->connection->query($sql)){
            return true;
        }else {
            return false;
        }
    }

    public function beginTransaction(): bool {
        return $this->connection->begin_transaction();
    }

    public function commitTransaction(): bool {
        return $this->connection->commit();
    }

    public function rollbackTransaction(): bool {
        return $this->connection->rollback();
    }
}
