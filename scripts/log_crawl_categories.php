<?php
require_once '../model/all_categories_model.php';
$obj = new All_Categories_Model();
$categories_log = $obj->get_categories_logs();
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
                <td>Tên site</td>
                <td>Số categories crawl</td> 
                <td>Categoires mới</td>
                <td>Categories đã map</td>
                <td>Thời điểm crawl</td>
                <td>Thời gian crawl</td>
            </tr>
            <?php foreach ($categories_log as $log): ?>
                <tr>
                    <td><?php echo $log['site_name']; ?></td>
                    <td><a href="#" data-display="myBox<?php echo $log['id']; ?>"><?php echo $log['categories_count']; ?></a></td> 
                    <td><?php echo $log['new_categories']; ?></td>
                    <td><a href="#" data-display="mappedCate<?php echo $log['id']; ?>"><?php echo sizeof($obj->get_mapped_categories($log['id_site'])); ?></a></td>
                    <td><?php echo $log['time_start']; ?></td>
                    <td><?php echo $log['time_count']; ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
        <!-- portBox Content -->
        <?php foreach ($categories_log as $log): ?>
            <div id="myBox<?php echo $log['id']; ?>" class="portBox">
                <table style="width:100%">
                    <tr>
                        <th>Site</th>
                        <th>Category Name</th> 
                        <th>URL</th>
                    </tr>
                    <?php
                    $params = array(
                        'id_site' => $log['id_site'],
                    );
                    $list_categories = $obj->get_category_by($params);
                    ?>
                    <?php foreach ($list_categories as $item): ?>
                        <tr>
                            <td><?php echo $log['site_name'] . '--'; ?></td>
                            <td><?php echo $item['name']; ?></td> 
                            <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <!-- Your content here -->
            </div>
        <?php endforeach; ?>

        <!--------------Mapped categories------------------------>
        <?php foreach ($categories_log as $log): ?>
            <div id="mappedCate<?php echo $log['id']; ?>" class="portBox">
                <table style="width:100%">
                    <tr>
                        <th>Site</th>
                        <th>Category Name</th> 
                        <th>URL</th>
                    </tr>
                    <?php
                    $list = $obj->get_mapped_categories($log['id_site']);
                    ?>
                    <?php foreach ($list as $item): ?>
                        <tr>
                            <td><?php echo $log['site_name'] . '--'; ?></td>
                            <td><?php echo $item['name']; ?></td> 
                            <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <!-- Your content here -->
            </div>
        <?php endforeach; ?>
    </body>
</html>