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

if (isset($_POST['ID'])) {
    $uid = $_POST['ID'];

    // $sql_str = "SELECT * FROM `tb1` WHERE id = {$uid}";
    // $sql_str = "SELECT * FROM `tb1` WHERE id = 1; delete from tb1;";
    $sql_str = "SELECT * FROM `tb1` WHERE id = :id";

    $stmt = $db->prepare($sql_str);
    $stmt->bindParam(':id', $uid, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        var_dump($ret);
    } else {
        return false;
    }
} 



?>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form method="POST" action="1_injection.php" name="frm">
            id: <input type="text" name="ID" value="" />
            <input type="submit" name="submit" value="submit" />
        </form>
    </body>
</html>