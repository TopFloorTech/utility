<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 3/16/2016
 * Time: 12:01 PM
 */

namespace TopFloor\Utility\MailHandlers;


use Accord\MandrillSwiftMailer\SwiftMailer\MandrillTransport;
use Swift_Events_SimpleEventDispatcher;
use Swift_Mailer;

class MandrillMailHandler extends MailHandler {
    public function getMailer() {
        $transport = new MandrillTransport(new Swift_Events_SimpleEventDispatcher());
        $transport->setApiKey($this->config['api_key']);

        return Swift_Mailer::newInstance($transport);
    }
}