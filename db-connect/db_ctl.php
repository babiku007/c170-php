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
}

/*
$sql_str = "SELECT * FROM `tb1` ";

$stmt = $db->prepare($sql_str);
$stmt->bindParam(':account', $user_name, PDO::PARAM_STR);
$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);

if ($stmt->execute()) {
    $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $this->comm->show_result(true, 'FOUND', $ret);
} else {
    return $this->comm->show_result(false, $detail = $stmt->errorInfo());
}
*/


