<?php
namespace algos\server\utility;

class Email
{

    private static $nomeMittente;
    
    private static $mailMittente;
   
    private static $mail_headers;
    
    public static function sendEmail(string $oggetto, string $messaggio) 
    {
        Email:: $mail_headers= "From: " .  Email::$nomeMittente . " <" .  Email::$mailMittente . ">\r\n";
        Email::$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail(Email::$mailMittente, $oggetto, $messaggio, Email:: $mail_headers);
    }
}

