<html>
    <head>
        <title>
            Edit Category  
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style type="text/css">
                .title{
                    font-weight: bold;
                }
                #add table{
                    text-align: left;
                }
                #add input[type="text"]{
                    border:1px solid #ccc;
                    width: 400px; padding: 5px;
                }
        </style>
    </head>
<body>
<div id="wraper">
<?php
    require_once '../config/config.php';
    require_once '../model/db.php';
    require_once '../model/works.php';
    require_once '../model/keywords.php';
    require_once '../model/categories.php';
    require_once '../model/Sites.php';
    include_once 'menu.php';
    $md_keywords=new keyWords();
    $md_categories=new categories();
?>
<div id="content">
    <h2>Edit Keywork</h2>
    <?php
            if(isset($_GET["id"]))
                $params=array('id'=>$_GET["id"]);
    ?>
    <?php if (!empty($_POST["submit"])): 
    $params = array("id" => $_GET["id"], "name_categories" => $_POST["name_categories"],);
    $update=$md_categories->updates($params);
    ?>
            <?php if (!empty($update)): ?>
    <div class="notice"><div class="child"><?php echo  "SUCCESS" ?></div></div>;
            <?php else :?> 
    <div class="notice_erro"><div class="child"><?php echo "FAIL"; ?></div></div>;
            <?php endif; ?>
    <?php endif; ?>               
    <?php $categories=$md_categories->select($params,NULL,FALSE);?>
    <form action="" method="POST">
        <div id="add">
            <table border="0" style="display: block">
                    <tr><td class="left" align="left">Categotry: </td></tr>
                    <tr>
                        <td ><input type="text" name="name_categories" value="<?php echo $categories[0]["name"];?>"></td>
                    </tr>
                    <tr> <td> &Lt; <a href="categories.php"> Goback</a> </td> </tr>
                    <tr><td><input type="submit" name="submit" value="Edit Key"></td></tr>
            </table>
        </div><!-- End #add -->
    </form>
</div><!--End: #content-->
</div><!-- End #wraper -->
</body>
</html>
    