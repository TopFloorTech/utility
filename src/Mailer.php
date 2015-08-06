<?php

use Accord\MandrillSwiftMailer\SwiftMailer\MandrillTransport;

class Mailer {
    /** @var \Swift_Mailer $Mailer */
    public static $Mailer;

    public static $config;

    private static $initialized = false;

    public static function initialize() {
        if (self::$initialized) {
            return;
        }

        self::$config = Config::get('mail', 'mail');

        try {
            $transport = new MandrillTransport(new \Swift_Events_SimpleEventDispatcher());
            $transport->setApiKey(self::$config['password']);

            self::$Mailer = \Swift_Mailer::newInstance($transport);

            self::$initialized = true;
        } catch (Exception $e) {
            // TODO: Initialization failed, so mail sending won't work.
        }
    }

    /**
     * @param $subject
     *
     * @return \Swift_Message
     */
    public static function newMessage($subject) {
        self::initialize();

        return \Swift_Message::newInstance($subject);
    }

    /**
     * @param $message
     *
     * @return int
     */
    public static function send($message) {
        self::initialize();

        try {
            return self::$Mailer->send($message);
        } catch (Exception $e) {
            // TODO: Sending failed, so do something useful.
        }

    }
}