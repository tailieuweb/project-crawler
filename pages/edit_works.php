<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style type="text/css">
            #add table{  margin:auto; display:block}
        </style>
    </head>
    <body>
<?php
require_once '../config/config.php';
require_once '../model/db.php';
require_once '../model/works.php';
require_once '../model/keywords.php';
require_once '../model/keys_works.php';
require_once '../model/Sites.php';
$words=new Works();
?>
<?php 
    if(empty($_GET["id"]))
        header("location: works.php");
?>
<div id=" wraper">
<?php include_once 'menu.php';?>
<div id="content">
 <?php 
    if(!empty($_POST["submit"])):
        $work=array();
        $work["id"]=$_GET["id"];
        $work["name"]=$_POST["name"];
        $work["url"]=$_POST["url"];
        $work["posted"]="45435";
        $work["location"]=$_POST["localtion"];
        $work["company_name"]=$_POST["company_name"];
        $work["company_address"]=$_POST["company_dress"];
        $work["company_profile"]=$_POST["company_profile"];
        $work["description"]=$_POST["description"];
        $work["experience_requirements"]=$_POST["experience_requirements"];
    if($words->updates($work))
        echo "<div class='notice'>Update thanh cong</div>";
    else 
        echo "<div class='notice_erro'>Erro update !</div>";
    endif;
//////
$list_works=$words->select(array('listId_works'=>$_GET["id"]),NULL,FALSE);
?> 
<form action="" method="POST">
    <div id="add">
        <table border="0" width="80%" style="display: block;">
        <tr>
            <td></td>
            <td vlaign="middle">
            <h2>Edit Work</h2>
            </td>
        </tr>
        <?php foreach ($list_works as $item): ?>
        <tr>
            <td class="title">Name: </td>
            <?php var_dump($item); die(); ?>
            <td><input type="text" name="name" value="<?php echo $item["name"];?>"></td>
        </tr>
         <tr>
             <td class="title">Url: </td>
            <td><input type="text" name="url" value="<?php echo $item["url"];?>"></td>
        </tr>
        <tr>
            <td class="title">Company - Name: </td>
            <td><input type="text" name="company_name" value="<?php echo $item["name"];?>"></td>
        </tr>
        <tr>
            <td class="title">Company - Localtion: </td>
            <td><input type="text" name="localtion" value="<?php echo $item["location"];?>"></td>
        </tr>
        <tr>
            <td class="title">Company - Address: </td>
            <?php var_dump($item); die();  ?>
            <td><input type="text" name="company_dress" value="<?php echo $item["address"];?>"></td>
        </tr>
        <tr>
            <td class="title">Company - Profile: </td>
            <td><textarea cols="5" name="company_profile"><?php echo $item["description"];?></textarea></td>
        </tr>
        <tr>
            <td class="title">Description: </td>
            <td><textarea name="description"><?php echo $item["description"];?></textarea></td>
        </tr>
         <tr>
            <td class="title">experience_requirements:</td>
            <td><textarea name="experience_requirements" cols="5"><?php echo $item["experience_requirements"];?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Edit words"></td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div><!-- End #add -->
</form>

</div><!--End: #content-->
</div><!-- End #wraper -->
    </body>
</html>