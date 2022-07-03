<code>
<pre>
<?php

// 一維
$myarr = array(
    1,
    2,
    3,
    4,
    5
);

var_dump($myarr);
echo '$myarr[2]:' . $myarr[2] . "\n";

?>
</pre>
</code>

<code>
<pre>
<?php


// 二維/多維
$myarr = array(
    1 => array('b'),
    2 => array('a', 'b'),
    3 => array('a'),
    4 => array('a', 'b'),
    5 => array('a', 'b', 'c'),
);

var_dump($myarr);

echo '$myarr[1][0]: ' . $myarr[1][0] . "\n";
echo '$myarr[5][2]: ' . $myarr[5][2] . "\n";
?>
</pre>
</code>


<?php
$arr1 = array(
    1 => "a",
    2 => "b"
);


$arr1[2];

$arr2 = array(
    "a",
    "b"
);

$arr2[1];