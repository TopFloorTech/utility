<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 3/16/2016
 * Time: 12:58 PM
 */

namespace TopFloor\Utility\MailHandlers;


use Swift_Mailer;

interface MailHandlerInterface {
    /**
     * @return Swift_Mailer
     */
    public function getMailer();
}