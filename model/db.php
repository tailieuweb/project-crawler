<?php
date_default_timezone_set("Asia/Bangkok");
require_once '../config/config.php';

class DB {

    static $_connection;
    PUBLIC $QUERY_SELECT = 0;
    public $QUERY_INSERT = 1;

    public static function getConnection() {
        if (!isset(self::$_connection)) {
            self::$_connection = mysqli_connect(DB_HOST . ":" . DB_PORT, DB_USER, DB_PASS) or die(mysqli_error());
            mysqli_select_db(self::$_connection,DB_NAME);
        }
        return self::$_connection;
    }

    public static function escape($string) {
        return mysqli_real_escape_string($string);
    }

    public static function escapeArr($arr) {
        if (empty($arr))
            return $arr;
        foreach ($arr as $key => $value) {
            $arr[$key] = $this->escape($value);
        }
        return $arr;
    }

    public function query($query, $type = NULL) {
         mysqli_query(self::getConnection(), 'SET NAMES utf8');
        $ret = mysqli_query(self::$_connection, $query);
        if ($ret == null) {
            echo "MYSQL QUERY: $query\n";
            echo "MYSQL ERROR: ";
            print_r(mysqli_error(self::$_connection));
            echo "\n";
            die();
        }
        switch ($type) {
            case $this->QUERY_INSERT:
                return mysqli_insert_id(self::$_connection);
            default:
                return $ret;
        }
    }

    public function fetch_assoc($query) {
        mysqli_query(self::getConnection(), 'SET NAMES utf8');
        $ret = mysqli_query(self::$_connection, $query);
        if ($ret == null) {
            echo "MYSQL QUERY: $query\n";
            echo "MYSQL ERROR: ";
            print_r(mysqli_error(self::$_connection));
            echo "\n";
            die();
        } else {
            $data = array();
            while ($row = mysqli_fetch_assoc($ret)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}
