<?php
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
        <div>
            <h3>新增 Player</h3>
            <input type="text" value="" id="player_name" />
            <input type=button onClick="add_player();" value="Add Player" />
        </div>
        <div>
            <h3>新增 Game</h3>
            選擇 Player: 
            <select value="" id="player"></select>
            <input type=button value="Add Game" onClick="add_game();" />
            <input type=button value="Load Game" onClick="get_game();" />
        </div>
        <div>
            <h3>猜數字</h3>
            選擇 Player: 
            <select value="" id="game"></select>
            <input type="text" value="" id="guess_number" />
            <input type=button value="Guess" onClick="guess_number();" />
        </div>
        <div>
            <h3>回合</h3>
            <input type=button value="遊戲回合" onClick="get_game_round();" />
        </div>
        
    </div>
    <div class="row">
        <div id="guess_result"></div>
        <div id="game_round">
            <span id="game_target"></span>
            <table id="tb_round" class="table table-hover table-bordered">
                <thead>
                    <th>#</th>
                    <th>Guess number</th>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    get_player();
});

function get_player () {
    let obj = {
        'cmd': 'get_player'
    };

    $.post("api/api.php", obj, function (r) {
        if (r.status) {
            $("#player option").remove();
            let str = "";
            $.each(r.data, function (k, v) {
                str = "<option value='" + v.id + "'>" + v.name + "</option>";
                $(str).appendTo("#player");
            });
        }
    }, "json");   
}

function add_player () {
    let obj = {
        'cmd': 'add_player',
        'attr': {
            'player_name': $("#player_name").val()
        }
    };

    $.post("api/api.php", obj, function (r) {
        if (r.status) {
            let str = "";
            alert("新增成功。");
        } else {
            alert("新增失敗。");
        }

        get_player();
    }, "json");
}

function add_game () {
    let obj = {
        'cmd': 'add_game',
        'attr': {
            'player_id': $("#player").val()
        }
    };

    $.post("api/api.php", obj, function (r) {
        if (r.status) {
            alert("新增成功。");
        } else {
            alert("新增失敗。");
        }

        get_game();
    }, "json");
}

function get_game_round () {
    let obj = {
        'cmd': 'get_rounds',
        'attr': {
            'game_id': $("#game").val()
        }
    };

    $.post("api/api.php", obj, function (r) {
        let bs = $("#game_round");
        let target = $(bs).find("game_target");
        let tb_bs = $(bs).find("#tb_round");
        let tbody_round = $(bs).find("tbody");
            $(tbody_round).find("tr").remove();
        let str = "";
        
        $.each(r.rounds, function (k, r) {
            str = "";
            str += "<tr>";
            str += "<td>" + (k + 1) + "</td>";
            str += "<td>" + r.guess + "</td>";
            str += "</tr>";

            $(str).appendTo(tbody_round);
        });
    }, "json");
}

function get_game () {
    let obj = {
        'cmd': 'get_game',
        'attr': {
            'player_id': $("#player").val()
        }
    };

    $.post("api/api.php", obj, function (r) {
        $("#game option").remove();
        let str = "";
        $.each(r.data, function (k, v) {
            str = "<option value='" + v.id + "'>";
            str += "第 " + v.id + " 次";
            if (v.status == 0)
                str += " (已完成)";
            str += "</option>";
            $(str).appendTo("#game");
        });
    }, "json");
}

function guess_number () {
    let obj = {
        'cmd': 'guess_number',
        'attr': {
            'guess_number': $("#guess_number").val(),
            'game_id': $("#game").val()
        }
    };

    $.post("api/api.php", obj, function (r) {
        if (r.status) {
            $("#guess_result").text("猜中了！");
        } else {
            let min = r.min;
            let max = r.max;
            let rounds = r.rounds.length;
            let message = "猜錯了！";
                message += "猜了 " + rounds + " 次。";
                message += min + " ~ " + max;
            $("#guess_result").text(message);
        }
        
    }, "json");
}
</script>
</body>
</html>