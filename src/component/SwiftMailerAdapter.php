<?php

namespace vds\component;

class SwiftMailerAdapter implements MailerInterface{

    private $host;
    private $port;
    private $userName;
    private $password;
    private $encryption;
    private $mailer;

    public function __construct($host, $userName, $password, $port = 25, $encryption = null) {
        $this->host = $host;
        $this->port = $port;
        $this->userName = $userName;
        $this->password = $password;
        $this->encryption = $encryption;

        $this->setMailer();
    }

    private function setMailer() {
        $transport = (new \Swift_SmtpTransport($this->host, $this->port, $this->encryption))
                ->setUsername($this->userName)
                ->setPassword($this->password)

        ;

        $this->mailer = new \Swift_Mailer($transport);
    }

    public function sendAll($emails, $subject, $body, $from) {
        $sended = [];
        foreach ($emails as $email) {
            $sended[$email] = $this->send($email, $subject, $body, $from);
        }

        return $sended;
    }

    public function send($email, $subject, $body, $from, $contentType = 'text/html') {
        $message = (new \Swift_Message($subject))
                ->setFrom([$this->userName => $from])
                ->setTo($email)
                ->setBody($body, $contentType)
        ;

        try {
            return $this->mailer->send($message);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}
