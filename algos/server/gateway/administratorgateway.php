<?php
use algos\server\entity\Categoria;
use algos\server\entity\Utente;

function inserisciCategoria($json) {
    $var = json_decode($json);
    $id = $var->idCategoria;
    $nome = $var->nome;
    $cat = Categoria::instance()->addCategoria($nome);
    if ($cat) {
        $array = array(
            "result" => "ok"
        );
    } else {
        $array = array(
            "result" => "notok"
        );
    }
    echo json_encode($array);
}

function aggiornaCategoria($json) {
    $var = json_decode($json);
    $id = $var->idCategoria;
    $nome = $var->nome;
    $old = Categoria::instance()->getCategoria();
    $new = new Utente($email, $nome, $cognome);
    
    $res = Categoria::instance()->updateCategoria($old, $new);
    $ra = array(
        "result" => (($res) ? "ok" : "notok")
    );
    echo json_encode($ra);
}

function eliminaCategoria($json) {
    $var = json_decode($json);
    $id = $var->idCategoria;
    $cancellato = Categoria::instance()->eliminaCategoria($id);
    if ($cancellato) {
        $array = array(
            "result" => "ok"
        );
    } else {
        $array = array(
            "result" => "notok"
        );
    }
    echo json_encode($array);
}

function getCategorie() {//Da finire
    $info = Categoria::instance()->getCategoria();
    if ($info != null) {
        $array = array(
            "email" => $info->getEmail(),
            "nome" => $info->getNome(),
            "cognome" => $info->getCognome(),
            "eustress" => $info->getEustress(),
            "distress" => $info->getDistress(),
            "administrator" => (($info->getDistress() == 1) ? true : false)
        );
    } else
        $array = array(
            "NULL"
        );
        echo json_encode($array);
}

function inserisciNotizia() {
    
}

function eliminaNotizia() {
    
}

function aggiornaNotizia() {
    
}

function inserisciDomanda() {
    
}

function nascondiDomanda() {
    
}

function opUtente() {
    
}

function deopUtente() {
    
}