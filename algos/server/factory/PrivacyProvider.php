<?php
namespace algos\server\factory;

require_once __DIR__.'/../required/autoload.php';

session_start();
    
use DateTime;

class PrivacyProvider
{

    private $instance;
    
    private function __construct()
    {
    }
    
    public function instance(): PrivacyProvider{
        
        if(PrivacyProvider::$instance == NULL)
            PrivacyProvider::$instance = new PrivacyProvider();
        return PrivacyProvider::$instance;
    }
    
    public function prestaConsenso(int $idFinalita, DateTime $dataOraAccettazione): bool
    {
        $app = new Consenso($idFinalita, $_SESSION['user']->getEmail(), $dataOraAccettazione);
        return DbProvider::instance()->save($app);
    }
        
    public function revocaConsenso(int $idFinalita): bool
    {
        return DbProvider::instance()->selectWhereClause(Consenso, 
            array(
                "idFinalita = $idFinalita",
                "idUtente = ".$_SESSION['user']->getEmail()
            ));
    }
        
    public function inserisciFinalita(Finalita $finalita): bool
    {
        return DbProvider::instance()->save($finalita);
    }
    
    public function eliminaFinalita(Finalita $finalita): bool
    {
        $app = DbPrrovider::instance()->selectWhereClause(Finalita, 
            array(
                "idFinalita = ".$finalita->getId()
            ));
        if($app==NULL){
            return DbProvider::instance()->delete($finalita);
        }
        return false;
    }
}

