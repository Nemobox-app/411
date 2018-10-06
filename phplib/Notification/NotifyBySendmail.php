<?php
namespace FOO;

class NotifyBySendmail extends Notification {
    protected function notify($to, $subject, $message, $headers = null)
    {
        return mail($to, $subject, $message, $headers);
    }
}