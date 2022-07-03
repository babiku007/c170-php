<code>
<?php
$x = "post";

switch ($x) {
    case "get":
        echo "Get: your method is ${x}";
    break;
    case "post":
        echo "Post: your method is ${x}";
    break;
    case "delete":
        echo "Delete: your method is ${x}";
    break;
    default:
        echo "not provide method. ${x}";
    break;
}
?>
</code>