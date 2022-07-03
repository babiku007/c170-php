<?php
function db_init () :mixed {
    global $_db;

    try {
        $dsn = "mysql:host={$_db['host']};dbname={$_db['dbname']}";
        $db = new PDO($dsn, $_db['user'], $_db['pass']);

        $db->exec("set names utf8");

        return $db;
        
    } catch (PDOException $err) {
        return $err->getMessage();
    }

}
