<?php

class cGame {
    public $db = "";

    public function __constractor () {
        $db = db_init();

        if ($db) {
            $this->db = $db;
            return array('status' => true);
        } else {
            return array('status' => true, 'detail' => $db);
        }

    }

    public function get_player_name () {

    }

    public function new_play ($player_id) {

    }

    public function set_round ($play_id = 0) {

    }
}