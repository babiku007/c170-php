<?php

function say_hello ($say_word = "world") :string {
    $string = "Say {$say_word}</br>";

    return $string;
}

say_hello();
say_hello();

$ret = say_hello("PHP");
echo $ret;
echo $ret;
echo $ret;