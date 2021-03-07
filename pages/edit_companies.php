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
require_once '../model/companies.php';
require_once '../model/keys_works.php';
require_once '../pages/Sites.php';
$companies=new companies();

    if(empty($_GET["id"]))
        header("location:companies.php");
    
    if(!empty($_POST["submit"])):
        $params = array(
                'id' =>   $_GET["id"],
                'name' =>   $_POST["name"],
                'website'   =>  $_POST["website"],
                'phones'    =>  $_POST["phone"],
                'address'  =>  $_POST["address"],
                'status'  =>  $_POST["status"],
                'notes'   =>  $_POST["notes"],
                'description'   =>  $_POST["description"],
            );
    if($companies->updates($params))
        echo "<div class='notice'>Update thanh cong</div>";
    else 
        echo "<div class='notice_erro'>Erro update !</div>";
endif;
?>
<?php $item=$companies->aSelect($_GET["id"]);?>
<?php include_once 'menu.php'; ?>
<div id="content">
<form action="" method="POST">
    <div id="add">
        <table border="0" style="display:block;">
        <tr>
            <td></td>
            <td vlaign="middle">
            <h2>Edit Companies</h2>
            </td>
        </tr>
        <tr>
            <td class="title">Name: </td>
            <td><input type="text" name="name" value="<?php echo $item["name"];?>"></td>
        </tr>
         <tr>
             <td class="title">website: </td>
            <td><input type="text" name="website" value="<?php echo $item["website"];?>"></td>
        </tr>
        <tr>
            <td class="title">Phones: </td>
            <td><input type="text" name="phone" value="<?php echo $item["phones"];?>"></td>
        </tr>
        <tr>
            <td class="title">Address: </td>
            <td><input type="text" name="address" value="<?php echo $item["address"];?>"></td>
        </tr>
        <tr>
            <td class="title">status</td>
            <td><input type="text" name="status" value="<?php echo $item["status"];?>"></td>
        </tr>
        <tr>
            <td class="title">Notes</td>
            <td><input type="text" name="notes"><?php echo $item["notes"];?></td>
        </tr>
        <tr>
            <td class="title">Description: </td>
            <td><textarea name="description"><?php echo $item["description"];?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Edit words"></td>
        </tr>
    </table>
    </div><!-- End #add -->
</form>

</div><!--End: #khung-->
    </body>
</html>