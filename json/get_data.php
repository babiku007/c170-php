<?php

$data = file_get_contents("https://www.taipower.com.tw/d006/loadGraph/loadGraph/data/loadpara.json");
$data = json_decode($data, true);

$power_usage_data = $data['records'][0];
$power_usage_info = $data['records'][1];
?>
<html>
<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <th>目前用電量</th>
                <th>預估最高用電</th>
                <th>資料時間</th>
            </thead>
            <tbody>
                <td><?php echo $power_usage_data['curr_load']; ?></td>
                <td><?php echo $power_usage_info['fore_peak_dema_load'] ;?></td>
                <td><?php echo $power_usage_info['publish_time'] ;?></td>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>