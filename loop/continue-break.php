
<code>
<pre>
<?php
for ($i = 1; $i <= 10; $i = $i + 1) {
    if ($i == 5) {
        continue;
    }
    echo "{$i}\n";
}
?>
</pre>
</code>


<code>
<pre>
<?php
for ($i = 1; $i <= 10; $i = $i + 1) {
    if ($i == 7) {
        break;
    }
    echo "{$i}\n";
}
?>
</pre>
</code>

<code>
<pre>
<?php
for ($i = 1; $i <= 10; $i = $i + 1) {
    if ($i == 5) {
        continue;
    } else if ($i == 7) {
        break;
    }
    echo "{$i}\n";
}
?>
</pre>
</code>