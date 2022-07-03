<html>
<head>
    <title>POST</title>
</head>
<body>
    <code>
    <pre>
    <?php 
    var_dump($_POST);
    ?>
    </pre>
    </code>
    <form name="frm" method="POST" action="post.php">
        X: <input type="input" name="x" value="" />
        Y: <input type="input" name="y" value="" />

        <input type="submit" value="submit" name="submit" />
    </form>
</body>
</html>