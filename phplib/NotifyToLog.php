<?php
namespace FOO;

class NotifyToLog {

    public $directory;
    public $file;

    public function __construct()
    {
        // create empty file if it doesn't exist
        $this->file = '411.log';
        $this->directory = '/tmp';
        $this->CreateLogFileIfNotExists();

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

    private function CreateLogFileIfNotExists()
    {
        if(!is_file($this->directory . DIRECTORY_SEPARATOR . $this->file)){
            file_put_contents($this->directory . DIRECTORY_SEPARATOR . $this->file, "Start of log");
        }
    }

    public function notify($to, $subject, $message, $file = null)
    {
        $data  = 'Message To: ' . $to . PHP_EOL;
        $data .= 'Subject: ' . $subject . PHP_EOL;
        $data .= 'Body: ' . $message . PHP_EOL;
        return file_put_contents($this->directory . DIRECTORY_SEPARATOR . $this->file, $data . PHP_EOL , FILE_APPEND | LOCK_EX);
    }
}