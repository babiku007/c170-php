<code>
<pre>
<?php
$x = 1;
while ($x <= 9) {
    $y = 1;
    while ($y <= 9) {
        $calc = $x * $y;
        echo "{$x} * {$y} = {$calc}\n";

        $y = $y + 1;
    }
    echo "\n";
    $x = $x + 1;
}
?>
</pre>
</code>