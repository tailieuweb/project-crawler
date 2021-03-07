<!--FORM-->
<!--PHP handler-->
<head>
    <meta charset="utf8">
</head>
<?php
require_once '../model/patterns_model.php';
$obj_pattern = new Patterns_model();
$obj_alilas = $obj_pattern->get_name_alilas();

if (isset($_POST['submit_pattern'])) {
    $data['id_site'] = $_GET['id_site'];
    $data['machine_name'] = trim($_POST['machine_name']);
    $data['pattern_name'] = trim($_POST['pattern_name']);
    if ($data['id_site'] <= 0 || empty($data['pattern_name'])) {
        echo 'Đã xảy ra lỗi!';
    } else {
        $flag = $obj_pattern->get_pattern_id($data['machine_name']);
        if (!$flag) {
            //insert to the default_allias_pattern table
            $id_pattern = $obj_pattern->insert_allias_pattern($data);
            if ($id_pattern) {
                //insert to the default_site_patters table
                $obj_pattern->insert_site_patterns($data['id_site'], $id_pattern);
                echo 'Đã lưu thành công';
            }
        } else
            echo 'Đã xảy ra lỗi!';
    }
}
?>
<form action="#" method="post">
    <table>
<!--        <tr>
            <td>Pattern name</td>
            <td><input type="text" name="pattern_name" value="<?php echo @$_POST['pattern_name'] ?>"></td>
        </tr>
         <tr>
           <td>Machine name</td>
            <td><input type="text" name="machine_name" value="<?php echo @$_POST['machine_name'] ?>"></td>
        </tr>-->
        <tr>
            <td>Pattern name</td>
            <td>
                <input type="text" name="pattern_name" list="name_pattern" value="<?php echo @$_POST['pattern_name'] ?>"/>
                <datalist id="name_pattern">
                    <?php foreach ($obj_alilas as $alilas): ?>
                        <option value="<?php echo $alilas['name_pattern'] ?>"><?php echo $alilas['name_pattern'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </datalist>
            </td>
        </tr>
        <tr>
            <td>Machine name</td>
            <td>
                <input type="text" name="machine_name" list="machine_name" value="<?php echo @$_POST['machine_name'] ?>"/>
                <datalist id="machine_name">
                    <?php foreach ($obj_alilas as $alilas): ?>
                        <option value="<?php echo $alilas['machine_name'] ?>"><?php echo $alilas['machine_name'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </datalist>
            </td>
        </tr>
       
<!--        <tr>
            <td>Machine name</td>
            <td>
                <div style="position:relative;width:200px;height:25px;border:0;padding:0;margin:0;">
                    <select style="position:absolute;top:0px;left:0px;width:200px; height:25px;line-height:20px;margin:0;padding:0;" onchange="document.getElementById('displayValue').value=this.options[this.selectedIndex].text; document.getElementById('idValue').value=this.options[this.selectedIndex].value;">
                        <option></option>
                        <option value="one">one</option>
                        <option value="two">two</option>
                        <option value="three">three</option>
                    </select>
                    <p>	
                        <input type="hidden" name="displayValue" placeholder="add/select a value" id="displayValue" style="position:absolute;top:0px;left:0px;width:180px;height:25px;border:1px solid #556;" onfocus="this.select()"><br>
                        <input type="hidden" name="idValue" id="idValue" value="">
                    </p>
                </div>
            </td>
        </tr>-->
    </table>
    <input type="submit" name="submit_pattern" value="Save" >
</form>
<!--END FORM-->
<!--CHECK VALUE-->
<!--END CHECK VALUE-->