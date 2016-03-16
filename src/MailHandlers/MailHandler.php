<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 3/16/2016
 * Time: 12:58 PM
 */

namespace TopFloor\MailHandlers;


abstract class MailHandler {
    protected $config;

    public function __construct($config) {
        $this->config = $config;
    }

    abstract function getMailer();
}