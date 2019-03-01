<?php

use function algos\server\entity\Categoria\getIdCategoria;
use algos\server\factory\DomandaProvider;
use algos\server\factory\NotiziaProvider;
use algos\server\factory\UtenteProvider;

function getDomande() {
    $arr = DomandaProvider::instance()->getDomande();
    
    echo json_encode($arr);
}

function login(string $json) {
    $val = json_decode($json);
    $email = $val->email;
    $key = $val->key;
    
    if(UtenteProvider::instance()->login($email, $key)){
        $res = array("result" => "ok");        
    }else{
        $res = array("result" => "notok");
    }
    echo json_encode($res);
}

function getOverviewNotizie($param) {
    ;
}


function getNotizia($json) {
    $val = json_decode($json);
    $id = $val->idNotizia;
    
    $var=NotiziaProvider::instance()->getNotizia($id);
    if($var != NULL)
    {
        $res= array("idNotizia" => $var->getIdNotizia(),
            $res= array("idNotizia" => $var->getIdNotizia(),
                "titolo" => $var->getTitolo(),
                "corpo" => $var->getCorpo(),
                "fonte"=>$var->getFonte(),
                "idCategoria"=>$var->getCategoria()-getIdCategoria(),
                "categoria" =>$var->getCategoria()));
            echo json_encode($res);
    }
    else
    {
        $res=array("result"=>"NULL");
        echo json_encode($res);
        
    }
    
}

function searchNotizie($json) {
    $val = json_decode($json);
    $titolo = $val->titolo;
    $idCategoria = $val->idcategoria;
    
    $var=NotiziaProvider::instance()->getNotizia($id);
    if($var != NULL)
    {
        $res= array("idNotizia" => $var->getIdNotizia(),
            $res= array("idNotizia" => $var->getIdNotizia(),
                "titolo" => $var->getTitolo(),
                "corpo" => $var->getCorpo(),
                "fonte"=>$var->getFonte(),
                "idCategoria"=>$var->getCategoria()-getIdCategoria(),
                "categoria" =>$var->getCategoria()));
            echo json_encode($res);
    }
    
}


function getDomande($param) {
    ;
}

function getOverviewNotizie($param) {
    ;
}