<?php
namespace FOO;

class NotifyToLog {

    public $logdir;
    public $logfile;

    public function __construct()
    {
        $this->config = Config::get('notification');
        $this->logdir = $this->config['logpath'];
        $this->logfile = $this->config['logfile'];
        $this->LogToWrite = $this->logdir . DIRECTORY_SEPARATOR . $this->logfile;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }


    public function notify($to, $from, $title, $message, $file = null)
    {
        $data  = 'Message To: ' . $to . PHP_EOL;
        $data .= 'Message From: ' . $from . PHP_EOL;
        $data .= 'Subject: ' . $title . PHP_EOL;
        $data .= 'Body: ' . $message . PHP_EOL;
        return file_put_contents($this->logdir . DIRECTORY_SEPARATOR . $this->logfile, $data . PHP_EOL , FILE_APPEND | LOCK_EX);
    }
}