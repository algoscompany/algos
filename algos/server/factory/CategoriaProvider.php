<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Categoria;

require_once __DIR__ . '/../required/autoload.php';

class CategoriaProvider extends AbstractProvider {
    private $instance;
    
    private function __construct() {
        
    }
    
    public function instance(): CategoriaProvider {
        if(CategoriaProvider::$instance == NULL)
            CategoriaProvider::$instance = new CategoriaProvider();
        return CategoriaProvider::$instance;
    }
    
    public function addCategoria(string $nome):void {
        $cat = new Categoria($nome);
        DbProvider::instance()->save($cat);
    }
    
    public function getCategoria(int $id): Categoria {
        return DbProvider::instance()->selectWhereClause(Categoria, array("idCategoria = ".$id));
    }
    
    public function removeCategoria(int $id): Categoria {
        $cat = $this->getCategoria($id);
        $res = NULL;
        if(!NULL)
            $res = DbProvider::instance()->delete($cat);
        return $res;
    }
    
    public function updateCategoria($param): void{
        ;//TODO
    }
}

