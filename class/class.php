<?php

class myClass {
    public $c_name = "";

    public function __construct ($cname = "") {
        $this->c_name = $cname;
    }

    public function say ($word = "") :string {
        $class_name = $this->c_name;

        return "Hello, {$word}.  My name {$class_name}";
    }
}

$c = new myClass('Peter');
echo $c->say('PHP');

echo "</br>";




/*
class myClass {
    public $name = "";

    public function __construct ($uname = "") {
        $this->name = $uname;
    }

    public function say ($word = "") :string {
        $set_name = $this->name;
        return "Hello, {$word}. Myname is {$set_name}";
    }
}

$c = new myClass("Linux");
echo $c->say("PHP");
*/
