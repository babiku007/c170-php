<?php
$_db = array(
    'user' => 'teacher',
    'pass' => 'phpP@ssw0rd',
    'host' => 'localhost',
    'dbname' => 'teacher'
);

$db;

function db_init () {
    global $_db;

    $dsn = "mysql:host={$_db['host']};dbname={$_db['dbname']}";
    $db = new PDO($dsn, $_db['user'], $_db['pass']);
    $db->exec("set names utf8");

    return $db;
}

// 新增資料
function add_name ($user_name = "") :bool {
    $db = db_init();

    $sql_str = " INSERT INTO `tb1` (`name`) VALUES (:name)";

    $stmt = $db->prepare($sql_str);
    $stmt->bindParam(':name', $user_name, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// 取出 tb1 資料
function get_name ($id = 0) :array {
    $db = db_init();

    $sql_str = " SELECT * FROM `tb1` WHERE 1 = 1 ";
    if ($id != 0)
        $sql_str .= " AND `id` = :user_id ";

    $stmt = $db->prepare($sql_str);
    if ($id != 0)
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return array('status' => true, 'data' => $ret);
    } else {
        return array('status' => false, 'error' => $stmt->errorInfo());
    }
}

$cmd = @$_POST['command'];
$get_ret = false;

switch ($cmd) {  
    case "add": 
        $user_name = trim($_POST['user_name']);
        $ret = add_name($user_name);
        if (!$ret['status'])
            var_dump($ret);
    break;

    case "get": 
        $user_id = trim($_POST['user_id']);
        $ret = get_name($user_id);
        if ($ret['status'])
            $get_ret = true;
        else
            var_dump($ret);
    break;
}

?>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/af-2.4.0/datatables.min.css"/>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/af-2.4.0/datatables.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <form name="frm1" method="post" action="tb1-lab.php">
            User Name: <input type="text" name="user_name" value="" />
            <input type="submit" name="submit" value="submit" />
            <input type="hidden" name="command" value="add" />
        </form>

        <form name="frm2" method="post" action="tb1-lab.php">
            Get User: <input type="text" name="user_id" value="" />
            <input type="submit" name="submit" value="submit" />
            <input type="hidden" name="command" value="get" />
        </form>
    </div>

    <div class="row">
        <?php
        if ($get_ret) {
            $data = $ret['data'];
        } else {
            $data = array();
        }
        ?>

        <table class="table table-hover table-bordered" id="example">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $k => $v) { ?>
                <tr>
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#example').DataTable();
});
</script>
</body>
</html>