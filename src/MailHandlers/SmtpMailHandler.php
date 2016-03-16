<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 3/16/2016
 * Time: 12:01 PM
 */

namespace TopFloor\Utility\MailHandlers;

use Swift_Mailer;
use Swift_SmtpTransport;

class SmtpMailHandler extends MailHandler {
    public function getMailer() {
        $transport = new Swift_SmtpTransport($this->config['host'], $this->config['port'], $this->config['security']);

        $transport->setUsername($this->config['username'])
            ->setPassword($this->config['password']);

        return Swift_Mailer::newInstance($transport);
    }
}
