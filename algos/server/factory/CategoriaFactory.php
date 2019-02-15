<?php
namespace algos\server\factory;

require_once __DIR__ . '/../required/autoload.php';

class CategoriaFactory extends AbstractFactory {
    private $instance;
    
    private function __construct() {
        
    }
    
    public function instance(): CategoriaFactory {
        if(CategoriaFactory::$instance == NULL)
            CategoriaFactory::$instance = new CategoriaFactory();
        return CategoriaFactory::$instance;
    }
    
    public function addCategoria($param):void {
        ;
    }
    
    public function getCategoria($param): Categoria {
        ;
    }
    
    public function removeCategoria($param): Categoria {
        ;
    }
    
    public function updateCategoria($param): void{
        ;
    }
}

