<?php
session_start();

var_dump($_SESSION);
?>

<code><pre>

<?php

$_SESSION['class'] = array(
    'name' => 'Linux',
    'stu_count' => 25
);

var_dump($_SESSION);

?>

<?php

unset($_SESSION['class']);

var_dump($_SESSION);

?>

</pre></code>
