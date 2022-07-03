<?php

class cGame {
    public $db;

    public function __construct() {
        global $_db;
        
        $dsn = "mysql:host={$_db['host']};dbname={$_db['dbname']}";
        $db = new PDO($dsn, $_db['user'], $_db['pass']);
        $db->exec("set names utf8");
    
        $this->db = $db;
    }

    public function guess ($game_id = 0, $guess_number = 0) :array {
        $number = (int) $guess_number;
        
        $game = $this->get_game($game_id);

        if ($game['status']) {
            $min = $game['data'][0]['min'];
            $max = $game['data'][0]['max'];
            $target = $game['data'][0]['target'];
            $game_status = $game['data'][0]['status'];
        }

        // 如果已經結束就回退回
        if ($game_status == 0) {
            return array('status' => true);
        }

        // 範圍外的不處理
        if ($number <= $min || $number > $max) {
            return array('status' => false);
        }
    
        // 如果猜中就儲最後一次，然後關閉遊戲
        if ($number == $target) {
            $r = $this->insert_round($game_id, $number);
            if ($r['status']) {
                return array('status' => true, 'data_save' => $this->update_game_status($game_id, 0));
            } else {
                return array('status' => true, 'data_save' => $r);
            }
        }
    
        // 猜錯，修改最大值
        if ($number > $target && $number < $max) {
            $max = $number;
            $r = $this->insert_round($game_id, $number);
            if (!$r['status'])
                return array('status' => false, 'data_save' => $r);
        }
        
        // 猜錯，修改最小值
        if ($number > $min && $number < $target) {
            $min = $number;
            $r = $this->insert_round($game_id, $number);

            if (!$r['status'])
                return array('status' => false, 'data_save' => $r);
        }

        // 儲存新的大小值
        return array('status' => false, 'data_save' => $this->update_game_number($game_id, $min, $max));
    }

    public function add_game ($player_id = 0) :array {
        $db = $this->db;

        $target_number = (int) rand(1, 100);

        $sql_str = " INSERT INTO `gm_game_map` (`player_id`, `target`) VALUES (:player_id, :target); ";
        $stmt = $db->prepare($sql_str);
        $stmt->bindParam(':player_id', $player_id, PDO::PARAM_INT);
        $stmt->bindParam(':target', $target_number, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return array('status' => true);
        } else {
            return array('status' => false, 'player_id' => $player_id, 'error' => $stmt->errorInfo());
        }
    }

    public function get_game ($game_id = 0, $player_id = 0) :array {
        $db = $this->db;

        $sql_str = " SELECT `id`, `player_id`, `target`, `min`, `max`, `status`, `create_time` FROM `gm_game_map` WHERE 1 = 1 ";
        if ($game_id != 0)
            $sql_str .= " AND `id` = :game_id ";
        if ($player_id != 0)
         $sql_str .= " AND `player_id` = :player_id ";

        $stmt = $db->prepare($sql_str);
        if ($game_id != 0)
            $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
        if ($player_id != 0)
            $stmt->bindParam(':player_id', $player_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return array('status' => true, 'data' => $ret);
        } else {
            return array('status' => false, 'error' => $stmt->errorInfo(), 'parm' => $stmt->debugDumpParams());
        }
    }

    public function insert_round ($game_id = 0, $guess_number = 0) :array {
        $db = $this->db;

        $sql_str = " INSERT INTO `gm_round` (`guess`, `game_map_id`) VALUES (:guess, :gm_id); ";
        $stmt = $db->prepare($sql_str);
        $stmt->bindParam(':guess', $guess_number, PDO::PARAM_INT);
        $stmt->bindParam(':gm_id', $game_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return array('status' => true);
        } else {
            return array('status' => false, 'error' => $stmt->errorInfo(), 'parm' => $stmt->debugDumpParams());
        }
    }

    public function update_game_number ($game_id = 0, $min = 0, $max = 100) {
        $db = $this->db;

        $sql_str = " UPDATE `gm_game_map` SET `min` = :min, `max` = :max WHERE 1 = 1 ";
        $sql_str .= " AND `id` = :game_id ;";
        $stmt = $db->prepare($sql_str);
        $stmt->bindParam(':min', $min, PDO::PARAM_INT);
        $stmt->bindParam(':max', $max, PDO::PARAM_INT);
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return array('status' => true);
        } else {
            return array('status' => false, 'error' => $stmt->errorInfo(), 'parm' => $stmt->debugDumpParams());
        }
    }

    public function update_game_status ($game_id = 0, $status = 1) {
        $db = $this->db;

        $sql_str = " UPDATE `gm_game_map` SET `status` = :gm_status WHERE 1 = 1 ";
        $sql_str .= " AND `id` = :game_id ;";
        $stmt = $db->prepare($sql_str);
        $stmt->bindParam(':gm_status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return array('status' => true);
        } else {
            return array('status' => false, 'error' => $stmt->errorInfo());
        }
    }

    public function get_round ($game_id = 0) :array {
        $db = $this->db;

        $sql_str = " SELECT `id`, `game_map_id`, `guess` FROM `gm_round` WHERE 1 = 1 ";
        $sql_str .= " AND `game_map_id` = :game_id ";
            

        $stmt = $db->prepare($sql_str);
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return array('status' => true, 'data' => $ret);
        } else {
            return array('status' => false, 'error' => $stmt->errorInfo());
        }
    }
}