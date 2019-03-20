<?php
use algos\server\entity\Utente;
use algos\server\factory\DomandaProvider;
use algos\server\factory\NotiziaProvider;
use algos\server\factory\UtenteProvider;

function getPasswordToken(string $json) { // OK
    $var = json_decode($json);
    $email = $var->email;
    
    $user = UtenteProvider::instance()->getUtenteFromEmail($email);
    $oldUser = clone $user;
    
    $token = $user->getToken();
    $user->increaseToken();
    
    UtenteProvider::instance()->updateUtente($oldUser, $user);
    
    $array = array(
        "token" => $token
    );
    echo json_encode($array);
}

function login(string $json) {  //OK
    $val = json_decode($json);
    $email = $val->email;
    $key = $val->key;
    
    if (UtenteProvider::instance()->login($email, $key)) {
        $res = array(
            "result" => "ok"
        );
    } else {
        $res = array(
            "result" => "notok"
        );
    }
    echo json_encode($res);
}

function logout() { //OK
    $logout = UtenteProvider::instance()->logout();
    if ($logout) {
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

function registrazioneUtente($json) {       //OK
    $var = json_decode($json);
    $email = $var->email;
    $nome = $var->nome;
    $cognome = $var->cognome;
    $password = $var->password;
    $user = UtenteProvider::instance()->registraUtente($email, $nome, $cognome,
        $password);
    if ($user) {
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

function cancellaUtente() {     //OK
    $cancellato = UtenteProvider::instance()->cancellaUtente();
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

function existEmail($json) {     // OK
    $var = json_decode($json);
    $email = $var->email;
    $exist = UtenteProvider::instance()->existEmail($email);
    $res = array(
        "result" => $exist
    );
    echo json_encode($res);
}

function recoverPassword($json) {
    $var = json_decode($json);
    $email = $var->email;
    $res = UtenteProvider::instance()->recoverPassword($email);
    $array = array(
        "result" => $res
    );
    echo json_encode($array);
}

function resetPassword($json) {
    $var = json_decode($json);
    $email = $var->email;
    $key = $var->key;
    
    $reset = UtenteProvider::instance()->resetPassword($email, $key);
    $res = array(
        "result" => $reset
    );
    echo json_encode($res);
}

function getUtenteInfo() {      //OK
    $info = UtenteProvider::instance()->getLoggedUser();
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

function updateUtente($json) {
    $var = json_decode($json);
    $email = $var->email;
    $nome = $var->nome;
    $cognome = $var->cognome;
    $old = UtenteProvider::instance()->getLoggedUser();
    $new = new Utente($email, $nome, $cognome);
    
    $res = UtenteProvider::instance()->updateUtente($old, $new);
    $ra = array(
        "result" => (($res) ? "ok" : "notok")
    );
    echo json_encode($ra);
}

function getDomande() {          //OK
    $arr = DomandaProvider::instance()->getDomande();
    $res = array();
    foreach ($arr as $dom)
        if ($dom->isVisible())
            $res[] = $dom;
    
    echo json_encode($res);
}

function getNotizia($json) {        //OK
    $val = json_decode($json);
    $id = $val->idNotizia;
    
    $res = encodeNotiziaById($id);
    
    echo json_encode($res);
}

/**
 * Restituisce un array con una singola notizia.
 * Restituisce codificati: idNotizia, titolo, corpo, fonte, idCategoria e categoria (nome).
 */
function encodeNotiziaById($id): array {        //OK(vedi getNotizia)
    $var = NotiziaProvider::instance()->getNotizia($id);
    if ($var != NULL) {
        $res = array(
            "idNotizia" => $var->getIdNotizia(),
            "titolo" => $var->getTitolo(),
            "corpo" => $var->getCorpo(),
            "fonte" => $var->getFonte(),
            "idCategoria" => $var->getCategoria()->getIdCategoria(),
            "categoria" => $var->getCategoria()->getNome()
        );
    } else {
        $res = array(
            "result" => "NULL"
        );
    }
    return $res;
}

function searchNotizie($json) {
    $val = json_decode($json);
    $titolo = $val->titolo;
    $idCategoria = $val->idcategoria;
    
    // TODO search notizie per nome o categoria
}

function getOverviewNotizie() {
    $customNotizie = NotiziaProvider::instance()->getCustomNotizie(
        UtenteProvider::instance()->getLoggedUser());
    
    $res = array();
    foreach ($customNotizie as $n) {
        $rn = array(
            "idNotizia" => $n->getIdNotizia(),
            "titolo" => $n->getTitolo(),
            "idCategoria" => $n->getCategoria()->getIdCategoria(),
            "categoria" => $n->getCategoria()->getNome()
        );
        $res[] = $rn;
    }
    
    echo json_encode($res);
}