<?php
namespace algos\server\factory;

use algos\server\dbprovider\DbProvider;
use algos\server\entity\Categoria;
require_once __DIR__ . '/../required/autoload.php';

class CategoriaProvider extends AbstractProvider {

    private static $instance;

    private function __construct() {}

    public static function instance(): CategoriaProvider {
        if (CategoriaProvider::$instance == NULL)
            CategoriaProvider::$instance = new CategoriaProvider();
        return CategoriaProvider::$instance;
    }

    public function addCategoria(string $nome): void {
        $cat = new Categoria($nome);
        DbProvider::instance()->save($cat);
    }

    public function getCategoria(int $id): Categoria {
        return DbProvider::instance()->selectWhereClause(new Categoria(),
            array(
                "idCategoria = " . $id
            ))[0];
    }

    public function removeCategoria(int $id): Categoria {
        $cat = $this->getCategoria($id);
        $res = NULL;
        if (! NULL)
            $res = DbProvider::instance()->delete($cat);
        return $res;
    }

    public function updateCategoria(Categoria $old, Categoria $new): bool {
        return DbProvider::instance()->update($old, $new);
    }
}

