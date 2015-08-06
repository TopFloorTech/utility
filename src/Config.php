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

    private static $config;

    private static function initialize() {
        if (self::$initialized) {
            return;
        }





        $config = new \Noodlehaus\Config([])

        self::$initialized = true;
    }

    private function getConfigFiles() {
        if ($handle = opendir(self::configDir())) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != "..") {

                    echo "$entry\n";
                }
            }

            closedir($handle);
        }
    }

    private function configDir() {
        if (!isset(self::$configDir)) {
            self::$configDir = dirname(dirname(dirname(__FILE__);
        }

        return self::$configDir;
    }
}