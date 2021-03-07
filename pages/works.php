<?php
session_start();
if(!isset($_SESSION['id']))
    header ('location:login.php?login=0');
require_once '../config/config.php';
require_once '../model/db.php';
require_once '../model/works.php';
require_once '../model/keywords.php';
require_once '../model/keys_works.php';
require_once '../model/pagination.php';
require_once '../model/show_log.php';
//require_once '../pages/Sites.php';
$works = new Works();
$show_log=new show_log();
if (isset($_POST['submit_export_excel'])) {
    require_once '../utilities/utilities.php';
    $export = new utilities();
    $params = array(
        "id_site" => isset($_GET['id_site']) ? $_GET['id_site'] : NULL,
        "keyword" => isset($_GET['keyword']) ? $_GET['keyword'] : NULL,
    );
    $data = $works->select($params);
    $excel_data = $export->arrayPHPtoArrayExcel($data);
//    var_dump($excel_data);die();
    $export->exportExcell($excel_data);
}
?>
<html>
    <head>
        <title>List of works</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                var count=0;
                $("#add h2").click(function(){
                    $("#add table").fadeToggle();
                    if(count%2!=0)
                        $(".img_an_hien").attr('src','../public/images/sq_plus_icon&24.png');
                    else
                         $(".img_an_hien").attr('src','../public/images/sq_minus_icon&24.png');
                    count++;
                    
                });
            });
        </script>   
    </head>
    <body>
        <div id="wraper">
            <?php
                $paginations = new pagination();

                if (!empty($_POST["submit"])) {
                    $work = array(
                        'name' => $_POST["name"],
                        'url' => $_POST["url"],
                        'posted_date' => time(),
                        'location' => $_POST["localtion"],
                        'company_name' => $_POST["company_name"],
                        'company_address' => $_POST["company_dress"],
                        'company_profile' => $_POST["company_profile"],
                        'description' => $_POST["description"],
                        'experience_requirements' => $_POST["experience_requirements"]
                    );
                    echo $works->insert($work);
                }
            ?>
            <?php include_once 'menu.php'; ?>
            <div id="content">
                <?php
                    $page = 1;
                    if (!empty($_GET['page']))
                        $page = $_GET['page'];
                    //Show id_works in table log;
                    if(isset($_GET['id_showlog'])){
                            $list_works=$show_log->select(array('id_showlog'=>$_GET['id_showlog']));
                    }
                    $params = array(
                        "id_site" => isset($_GET['id_site'])?$_GET['id_site']:NULL,
                              "keyword" => isset($_GET['keyword'])?$_GET['keyword']:NULL,
                                        //view show_log;
                                            "listId_works" => !empty($list_works) ? $list_works[0]['id_works'] : NULL,
                    );
                    $list = $works->select($params, $page,FALSE);
                    //Counter
                    $totalworks = $works->select($params, null, TRUE);
                    $totalworks = (int) $totalworks[0]['counter'];
                ?>
                <?php include "../form/works_form.php"; ?>
                <div id="search">
                    <form method="GET">
                            <div id="input_search">
                                <b>Site </b>
                                <select name="id_site"> 
                                    <option value="0" selected>--Any--</option>
                                    <?php foreach ($crawling_sites as $site): ?>
                                        <option value="<?php echo $site['id'] ?>" 
                                            <?php if (isset($_GET['id_site']) && ($_GET['id_site'] == $site['id'])) echo 'selected'?>>
                                                <?php echo $site['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                &nbsp;
                                <b>Keyword </b>
                                <input type="text" name="keyword" value="<?php if (isset($_GET['keyword'])) echo $_GET['keyword'];?>">
                                <input type="submit" name="search" value="Search">
                            </div>
                    </form>
                    <center>
                            <form name="export_excel" id="export_excel" method="POST">
                                <input type="submit" value="Export excel" name="submit_export_excel">
                            </form>
                    </center>
                </div><!-- End #search; -->
                <?php
                 if(isset($_GET['id_showlog'])){
                            $params = array(
                                    "id_site" => isset($_GET['id_site'])?$_GET['id_site']:NULL,
                                        "keyword" => isset($_GET['keyword'])?$_GET['keyword']:NULL,
                                            //view show_log;
                                                "id_showlog" =>$_GET['id_showlog'],
                                );
                             } 
                        ?>
                <div class="total_pagination">
                        <div id="show_search" class="float_left">
                                <b>Total :&nbsp;</b>
                                About <?php echo $totalworks; ?> result.
                        </div>
                        <div id="pagination" class="float_right">
                            <?php echo $paginations->showPagination($page, $totalworks, $params, "works.php"); ?>
                        </div>
                        <div class="clear"></div>
                </div>
                <div class="show_data">
                    <table cellspacing="0" cellpadding="5" border="0" width="100%">
                        <tr>
                            <td align="center" colspan="10" valign="middle" class="title" style="padding: 15px;">WORKS</td>
                        </tr>
                        <tr>
                            <td class="title"><a href=""></a>Name</td>
                            <td class="title">Company name</td>
                            <td class="title">Location</td>
                            <td class="title">Description</td>
                            <td class="title">Experience requirements</td>
                            <td class="title">Posted date</td>
                            <td class="title"> &nbsp; Operation &nbsp; </td>            
                        </tr>
                        <?php if (!empty($list)): $count = 0; ?>
                            <?php foreach ($list as $item): $count++; ?>
                                <tr <?php if ($count % 2 != 0) echo "class='enable'"; ?>>
                                    <td class="name">
                                        <a href="<?php echo $item["url"]; ?>" target="_blank">
                                            <?php echo $item["name"]; ?>
                                        </a>
                                    </td>
                                    <td class="infor_show"><?php echo $item["company_name"]; ?></td>
                                    <td class="infor_show"><?php echo $item["location"]; ?></td>

                                    <td class="infor_show">
                                        <?php echo substr($item["description"], 0, 200); ?>
                                    </td>
                                    <td class="infor_show"><?php echo substr($item["experience_requirements"], 0, 200); ?></td>
                                    <td class="infor_show"><?php echo date("d/m/Y", $item["posted_date"]); ?></td>
                                    <td class="infor_show"> 
                                        <a href="edit_works.php?id=<?php echo $item["id"]; ?>" class="edit" title="edit work"> Edit</a>
                                        <a href="view_works.php?id=<?php echo $item["id"]; ?>" class="view" title="view work"> View</a>
                                        <a href="delete_works.php?id=<?php echo $item["id"]; ?>" class="delete" title="delete work"> Delete</a>
                                    </td>   
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class='notice'>Not find works</div>
                        <?php endif; ?>
                    </table>
                </div><!-- End: #show_work -->
            </div><!--End: #khung-->
            <?php require_once 'footer.php'; ?>
        </div><!-- End #wraper --->
    </body>
</html>
