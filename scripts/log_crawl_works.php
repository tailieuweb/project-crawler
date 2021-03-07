<?php
require_once '../model/works_model.php';
$obj = new Works_Model();
$logs=$obj->get_works_log();
?>
<html>
    <head> 
        <meta charset="utf-8">
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script src="../js/portBox.slimscroll.min.js" type="text/javascript"></script>
        <link href="../css/portBox.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <table style="width:100%">
            <tr>
                <td>STT</td>
                <td>Tên site</td>
                <td>Tên category</td> 
                <td>Số công việc mới</td>
                <td>Số công việc crawl được</td>
                <td>Thời điểm crawl</td>
                <td>Thời gian crawl</td>
            </tr>
            <?php $i=1;foreach ($logs as $log): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $log['site_name']; ?></td>
                    <td><?php echo $log['category_name']; ?></td> 
                    <td><?php echo $log['new_works']; ?></td>
                    <td><?php echo $log['works_count']; ?></td>
                    <td><?php echo $log['time_start']; ?></td>
                    <td><?php echo $log['time_count']; ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
       
    </body>
</html>