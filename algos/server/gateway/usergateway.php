<?php
use function algos\server\entity\Categoria\getIdCategoria;
use algos\server\factory\DomandaProvider;
use algos\server\factory\NotiziaProvider;
use algos\server\factory\UtenteProvider;


function getPasswordToken(string $json) {
    $var = json_decode($json);
    $email = $var->email;
    $user = UtenteProvider::instance()->getUtenteFromEmail($email);
    $token = $user->getToken();
    $array = array(
        "token" => $token
    );
    echo json_encode($array);
}

function login(string $json) {
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

function logout() {
    $logout = UtenteProvider::instance()->logout();
    $token = $logout->getToken();
    $array = array(
        "token" => $token
    );
    echo json_encode($array);
}

function registrazioneUtente($json) {
    $var = json_decode($json);
    $email = $var->email;
    $nome = $var->nome;
    $cognome = $var->cognome;
    $password = $var->password;
    $user = UtenteProvider::instance()->registraUtente($email, $nome, $cognome,
        $password);
    if ($user == true)
        $array = array(
            "email" => $email,
            "nome" => $nome,
            "cognome" => $cognome,
            "password" => $password
        );
    echo json_encode($array);
}

function cancellaUtente() {
    $cancella = UtenteProvider::instance()->cancellaUtente();
    $token = $cancella->getToken();
    $array = array(
        "token" => $token
    );
    echo json_encode($array);
}

function existEmail($json) {
    $existEmail = json_decode($json);
    $user = UtenteProvider::instance()->existEmail($existEmail);
    if ($user == true) {
        $array = array(
            "result" => $existEmail
        );
        echo json_encode($array);
    } else {
        $array = array(
            "result" => $existEmail
        );
        echo json_encode($array);
    }
}

function recoverPassword($email) {
    $recover = UtenteProvider::instance()->recoverPassword($email);
    $token = $recover->getToken();
    $array = array(
        "token" => $token
    );
    echo json_encode($array);
}

function resetPassword($email) {
    $reset = UtenteProvider::instance()->resetPassword($email, $key);
    $token = $reset->getToken();
    $array = array(
        "token" => $token
    );
    echo json_encode($array);
}

function getUtenteInfo() {
    $info = UtenteProvider::instance()->getLoggedUser();
    $array = array(
        "email" => $email,
        "nome" => $nome,
        "cognome" => $cognome,
        "eustress" => $eustress,
        "distress" => $distress,
        "administrator" => $administrator
    );
    echo json_encode($array);
}

function updateUtente($json) {
    $var = json_decode($json);
    $email = $var->email;
    $nome = $var->nome;
    $cognome = $var->cognome;
    $array = array(
        "email" => $email,
        "nome" => $nome,
        "cognome" => $cognome
    );
    echo json_encode($array);
}

function getOverviewNotizie($param) {
    ;
}

function getNotizia($json) {
    $val = json_decode($json);
    $id = $val->idNotizia;
    
    $var = NotiziaProvider::instance()->getNotizia($id);
    if ($var != NULL) {
        $res = array(
            "idNotizia" => $var->getIdNotizia(),
            $res = array(
                "idNotizia" => $var->getIdNotizia(),
                "titolo" => $var->getTitolo(),
                "corpo" => $var->getCorpo(),
                "fonte" => $var->getFonte(),
                "idCategoria" => $var->getCategoria() - getIdCategoria(),
                "categoria" => $var->getCategoria()
            )
        );
        echo json_encode($res);
    } else {
        $res = array(
            "result" => "NULL"
        );
        echo json_encode($res);
    }
}

function searchNotizie($json) {
    $val = json_decode($json);
    $titolo = $val->titolo;
    $idCategoria = $val->idcategoria;
    
    $var = NotiziaProvider::instance()->getNotizia($id);
    if ($var != NULL) {
        $res = array(
            "idNotizia" => $var->getIdNotizia(),
            $res = array(
                "idNotizia" => $var->getIdNotizia(),
                "titolo" => $var->getTitolo(),
                "corpo" => $var->getCorpo(),
                "fonte" => $var->getFonte(),
                "idCategoria" => $var->getCategoria() - getIdCategoria(),
                "categoria" => $var->getCategoria()
            )
        );
        echo json_encode($res);
    }
}

function getDomande() {
    $arr = DomandaProvider::instance()->getDomande();
    
    echo json_encode($arr);
}

function getOverviewNotizie($param) {
    ;
}