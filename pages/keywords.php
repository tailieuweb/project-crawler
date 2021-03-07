<?php 
session_start();
if(!isset($_SESSION['id']))
    header ('location:login.php?login=0');
?>
<html>
    <head>
        <style type="text/css">
                form{
                       margin: 0px;
                       padding: 0px;
                }       
                #add{
                    margin: 30px auto;
                    text-align: center;
                }
                #add #add_keyword input[type="text"]{
                    width: 200px;
                    border: 1px solid #ccc;
                    padding: 5px;           
                }
                #add #add_keyword select, .status_all select{
                    width:200px;
                    border: 1px solid #ccc;
                    padding: 5px;           
                }
                .status_all select{
                    border: 0px;
                    padding: 5px;
                    font-size: 15px;
                    font-weight: bold;
                }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="../public/js/enable_disable.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>List of keywords</title>
    </head>
    <?php
        require_once '../config/config.php';
        require_once '../model/db.php';
        require_once '../model/works.php';
        require_once '../model/keywords.php';
         require_once '../model/categories.php';
        require_once '../model/pagination.php';
        require_once '../sites/Sites.php';
        $md_keywords = new keyWords();
        $md_categories=new categories();
        $categories=$md_categories->select(NULL,NULL,FALSE);
        $paginations =new pagination();
    ?>
<body>
<div id="wraper">
<?php include_once 'menu.php'; ?>
<div id="content">
            <div id="add">
                <center>
                    <form action="" method="POST" id="add_keyword">
                        <label>Keyword: </label>
                        <input type="text" name="keyword"/>
                        <label>Category : </label>
                        <select name="id_categories">
                            <?php foreach ($categories as $item): ?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>   
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" name="submit" value="Add">
                    </form>
                </center>
            </div>
        <?php if (isset($_POST["submit"])):?>
                <?php
                    if(!empty($_POST["keyword"])):
                        $params = array(
                                    "name" => $_POST["keyword"],
                                    "id_categories" => $_POST["id_categories"],
                            );
                        $insert = $md_keywords->insert($params);
                ?>
                    <div class='notice'><div class='child'><?php $md_keywords->notice($insert) ?></div></div>;       
                <?php else:?>
                    <div class="notice_erro"><div class="child">Data empty !</div></div>
                <?php endif;?>
        <?php endif;?>
        <div id="thongbao"></div>
        <?php            
            $page = 1;
            $params=null;
            if (!empty($_GET['page']))
                $page =$_GET['page'];
            if(isset($_GET['id_categories']))
                        $params = array(
                                    "id_categories" => $_GET["id_categories"],
                            );
            $list = $md_keywords->select($params,$page,FALSE);
            $total_keywords = $md_keywords->select($params,$page,true);
            $total_keywords=$total_keywords[0]['counter'];
       ?> 
       <div class="total_pagination">
            <div id="show_search" class="float_left">
                    <b>Total :&nbsp;</b>
                    About  <span><?php echo $total_keywords; ?></span> result.
            </div>
            <div id="pagination" class="float_right">
                <?php echo $paginations->showPagination($page, $total_keywords,$params,"keywords.php");?>
            </div>
            <div class="clear"></div>
       </div>
<div class="show_data">
    <table border="0" cellspacing="0" cellpadding="5" width="100%">
              <tr>
                    <td colspan="4">
                        <form method="get" class="status_all" align='right'>
                            <span style="color:brown;">Enable or Disable all keywords ? </span>
                            <input type="radio" value="1" name="status_all" class="enable_all" name_site="keywords"> Enable
                            <input type="radio" value="0" name="status_all" class="disable_all" name_site="keywords"> Disable
                        </form>
                    </td>
            </tr>
            <tr>
                <td class="title"> Name</td>
                <td class="title">
                    <form method="get" class="status_all">
                        <select name="id_categories"  onchange="location.href='keywords.php?id_categories='+this.value">
                            <option value="0"> &laquo; &nbsp; Select category &raquo; </option>
                            <?php foreach ($categories as $item): ?>
                            <option value="<?php echo $item['id']; ?>" <?php if(isset($_GET['id_categories'])&&$_GET['id_categories']==$item['id']) echo 'selected=selected';?>><?php echo $item['name']; ?></option>   
                            <?php endforeach; ?>
                       </select>
                    </form>
                </td>
                <td class="title"> Operation</td>
                <td class="title"> Status</td>  
            </tr>
            <?php var_dump($categories); ?>
            <?php foreach ($list as $item): ?>
                <tr>
                    <td class="show_name"><?php echo $item["name"]; ?></td>
                    <?php  var_dump($item); ?>
                    <td class="show_name"><?php echo $categories[$item["id_categories"]-1]['name']; ?></td>
                    <td class="infor_show">
                        <a href="edit_keywords.php?id=<?php echo $item["id"];?>" class="edit">Edit</a>
                        <a href="delete_keywords.php?id=<?php echo $item["id"];?>" class="delete">Delete</a>
                    </td>
                    <td>
                        <form method="get" id="<?php echo $item["id"];?>">
                            <input type="radio" value="1" name="status" class="enable" <?php if($item["status"]==1) echo "checked='checked'"?> onchange="if(this.checked) enable('?id=<?php echo $item['id'];?>&name_site=keywords.php&status='+this.value);"> Enable
                            <input type="radio" value="0" name="status" class="disable" <?php if($item["status"]==0) echo "checked='checked'"?> onchange="if(this.checked) disable('?id=<?php echo $item['id'];?>&name_site=keywords.php&status='+this.value);"> Disable
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
</div><!-- End: #keywork; -->
</div> <!-- End #content -->
<?php require_once 'footer.php'; ?>
</div><!-- End #wraper -->
</body>
</html>
