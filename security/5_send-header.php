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
        <input type="button" onClick="send_header();" value="click" />

        <div>
            <code>
                <pre>
                    <span id="dump"></span>
                </pre>
            </code>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {

});

function send_header () {
    $.ajax({
    url: "dump_header.php",
    type: 'post',
    data: {
        access_token: 'XXXXXXXXXXXXXXXXXXX'
    },
    headers: {
        "class-code": "c170"
    },
    dataType: 'text',
    success: function (r) {
        console.log(r);
        $("#dump").text(r);
    }
});
}

</script>
</body>
</html>