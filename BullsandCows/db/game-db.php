<?php 
session_start();

require_once "config.php";
require_once "include/cGame.inc.php";
require_once "include/cPlayer.inc.php";

$cG = new cGame;
$cP = new cPlayer;
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
<?php

$player_name = "";
$games = array();
$cmd = @$_POST['cmd'];
$ret = false;
$game_id = @$_POST['game'];

$players = array();

switch ($cmd) {
    case "guess":
        $g_id = $_POST['game'];
        $g_number = $_POST['num'];
        $player_id = $_POST['player_id'];
        $player = $cP->get_player_by_id($player_id);
        if ($player['status']) {
            $player_name = $player['data'][0]['name'];
        } 

        $db_ret = $cG->guess($player_id, $g_number, $player_name, $g_id);

        $ret = $db_ret;

        $games = $cG->get_game();
        if ($games['status'])
            $games = $games['data'];
        
    break;
    case "clean":
        $player_id = $_POST['player_id'];
        $player = $cP->get_player_by_id($player_id);
        if ($player['status']) {
            $player_name = $player['data'][0]['name'];
        } 
        $cG->clean($player_name, $game_id);
    break;
    case "delete_round":
        delete_round($_POST['num']);
    break;

    case "add_player":
        $db_ret = $cP->add_player(trim($_POST['player_name']));
        $ret = $db_ret['status'];
    break;
    case "new_game":
        $player_id = trim($_POST['player']);

        $player = $cP->get_player_by_id($player_id);
        if ($player['status']) {
            $player_name = $player['data'][0]['name'];
        } 
        $db_ret = $cG->add_game($player_id, $player_name);
        if ($db_ret['status']) {
            $games = $cG->get_game();
            if ($games['status'])
                $games = $games['data'];
        }
    break;
}
?>
<div class="container">
    <div class="row">
        <?php if ($ret) echo "新增成功。"; ?>
        <form name="frm_player" method="post" action="game-db.php">
            Player Name: <input type="text" value="" name="player_name" />
            <input type="hidden" name="cmd" value="add_player" />
            <input type="submit" name="submit" value="Submit" />
        </form>
        <form name="frm_game" method="post" action="game-db.php">
            <?php
                $players = $cP->get_player_by_id();
                if ($players['status'])
                    $players = $players['data'];
            ?>
            選擇 Player: <select name="player">
                <?php foreach ($players as $k => $v) { ?>
                <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                <?php } ?>
            </select>
            <input type="hidden" name="cmd" value="new_game" />
            <input type="submit" name="submit" value="建立新遊戲" />
        </form>

    </div>
    <div class="row">
        <form name="frm1" method="post" action="game-db.php">
            選擇 Game: <select name="game">
                <?php foreach ($games as $k => $v) { ?>
                <option value="<?php echo $v['id']; ?>" <?php if ($v['id'] == @$_POST['game']) echo "selected";  ?>>第 <?php echo $v['id']; ?> 場</option>
                <?php } ?>
            </select>

            Number: <input type="text" value="" name="num" />
            <input type="hidden" name="player_id" value="<?php echo $_POST['player_id']; ?>" />
            <input type="hidden" name="cmd" value="guess" />
            <input type="submit" name="submit" value="Submit" />
        </form>

        <code><pre>
            <?php var_dump($_SESSION); ?>
        </pre></code>

        <form name="frm3" method="post" action="game-db.php">
            <input type="hidden" name="cmd" value="clean" />
            <input type="hidden" name="player_id" value="<?php echo $_POST['player_id']; ?>" />
            <input type="hidden" name="game_id" value="<?php echo $game_id; ?>" />
            <input type="submit" name="submit" value="Clean" />
        </form>
    </div>
    <?php if (isset($_SESSION['game'])) { ?>
    <div class="row">
        <?php
        // 猜的次數
        $rounds = $cG->get_round($game_id);
        if ($rounds['status'])
            $rounds = $rounds['data'];

        $cnt = count($rounds);
        $guess_number = (@$_POST['num'] == "") ? 0 : $_POST['num'];
        $min = $_SESSION[$player_name]['game']['min'];
        $max = $_SESSION[$player_name]['game']['max'];

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
                <?php foreach ($rounds as $k => $v) { ?>
                <tr>
                    <td><?php echo $r_cnt; ?></td>
                    <td><?php echo "{$v['guess']} ({$v['id']})"; ?></td>
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