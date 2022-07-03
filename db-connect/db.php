<?php
$_db = array(
    'user' => 'teacher',
    'pass' => 'phpP@ssw0rd',
    'host' => 'localhost',
    'dbname' => 'teacher'
);

$dsn = "mysql:host={$_db['host']};dbname={$_db['dbname']}";
$db = new PDO($dsn, $_db['user'], $_db['pass']);

if ($db) {
    $db->exec("set names utf8");

    // 新增資料

    $user_name = "PHP";

    $sql_str = " INSERT INTO `tb1` (`name`) VALUES (:name)";

    $stmt = $db->prepare($sql_str);
    $stmt->bindParam(':name', $user_name, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        echo "Insert OK.";
    } else {
        echo "Insert FAIL.";
    }

    // 取出 tb1 資料

    $sql_str = " SELECT * FROM `tb1` ";

    $stmt = $db->prepare($sql_str);

    //$stmt->bindParam(':name', $user_name, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        var_dump($ret);
    } else {
        echo "SELECT FAIL.";
    }
}



