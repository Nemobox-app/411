<?php
namespace FOO;

use PHPMailer\PHPMailer\PHPMailer;

class NotifyBySmtp {

    public $smtphost;
    public $smtpport;
    public $username;
    public $password;
    public $replyname;
    public $replyaddress;

    public function __construct($config)
    {
        $this->config = $config;
        $this->mailer = new PHPMailer;
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

    private function initialize()
    {
        $this->mailer->isSMTP();
        $this->mailer->clearAttachments();
        $this->mailer->isHTML(true);
        $this->mailer->Host         = $this->smtphost;
        $this->mailer->Port         = $this->smtpport;
        $this->mailer->Username     = $this->username;
        $this->mailer->Password     = $this->password;
        $this->mailer->SMTPAuth     = true;
        $this->mailer->SMTPSecure   = 'tls';
        $this->mailer->setFrom($this->replyaddress, $this->replyname);

    }
    public function notify($to, $title, $message, $file = null)
    {
        $this->initialize();
        $this->mailer->addAddress($to);
        $this->mailer->Subject  = $title;
        $this->mailer->Body     = $message;
        $this->mailer->AltBody  = strip_tags($message);

        // TODO: handle attachments

        if(!$this->mailer->send()) {
            # Log an error
        } else {
            # Log success
        }

        return;
    }
}