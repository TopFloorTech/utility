<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 8/6/2015
 * Time: 2:22 PM
 */

namespace TopFloor\Utility;


class Config {
    private static $initialized = false;

    private static $configDir;

    /** @var \Noodlehaus\Config $config */
    private static $config;

    public static function setConfigDir($dir) {
        if (!substr($dir, strlen($dir) - 1) == '/') {
            $dir .= '/';
        }

        self::$configDir = $dir;
    }

    public static function get($key = null, $default = null) {
        self::initialize();

        if (is_null($key)) {
            return self::$config;
        }

        return self::$config->get($key, $default);
    }

    private static function initialize() {
        if (self::$initialized) {
            return;
        }

        $configFiles = self::getConfigFiles();

        self::$config = new \Noodlehaus\Config($configFiles);

        self::$initialized = true;
    }

    private static function getConfigFiles() {
        $dir = self::configDir();

        $files = array();

        foreach (glob("{$dir}*.{php,ini,yaml}", GLOB_BRACE) as $file) {
            $files[] = $file;
        }

        return $files;
    }

    private static function configDir() {
        if (!isset(self::$configDir)) {
            // A feeble attempt to guess the config dir to be at the same level as the vendor dir.
            self::$configDir = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config/';
        }

        return self::$configDir;
    }
}