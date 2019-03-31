<?php
namespace algos\server\config;

require_once __DIR__ . '/../required/autoload.php';

class Configuration {
    private static $instance;
    private $confFile = __DIR__ . "/config.ini";
    private $conf;
    
    private function __construct(){
        $this->conf = parse_ini_file($this->confFile);     
    }
    
    public function instance(): Configuration{
        if(Configuration::$instance == NULL)
            Configuration::$instance = new Configuration();
        return Configuration::$instance;
    }
    
    public function getParam(string $name): string{
        if(array_key_exists($name, $this->conf))
            return $this->conf[$name];
        else
            return null;
    }
    
    public static function reloadConfig(): void{
        Configuration::$instance = NULL;
    }
}

