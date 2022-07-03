<?php

class cPlayer {
    public $db;

    public function __construct() {
        global $_db;
        
        $dsn = "mysql:host={$_db['host']};dbname={$_db['dbname']}";
        $db = new PDO($dsn, $_db['user'], $_db['pass']);
        $db->exec("set names utf8");
    
        $this->db = $db;
    }

    public function get_player_by_name ($player_name = "") :array {
        $db = $this->db;

        $sql_str = " SELECT `id`, `name`, `create_time` FROM `gm_player` WHERE 1 = 1 ";
        if ($player_name != "")
            $sql_str .= " AND `name` = :name ";

        $stmt = $db->prepare($sql_str);
        if ($player_name != "")
            $stmt->bindParam(':name', $player_name, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return array('status' => true, 'data' => $ret);
        } else {
            return array('status' => false, 'error' => $stmt->errorInfo());
        }
    }

    public function get_player_by_id ($player_id = 0) :array {
        $db = $this->db;

        $sql_str = " SELECT `id`, `name`, `create_time` FROM `gm_player` WHERE 1 = 1 ";
        if ($player_id != 0)
            $sql_str .= " AND `id` = :uid ";

        $stmt = $db->prepare($sql_str);
        if ($player_id != 0)
            $stmt->bindParam(':uid', $player_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return array('status' => true, 'data' => $ret);
        } else {
            return array('status' => false, 'error' => $stmt->errorInfo());
        }
    }

    public function add_player ($player_name = "") :array {
        $db = $this->db;

        $sql_str = " INSERT INTO `gm_player` (`name`) VALUES (:name); ";
        $stmt = $db->prepare($sql_str);
        $stmt->bindParam(':name', $player_name, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return array('status' => true);
        } else {
            return array('status' => false, 'error' => $stmt->errorInfo());
        }
    }
}