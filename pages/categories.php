<?php 
session_start();
if(!isset($_SESSION['id']))
    header ('location:login.php?login=0');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">
        <style type="text/css">
            #add{
                margin: 30px auto;
                text-align: center;
            }

            #show_keywork table{
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
        }
            #show_keywork td{ 
            border: 1px solid #ccc;
            border-bootom: 1px solid #ccc;
            border-left: 0px;
            border-top: 0px;
        }
            #add input[type="text"]{
                width: 400px;
                border: 1px solid #ccc;
                padding: 5px;
               
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="../public/js/enable_disable.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>List of category</title>
    </head>
<?php
    require_once '../config/config.php';
    require_once '../model/db.php';
    require_once '../model/keywords.php';
    require_once '../model/categories.php';
    require_once '../model/pagination.php';
    require_once '../sites/Sites.php';
    $md_categories = new categories();
    $paginations =new pagination();
?>
<body>
<div id="wraper">
<?php include_once 'menu.php'; ?>
    <div id="content">
            <div id="add">
                <center>
                    <form action="" method="POST">
                        <label>Category : </label><input type="text" name="name_category"/>
                        <input type="submit" name="submit" value="Add">
                    </form>
                </center>
            </div>
        <?php if (isset($_POST["submit"])):?>
                   <?php
                       if(!empty($_POST["name_category"])):
                           $params = array("name_categories" => $_POST["name_category"]);
                               $insert = $md_categories->insert($params);
                   ?>
                       <div class='notice'><div class='child'><?php $md_categories->notice($insert) ?></div></div>;       
                   <?php else:?>
                       <div class="notice_erro"><div class="child">Data empty !</div></div>
                   <?php endif; ?>
       <?php endif; ?>
       <div id="thongbao"></div>
       <?php
               $page = 1;
               if (!empty($_GET['page']))
                   $page =$_GET['page'];
               $total_categories = $md_categories->select(NULL,$page,true);
               $total_categories=$total_categories[0]['counter'];
               $list = $md_categories->select(NULL,$page,FALSE);
       ?>  
        <div class="total_pagination">
             <div id="show_search" class="float_left">
                     <b>Total:</b>
                     About <?php echo $total_categories?> result.
             </div>
             <div id="pagination" class="float_right">
                     <?php echo $paginations->showPagination($page, $total_categories,null,"catogeries.php");?>
             </div>
        </div>
        <div class="show_data">
            <table border="0" cellspacing="0" cellpadding="5" width="100%">
                    <tr>
                        <td colspan="4">
                            <form method="get" class="status_all" align='right'>
                                <span style="color:brown;">Enable or Disable all categories ? </span>
                                <input type="radio" value="1" name="status_all" class="enable_all" name_site="categories"> Enable
                                <input type="radio" value="0" name="status_all" class="disable_all" name_site="categories"> Disable
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td class="title"> Name</td>
                        <td class="title"> Operation</td>
                        <td class="title"> Status</td>  
                    </tr>
                    <?php foreach ($list as $item): ?>

                        <tr>
                            <td class="show_name"><?php echo $item["name"]; ?></td>
                            <td class="infor_show">
                                <a href="edit_categories.php?id=<?php echo $item["id"];?>" class="edit">Edit</a>
                            </td>
                            <td>
                                <form method="get" id="<?php echo $item["id"];?>">
                                    <input type="radio" value="1" name="status" class="enable" <?php if($item["status"]==1) echo "checked='checked'"?> onchange="if(this.checked) enable('?id=<?php echo $item['id'];?>&name_site=categories.php&status='+this.value);"> Enable>
                                    <input type="radio" value="0" name="status" class="disable" <?php if($item["status"]==0) echo "checked='checked'"?> onchange="if(this.checked) disable('?id=<?php echo $item['id'];?>&name_site=categories.php&status='+this.value);"> Disable>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div><!-- End: #show_data; -->
    </div> <!-- End #content -->
    <?php require_once 'footer.php'; ?>
</div><!-- End #wraper -->
</body>
</html>
