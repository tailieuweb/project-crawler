<?php
session_start();
if(!isset($_SESSION['id']))
   header ('location:login.php?login=0');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>List of company</title>
</head>
<body>
<div id="wraper">
<?php
require_once '../config/config.php';
require_once '../model/db.php';
require_once '../model/works.php';
require_once '../model/keywords.php';
require_once '../model/companies.php';
require_once '../model/pagination.php';
require_once '../sites/Sites.php';
$companies=new companies();
$paginations=new pagination();
?>
<?php 
    if(!empty($_POST["submit"])) {
        $params = array(
            'name' =>   $_POST["name"],
            'website'   =>  $_POST["website"],
            'phones'    =>  $_POST["phone"],
            'address'  =>  $_POST["address"],
            'status'  =>  $_POST["status"],
            'notes'   =>  $_POST["notes"],
            'description'   =>  $_POST["description"],
        );
        $companies->insert($params);
    }
?>
<?php include_once 'menu.php'; ?>
<div id="content">
<?php include "../form/companies_form.php";?>
<?php
    $page = 1;
    if (!empty($_GET['page']))
        $page = (int)$_GET['page'];
            $list = $companies->select($page,FALSE);
            $totalCompanies = $companies->select($page,TRUE);
            $totalCompanies=$totalCompanies[0]['counter'];
?>
    <div class="total_pagination">
                        <div id="show_search" class="float_left">
                                <b>Total :&nbsp; </b>
                                About <?php echo $totalCompanies; ?> result.
                        </div>
                        <div id="pagination" class="float_right">
                            <?php echo $paginations->showPagination($page,$totalCompanies,NULL,"companies.php"); ?>
                        </div>
                        <div class="clear"></div>
                </div>
<div class="show_data">
    <table cellspacing="0" cellpadding="5" border="0" width="100%">
        <tr>
            <td align="center" colspan="10" valign="middle" class="title" style="padding: 15px;">Companies</td>
        </tr>
        <tr>
            <td class="title com_name">Name</td>
            <td class="title com_address">Address</td>
            <td class="title com_profile">Description</td>          
            <td class="title com_operation">Operation</td>            
        </tr>
        <?php if(!empty($list)):?>
        <?php foreach ($list as $item): ?>
        <tr>
            <td class="show_name com_name" style="width: 250px"><?php echo $item["name"];?></td>
            <td class="com_address"><?php echo $item["address"];?></td>
            <td class="com_profile" style="width: 450px;"><?php echo $item["description"];?></td>
            <td class="infor_show com_operation" style="width:60px"> 
                <a href="edit_works.php?id=<?php echo $item["id"];?>" class="edit" title="edit works">Edit</a> 
                <a href="delete_works.php?id=<?php echo $item["id"];?>" class="delete" title="delete company">Delete</a>
            </td>   
        </tr>
     <?php endforeach;?>
       <?php else : ?>
           <div class='notice'>Not find works</div>
       <?php endif; ?>
    </table>
</div><!-- End: #show_work -->
</div><!--End: #content-->
</div><!-- end #wraper -->
</body>
</html>