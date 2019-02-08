<?php
namespace algos\server\entity;

class Administrator extends Utente
{

    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }
}

