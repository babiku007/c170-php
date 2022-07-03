<code>
<pre>
<?php
$arr = array(1, 3, 5, 7, 9);

foreach ($arr as $v) {
    echo "{$v}\n";
}
?>
</pre>
</code>

<code>
<pre>
<?php
$arr = array(1, 3, 5, 7, 9);

foreach ($arr as $k => $v) {
    echo "key: {$k}, value: {$v}\n";
}
?>
</pre>
</code>

<pre>
<?php
$arr = array(
    "v1" => "hello",
    "v2" => "world"
);

foreach ($arr as $k => $v) {
    echo "key: {$k}, value: {$v}\n";
}
?>
</pre>
</code>