<code>
<pre>
<?php
for ($i = 1; $i <= 9; $i = $i + 1) {
    for ($j = 1; $j <= 9; $j = $j + 1) {
        $calc = $i * $j;
        if (($calc % 2) == 0) {
            continue;
        }
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
for ($i = 1; $i <= 9; $i = $i + 1) {
    if (($i % 2) == 0) {
        continue;
    }
    for ($j = 1; $j <= 9; $j = $j + 1) {
        if (($j % 2) == 0) {
            continue;
        }
        $calc = $i * $j;
        echo "{$i} * {$j} = {$calc}\n";
    }
    echo "\n";
}
?>
</pre>
</code>