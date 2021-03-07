<html>
    <head>
        <title>
         Edit keywords   
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
require_once '../pages/Sites.php';
include_once 'menu.php';
$md_keywords=new keyWords();
$md_categories=new categories();
$categories=$md_categories->select(NULL,NULL,FALSE);
?>
<div id="content">
    <h2>Edit Keywork</h2>
    <?php
            if(isset($_GET["id"]))
                $params=array('id'=>$_GET["id"]);
            if (!empty($_POST["submit"])):
                $params = array(
                        "id" => $_GET["id"],
                            "name" => $_POST["name"],
                                "id_categories" => $_POST["id_categories"],      
                );
            $update=$md_keywords->updates($params);
    ?>
            <?php if (!empty($update)): ?>
                    <div class="notice"><?php echo  SUCCESS ?></div>;
            <?php else :?> 
                    <div class="notice_erro"><div class="child"><?php echo FAIL; ?></div></div>;
            <?php endif; ?>
    <?php endif; ?>
                
<?php $keyword=$md_keywords->select($params,NULL,FALSE);?>
<form action="" method="POST">
            <div id="add">
                <table border="0" style="display: block">
                        <tr><td class="left" align="left">Name: </td></tr>
                        <tr>
                            <td ><input type="text" name="name" value="<?php echo $keyword[0]["name"];?>"></td>
                        </tr>
                        <tr><td class="left" align="left">Category: </td></tr>
                        <tr>
                            <td>
                                <select name="id_categories">
                                    <?php foreach ($categories as $item): ?>
                                        <option value="<?php echo $item['id']; ?>" <?php if($keyword[0]["id_categories"]==$item['id']) echo "selected='selected'"?>>
                                            <?php echo $item['name']; ?>
                                        </option>   
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>&Lt; <a href="keywords.php"> Goback</a>  </td> 
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="Edit Key"></td>
                        </tr>
            </table>
            </div><!-- End #add -->
</form>

</div><!--End: #content-->
</div><!-- End #wraper -->
</body>
</html>
    