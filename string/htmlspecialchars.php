<code>
<pre>
<?php
$str = "<strong>This is my String</strong>";

echo "{$str}\n";

$str = htmlspecialchars($str);

echo $str;
?>
</pre>
</code>

<code>
<pre>
<?php
$str = "<script>alert('Hello');</script>";

echo "{$str}\n";

$str = htmlspecialchars($str);

echo $str;
?>
</pre>
</code>
