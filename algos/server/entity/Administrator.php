<?php
namespace algos\server\entity;

require_once __DIR__ . '/../required/autoload.php';
require_once __DIR__ . '/../required/method_overloader.php';

class Administrator extends Utente {

    public function __construct($username, $password) {
        parent::__construct($username, $password);
    }
}

