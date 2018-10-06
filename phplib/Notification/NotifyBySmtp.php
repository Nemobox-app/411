<?php
namespace FOO;

use PHPMailer\PHPMailer\PHPMailer;

class NotifyBySmtp extends Notification {

    public $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer;
        $this->mailer->isSMTP();
        $this->mailer->clearAttachments();
        $this->mailer->Host         = 'smtp server';
        $this->mailer->Port         = SMTPPORT;
        $this->mailer->SMTPAuth     = true;
        $this->mailer->Username     = SMTPUSER;
        $this->mailer->Password     = SMTPPASS;
        $this->mailer->SMTPSecure   = 'tls';

        $mail->setFrom(SMTPUSER, SITENAME);
        $mail->addAddress($email, $email);

        $mail->isHTML(true);

        $mail->Body    = "Someone attempted to reset your password at  <strong>" . SITENAME;
        $mail->AltBody = "Someone attempted to reset";
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    protected function notify($to, $from, $title, $message, $file = null)
    {
        $this->mailer->addAddress($to);
        $this->mailer->Subject  = $title;
        $this->mailer->Body     = $message;
        $this->mailer->AltBody  = strip_tags($message);

        // TODO: handle attachments

        if(!$this->mailer->send()) {
            # Log an error somewhere
        } else {
            # Log success
        }

        return;
    }
}