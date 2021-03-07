<?php
session_start();
if(!isset($_SESSION['id']))
    header ('location:login.php?login=0');
date_default_timezone_set("Asia/Bangkok");
?>
<html>
<head>   
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">-->
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
    $(function() {
        $('#from_date').datepicker({ dateFormat: 'dd-mm-yy' }).val();
        $('#to_date').datepicker({ dateFormat: 'dd-mm-yy' }).val();
    });
    </script>
    <title>List of show log</title>
</head>
<body>
<div id="wraper">
<?php
        require_once '../model/log.php';
        require_once '../model/show_log.php';
        require_once '../model/pagination.php';
        require_once '../config/config.php';
        $log=new show_log();
        $paginations=new pagination();
        $params=array(
                        "from_date"=>isset($_GET["from_date"])?$_GET["from_date"]:NULL,
                        "to_date"=>isset($_GET["to_date"])? $_GET["to_date"]:NULL,
                        "id_site"=>  isset($_GET["site"])?$_GET["site"]:NULL,
                    );
        $page=1;
            if(!empty($_GET["page"]))
                $page=$_GET["page"];
                    $list_log=$log->select($params, $page,FALSE);
                        $counter=$log->select($params,null,TRUE);
                            $counter=$counter[0]["counter"];               
?>
<?php include_once 'menu.php';?>
<div id="content">
    <div id="search">
        <form method="get">
            <div id="input_search">
                        Date : 
                        <input type="text" id="from_date" name="from_date" value="<?php if(isset($_GET['from_date'])) echo $_GET['from_date']; else echo "From";?>">
                        <input type="text" id="to_date" name="to_date" value="<?php if(isset($_GET['to_date'])) echo $_GET['to_date']; else echo "To";?>">
                        Site : 
                        <select name="site">
                            <option value="0" selected>Any</option>
                                    <?php foreach ($crawling_sites as $site): ?>
                                        <option value="<?php echo $site['id'] ?>" 
                                            <?php if (isset($_GET['site']) && ($_GET['site'] == $site['id'])) echo 'selected="selected"'?>>
                                                <?php echo $site['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                        </select>
                        <input type="submit" value="search" name="search">
            </div>
        </form>
    </div> <!--End #search -->
    <div class="total_pagination">
        <div id="show_search" class="float_left">
                <b>Total:</b>
                About <?php echo $counter;?> result. 
        </div>
        <div id="pagination" class="float_right">
                <?php echo $paginations->showPagination($page, $counter,$params,"show_log.php"); ?>
        </div>
    </div>
<div class="show_data">
        <table cellspacing="0" cellpadding="5" width="100%">
                <tr>
                            <td class="title">Date</td>
                            <td class="title">From Site</td>
                            <td class="title">Total</td>
                            <td class="title">Inserted</td>
                </tr>
                <?php if(!empty($list_log)): ?>
                        <?php foreach($list_log as $item): ?>
                            <?php $date=date("d/m/Y",$item["crawl_date"]); ?>
                                <tr>
                                    <td><?php echo $date;?></td>
                                    <td><?php echo $crawling_sites[$item["id_sites"]]['name'] ?></td>
                                    <td class="right"><?php echo $item["total"] ?></td>
                                    <td class="right">
                                        <a href="works.php?id_showlog=<?php echo $item['id']; ?>" title="View">
                                            <?php echo $item["inserted"] ?></td>
                                       </a>
                                    </td>
                                </tr>
                        <?php endforeach; ?>                 
                <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; color: brown">Not search result</td></tr> 
                <?php endif;?>
        </table>
</div>
</div><!--End #content-->
<?php require_once 'footer.php'; ?>
</div><!-- End Wraper -->
</body>
</html>