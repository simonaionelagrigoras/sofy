<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 08/06/2019
 * Time: 18:02
 */

class Database
{
    private static $bdd = null;

    private static $dbName = 'sofy';
    private static $dbUser = 'app_user';
    private static $dbPass = 'app_us3r_pass';

    private function __construct() {

    }

    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:dbname=" . self::$dbName . ";host=localhost", self::$dbUser, self::$dbPass);

        }
        return self::$bdd;
    }
}