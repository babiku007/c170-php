<code>
<pre>
<?php
$x = 9;
$y = 9;

for ($i = 1; $i <= $x; $i = $i + 1) {
    for ($j = 1; $j <= $y; $j = $j + 1) {
        $calc = $i * $j;
        echo "{$i} * {$j} = {$calc}\n";
    }
    echo "\n";
}
?>
</pre>
</code>
<code>
<pre>
<?php
$x = 2;
$y = 1;
$calc = 0;

for ($i = $x; $i <= 9; $i = $i + 1) {
    for ($j = $y; $j <= 9; $j = $j + 1) {
        $calc = $i * $j;
        if (($calc % 2) == 0) continue;
        echo "{$i} * {$j} = {$calc}\n";
    }
    echo "\n";
}
?>
</pre>
</code>