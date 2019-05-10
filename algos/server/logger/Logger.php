<?php
namespace algos\server\logger;

use Exception;
require_once __DIR__ . '/../required/autoload.php';

class Logger {
    
    private static $instance;

    private $log_file;

    private $file;

    private $options = array(
        'dateFormat' => 'd-M-Y H:i:s'
    );
    
    public static function instance() {
        if(Logger::$instance == null)
            Logger::$instance = new Logger();
            return Logger::$instance;
    }
    
    private function __construct($log_file = null, $params = array()) {
        if($log_file == null)
            $log_file = __DIR__ . "/../../log/log.txt";
        $this->log_file = $log_file;
        $this->params = array_merge($this->options, $params);
        // Create log file if it doesn't exist.
        if (! file_exists($log_file)) {
            fopen($log_file, 'w') or exit("Can't create $log_file!");
        }
        // Check permissions of file.
        if (! is_writable($log_file)) {
            // throw exception if not writable
            throw new Exception("ERROR: Unable to write to file!", 1);
        }
    }

    public function info($message) {
        $this->writeLog($message, 'INFO');
    }

    public function debug($message) {
        $this->writeLog($message, 'DEBUG');
    }

    public function warning($message) {
        $this->writeLog($message, 'WARNING');
    }

    public function error($message) {
        $this->writeLog($message, 'ERROR');
    }

    public function writeLog($message, $severity) {
        // open log file
        if (! is_resource($this->file)) {
            $this->openLog();
        }
        // grab the url path ( for troubleshooting )
        $path = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        // Grab time - based on timezone in php.ini
        $time = date($this->params['dateFormat']);
        // Write time, url, & message to end of file
        fwrite($this->file, "[$time] [$path] : [$severity] - $message" . PHP_EOL);
    }

    private function openLog() {
        $openFile = $this->log_file;
        // 'a' option = place pointer at end of file
        $this->file = fopen($openFile, 'a') or exit("Can't open $openFile!");
    }

    public function __destruct() {
        if ($this->file) {
            fclose($this->file);
        }
    }
    
}