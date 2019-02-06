<?php
namespace algos\server\config;

class Configuration {
    private $instance;
    private $confFile = "config.ini";
    private $conf;
    
    private function __construct(){
        $conf = parse_ini_file($confFile);     
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
    
    public function reloadConfig(): void{
        unset($this);
    }
}

