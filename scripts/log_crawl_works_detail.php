<?php
require_once '../model/works_model.php';
$obj = new Works_Model();
$logs=$obj->get_work_details_log();
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
                <td>Công việc crawl được</td>
                <td>Công việc mới</td>
                <td>Công việc rỗng mô tả</td>
                <td>Công việc rỗng yêu cầu</td>
                <td>Thời điểm crawl</td>
                <td>Thời gian crawl</td>
            </tr>
            <?php $i=1;foreach ($logs as $log): ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $log['site_name']; ?></td>
                    <td><?php echo $log['category_name']; ?></td> 
                    <td><?php echo $log['total_works']; ?></td>
                    <td><?php echo $log['valid_works']; ?></td>
                    <td><a href="#" data-display="noneDescription<?php echo $log['id'];?>"><?php echo $log['none_description']; ?></a></td>
                    <td><a href="#" data-display="noneRequirement<?php echo $log['id'];?>"><?php echo $log['none_requirement']; ?></a</td>
                    <td><?php echo $log['time_start']; ?></td>
                    <td><?php echo $log['time_count']; ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
       
        <!-- None description Popup content -->
        <?php foreach ($logs as $log): ?>
        <?php if(!empty($log['none_description'])):?>
            <div id="noneDescription<?php echo $log['id']; ?>" class="portBox">
                <table boder="1" style="width:100%">
                    <tr>
                        <th>STT</th>
                        <th>ID Work</th>
                        <th>Site</th>
                        <th>Tên công việc</th> 
                        <th>URL</th>
                    </tr>
                    <?php
                    $list = $obj->get_none_description_work($log['id_site'],$log['id_category']);
                    ?>
                    <?php $j=1;foreach ($list as $item): ?>
                        <tr>
                            <td><?php echo $j++; ?></td>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $log['site_name']?></td>
                            <td><?php echo $item['title']; ?></td> 
                            <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif;?>
        <?php endforeach; ?>
        
        <!-- None requrements Popup content -->
        <?php foreach ($logs as $log): ?>
        <?php if(!empty($log['none_requirement'])):?>
            <div id="noneRequirement<?php echo $log['id']; ?>" class="portBox">
                <table border="1" style="width:100%">
                    <tr>
                        <th>STT</th>
                        <th>ID Work</th>
                        <th>Site</th>
                        <th>Tên công việc</th> 
                        <th>URL</th>
                    </tr>
                    <?php $list=$obj->get_none_requirement_work($log['id_site'], $log['id_category']);?>
                    <?php  $i=1; foreach ($list as $item):?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $log['site_name']?></td>
                            <td><?php echo $item['title']; ?></td> 
                            <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif;?>
        <?php endforeach; ?>
    </body>
</html>