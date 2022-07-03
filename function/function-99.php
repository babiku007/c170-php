<?php
function _99calc($x = 0, $y = 0) {
    $ret = $x * $y;

    return $ret;
}
?>
<html>
<head>
    <title>function</title>
</head>
<body>
<div>
<code>
<pre>
<?php
$x = isset($_POST['x']) ? (int) $_POST['x'] : 0;
$y = isset($_POST['y']) ? (int) $_POST['y'] : 0;

$x = isset($_POST['x']) ? (int) $_POST['x'] : 0;
if (isset($_POST['x'])) {
    $x = (int) $_POST['x'];
} else {
    $x = 0;
}

if ($x != 0 && $y != 0) {
    for ($i = 1; $i <= $x; $i = $i + 1) {
        for ($j = 1; $j <= $y; $j = $j + 1) {
            $ret = _99calc($i, $j);
            echo "{$i} * {$j} = {$ret}\n";
        }
        echo "\n";
    }
}
?>
</pre>
</code>
</div>
<form name="frm" method="POST" action="function-99.php">
    X: <input type="input" name="x" value="" />
    Y: <input type="input" name="y" value="" />

    <input type="submit" value="submit" name="submit" />
</form>
</body>
</html>