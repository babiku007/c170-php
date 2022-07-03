<html>
<head>
    <title>Get</title>
</head>
<body>
    <code>
    </pre>
    <?php 
    var_dump($_GET);
    ?>
    </pre>
    </code>
    <table border="1">
        <?php foreach ($_GET as $key => $value) { ?>
        <tr>
            <td><?php echo $key; ?></td>
            <td><?php echo $value;  ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>