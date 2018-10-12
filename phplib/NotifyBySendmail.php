<?php
namespace FOO;

class NotifyBySendmail {

    public $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function notify($to, $subject, $message, $headers = null)
    {
        return mail($to, $subject, $message, $headers);
    }
}