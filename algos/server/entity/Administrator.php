<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';

class Administrator extends Utente {

    public function __construct($username, $password) {
        parent::__construct($username, $password);
    }
}

