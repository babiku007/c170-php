<?php session_start(); ?>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/af-2.4.0/datatables.min.css"/>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/af-2.4.0/datatables.min.js"></script>
</head>
<body>
<?php

function guess ($number = 0) {
    $number = (int) $number;
    $min = $_SESSION['game']['min'];
    $max = $_SESSION['game']['max'];
    $target = $_SESSION['game']['number'];

    if ($number == $target) {
        array_push($_SESSION['game']['round'], $number);
        return true;
    }

    if ($number <= $min || $number > $max) {
        return false;
    }

    if ($number > $target && $number < $max) {
        $_SESSION['game']['max'] = $number;
        array_push($_SESSION['game']['round'], $number);
        return false;
    }
    
    if ($number > $min && $number < $target) {
        $_SESSION['game']['min'] = $number;
        array_push($_SESSION['game']['round'], $number);
        return false;
    }
}

function delete_round ($number = 0) {
    if (isset($_SESSION['game']['round'][$number])) {
        unset($_SESSION['game']['round'][$number]);
        return true;
    } else {
        return false;
    }
}

if (!isset($_SESSION['game'])) {
    $target_number = (int) rand(1, 100);

    $_SESSION['game'] = array(
        'number' => $target_number,
        'round' => array(),
        'min' => 1,
        'max' => 100
    );
}

function clean () {
    unset($_SESSION['game']);
}


$cmd = @$_POST['cmd'];
$ret = false;

switch ($cmd) {
    case "guess":
        $ret = guess($_POST['num']);
    break;
    case "clean":
        clean();
    break;
    case "delete_round":
        delete_round($_POST['num']);
    break;
}
?>
<div class="container">
    <div class="row">
        <form name="frm1" method="post" action="game-session.php">
            Number: <input type="text" value="" name="num" />
            <input type="hidden" name="cmd" value="guess" />
            <input type="submit" name="submit" value="Submit" />
        </form>

        <form name="frm2" method="post" action="game-session.php">
            Round#: <input type="text" value="" name="num" />
            <input type="hidden" name="cmd" value="delete_round" />
            <input type="submit" name="submit" value="Delete" />
        </form>

        <form name="frm3" method="post" action="game-session.php">
            <input type="hidden" name="cmd" value="clean" />
            <input type="submit" name="submit" value="Clean" />
        </form>
    </div>
    <?php if (isset($_SESSION['game'])) { ?>
    <div class="row">
        <?php
        // 猜的次數
        $cnt = count($_SESSION['game']['round']);
        $guess_number = (@$_POST['num'] == "") ? 0 : $_POST['num'];
        $min = $_SESSION['game']['min'];
        $max = $_SESSION['game']['max'];

        if ($ret) {
            printf("%s，猜了 %s 次。", "你猜中了", $cnt);
        } else {
            printf("輸入 %s, 猜了 %s 次，(%s ~ %s)", $guess_number, $cnt, $min, $max);
        }
        ?>
        
        <h3>回合</h3>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Round#</th>
                    <th>Number</th>
                </tr>
            </thead>
            <tbody>
                <?php $r_cnt = 1; ?>
                <?php foreach ($_SESSION['game']['round'] as $k => $v) { ?>
                <tr>
                    <td><?php echo $r_cnt; ?></td>
                    <td><?php echo "$v ($k)"; ?></td>
                </tr>
                <?php $r_cnt++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</div>
</body>
</html>