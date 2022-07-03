<?php
if (isset($_POST['x'])) {
    echo "Get value:" . $_POST['x'];

    exit;
}
?>
<html>
<head>
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script langguege="Javascript">
function put_data () {
    let x = $("#x").val();

    let obj = {
        'x': x
    };

    $.post("jquery-post.php", obj, function (r) {
        let str = "Server response: " + r;
        $("#message").text(str);
    }, "text" );
}
</script>
</head>
<body>
<div>
    <input type="text" id="x" value="" />
    <input type="button" value="Go" onClick="put_data();" />
</div>

<div id="message"></div>
</body>
</html>