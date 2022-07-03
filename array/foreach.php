<code>
<pre>
<?php
$score = array(
    'stu001' => array(
        'html' => 10,
        'php' => 9
    ),
    'stu002' => array(
        'html' => 9,
        'php' => 9,
        'python' => 10
    ),
    'stu003' => array(
        'html' => 10,
        'php' => 10
    )
);
var_dump($score);
/*
foreach ($score as $key => $value) {
    $stu_name = $key; // 取出學生名
    $html_socre = $value['html']; // 取出 Html score
    $php_score = $value['php']; // 取出 PHP score

    echo "{$stu_name}: html=>{$html_socre}, php=>{$php_score}\n";
}
*/

foreach ($score as $key => $value) {
    $stu_name = $key; // 取出學生名
    $str = "{$stu_name}: ";

    foreach ($value as $o => $c) {
        $str = $str . " {$o}=>{$c}";
    }

    $str = $str . "\n";

    echo $str;
}
?>
</pre>
</code>