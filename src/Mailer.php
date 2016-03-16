<?php

namespace TopFloor\Utility;

use Exception;
use TopFloor\Exceptions\UtilityException;
use TopFloor\Utility\MailHandlers\MailHandlerInterface;

class Mailer {
    /** @var \Swift_Mailer $Mailer */
    public static $Mailer;

    public static $config;

    /** @var MailHandlerInterface */
    protected static $handler;

    protected static $initialized = false;

    public static $handlers = [
        'mandrill' => '\\TopFloor\\Utility\\MailHandlers\\MandrillMailHandler',
        'smtp' => '\\TopFloor\\Utility\\MailHandlers\\SmtpMailHandler',
    ];

    public static function initialize() {
        if (self::$initialized) {
            return;
        }

        self::$config = Config::get('mail');

        $protocol = self::$config['protocol'];

        if (!array_key_exists(strtolower($protocol), self::$handlers)) {
            throw new UtilityException('Mailer protocol ' . $protocol . ' could not be located.');
        }

        try {
            $className = self::$handlers[$protocol];
            self::$handler = new $className(self::$config);
            self::$Mailer = self::$handler->getMailer();

            self::$initialized = true;
        } catch (Exception $e) {
            throw new UtilityException("Unable to initialize handler", 50, $e);
        }
    }

    /**
     * @param $subject
     * @return \Swift_Message
     * @throws \TopFloor\Exceptions\UtilityException
     */
    public static function newMessage($subject) {
        self::initialize();

        try {
            return \Swift_Message::newInstance($subject);
        } catch (Exception $e) {
            throw new UtilityException("Unable to create message", 75, $e);
        }
    }

    /**
     * @param $message
     * @return int
     * @throws \TopFloor\Exceptions\UtilityException
     */
    public static function send($message) {
        self::initialize();

        try {
            return self::$Mailer->send($message);
        } catch (Exception $e) {
            throw new UtilityException("Unable to send message", 100, $e);
        }
    }
}