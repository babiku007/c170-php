<?php 
session_start();

require_once "../config.php";
require_once "../include/cGame.inc.php";
require_once "../include/cPlayer.inc.php";

$cG = new cGame;
$cP = new cPlayer;

$cmd = (@$_POST['cmd'] == "") ? "" : trim($_POST['cmd']);

switch ($cmd) {
    case "add_player":
        $player_name = trim($_POST['attr']['player_name']);
        
        echo json_encode($cP->add_player($player_name));

        exit;
    break;
    case "get_player":
        $player_id = trim(@$_POST['attr']['player_id']);
        if ($player_id == "")
            echo json_encode($cP->get_player_by_id());
        else
            echo json_encode($cP->get_player_by_id($player_id));
        
        exit;
    break;
    case "add_game":
        $player_id = trim(@$_POST['attr']['player_id']);
        
        echo json_encode($cG->add_game($player_id));

        exit;
    break;
    case "get_game":
        $player_id = (trim(@$_POST['attr']['player_id']) == "") ? 0 : trim(@$_POST['attr']['player_id']);
        $game_id = (trim(@$_POST['attr']['game_id']) == "") ? 0 : trim(@$_POST['attr']['game_id']);
        $game_status = (trim(@$_POST['attr']['game_status']) == "") ? 1 : trim(@$_POST['attr']['game_status']);

        echo json_encode($cG->get_game($game_id, $player_id, $game_status));

        exit;
    break;
    case "get_rounds":
        $game_id = (trim(@$_POST['attr']['game_id']) == "") ? 0 : trim(@$_POST['attr']['game_id']);

        $gm = $cG->get_game($game_id);

        if ($gm['status']) {
            $rounds = $cG->get_round($game_id);

            $j_ret = array(
                'status' => true,
                'target' => $gm['data'][0]['target'],
                'min' => $gm['data'][0]['min'],
                'max' => $gm['data'][0]['max'],
                'rounds' => $rounds['data']
            );

            echo json_encode($j_ret);
        } else {
            echo json_encode($gm);
        }

        exit;
    break;
    case "guess_number":
        $game_id = (trim(@$_POST['attr']['game_id']) == "") ? 0 : trim(@$_POST['attr']['game_id']);
        $number = (trim(@$_POST['attr']['guess_number']) == "") ? 0 : trim(@$_POST['attr']['guess_number']);

        $r = $cG->guess($game_id, $number);

        // 取出所有回合
        $rounds = $cG->get_round($game_id);
        if ($r['status']) {
            // 完全猜中, 取出所有筆數
            echo json_encode($rounds);
        } else {
            // 沒猜中, 列出最小值/最大值/所有筆數
            $games = $cG->get_game($game_id);

            $j_ret = array(
                'status' => false,
                'min' => $games['data'][0]['min'],
                'max' => $games['data'][0]['max'],
                'rounds' => $rounds['data']
            );

            echo json_encode($j_ret);
        }

        exit;
    break;
    default:
        echo json_encode(array('status' => false));
    break;
}