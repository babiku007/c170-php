<code>
<pre>
<?php
$api_data = "202205291114380008000";

$y = substr($api_data, 0, 4);
$m = substr($api_data, 4, 2);
$d = substr($api_data, 6, 2);

$amount = (int)substr($api_data, 15, 7);

$amount = number_format($amount, 2);

echo "{$y}-{$m}-{$d} 收到 {$amount}";
?>
</pre>
</code>
