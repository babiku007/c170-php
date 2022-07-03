<code>
<pre>
<?php

$myvar = "Hello";

echo (strtoupper($myvar));
?>
</pre>
</code>

<code>
<pre>
<?php

$myvar = "Hello@examPle.COm";

echo (strtolower($myvar));
?>
</pre>
</code>

<code>
<pre>
<?php

$myvar = "     Hello2@examPle.COm       ";

//$myvar = trim($myvar);
//echo (strtolower($myvar));
echo "Orig String: {$myvar}\n";

echo (strtolower(trim($myvar)));
?>
</pre>
</code>