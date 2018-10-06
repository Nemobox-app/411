<?php
namespace FOO;

class NotifyToLog extends Notification {
    public $config;
    public $logdir;
    public $logfile;
    private $LogToWrite;

    public function __construct()
    {
        $this->config = Config::get('notification');
        $this->logdir = $this->config['logpath'];
        $this->logfile = $this->config['logfile'];
        $this->LogToWrite = $this->logdir . DIRECTORY_SEPARATOR . $this->logfile;
    }

    protected function notify($to, $from, $title, $message, $file = null)
    {
        $data  = 'Message To: ' . $to . PHP_EOL;
        $data .= 'Message From: ' . $from . PHP_EOL;
        $data .= 'Subject: ' . $title . PHP_EOL;
        $data .= 'Body: ' . $message . PHP_EOL;
        return file_put_contents($this->LogToWrite, $data . PHP_EOL , FILE_APPEND | LOCK_EX);
    }
}