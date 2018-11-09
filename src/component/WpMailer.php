<?php

namespace vds\component;

class WpMailer implements MailerInterface {

    const NUMBER_EMAILS = 20;

    public function sendAll($emails, $subject, $body, $from) {
        $parts = ceil(count($emails) / self::NUMBER_EMAILS);
        $emailParts = self::_arrayPartition($emails, $parts);

        $result = [];
        foreach ($emailParts as $emailsArr) {
            foreach ($emailsArr as $email) {
                $result[$email] = $this->send($email, $subject, $body, $from);
            }
            sleep(5);
        }

        return $result;
    }

    public function send($email, $subject, $body, $from, $contentType = 'text/html') {
        $headers = [
            "From: {$from} <noreply@example.net>",
            "content-type: {$contentType}"
        ];

        return wp_mail($email, $subject, $body, $headers);
    }

    private function _arrayPartition($list, $p) {
        $listlen = count($list);
        $partlen = floor($listlen / $p);
        $partrem = $listlen % $p;
        $partition = [];
        $mark = 0;

        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $slice = array_slice($list, $mark, $incr);

            if (!empty($slice))
                $partition[$px] = $slice;

            $mark += $incr;
        }

        return $partition;
    }

}
