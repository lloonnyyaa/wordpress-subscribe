<?php

namespace vds\component;

interface MailerInterface {

    public function send($email, $subject, $body, $from, $contentType = 'text/html');

    public function sendAll($emails, $subject, $body, $from);
}
