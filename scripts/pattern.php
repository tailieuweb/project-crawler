<!DOCTYPE html>
<?php
require_once '../model/sites.php';
require_once '../model/patterns_model.php';
//variables decleration
$obj = new Sites_model();
$sites = $obj->get_sites(true);
$model = new Patterns_model();
$patterns_name=array();


//handle function
if (isset($_GET['id_site'])) {
    $patterns_name = $model->get_pattern_name_by_site($_GET['id_site']);
}
//----------------------Save to database-------------------------
if(isset($_POST['submit_all'])){
    $data['id_site']=$_POST['id_site'];
    foreach ($_POST as $list)
    {
        if(is_array($list)&sizeof($list)>0){
            
            $is_first_item=TRUE;
            //assign the first item as id pattern
            $data['id_pattern']=$list[0];
            $model->delete_pattern_value($data);
            
            foreach ($list as $item){
                //check the first item to skip saving to database
                if($is_first_item){
                    $is_first_item=FALSE;
                    continue;
                }
               if(trim($item)){
               $data['value_pattern']=  trim($item);
               $model->insert_pattern_value($data);
               }
            }
        }
    }
}
?>
<html>
    <script type="text/javascript">
        function jsFunction(value)
        {
            window.location.replace("pattern.php?id_site=" + value);
        }
    </script>

    <head>
        <meta charset='utf-8'/>
        <title>Pattern  </title>

        <link rel="stylesheet" href="../css/colorbox.css" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.colorbox-min.js"></script>

        <script>
        $(document).ready(function() {
            $(".iframe").colorbox(
                    {
                        iframe: true,
                        fastIframe: false,
                        width: "450px",
                        height: "480px",
                        transition: "fade",
                        scrolling: false,
                        onClosed: function() {
                            window.location.reload();
                        }
                    }
            );
        });
        </script>


        <style>
            #cboxOverlay{ background:#666666; }
        </style>

    </head>

    <body>
        
        <form action="#" method="POST">
            
            <!--List of sites-->
            <select id="id_site" name="id_site" onchange="jsFunction(this.value);">
                <?php foreach ($sites as $site): ?>
                    <option value="<?php echo $site['id'] ?>" 
                    <?php
                    if (isset($_GET['id_site'])) {
                        $_GET['id_site'] === $site['id'] ? print 'selected="selected"' : '';
                    }
                    ?>
                            ><?php echo $site['name']; ?></option>
                        <?php endforeach; ?>
            </select>
            
            <br/>
            
            <!--Print pattern-->
            <?php foreach($patterns_name as $pattern): ?>
            
                <b><?php echo $pattern['name_pattern']; ?></b><br/>
                
                <div class="<?php echo $pattern['machine_name'];?>">
                    
                        <?php $value_patterns=$model->get_pattern_value($pattern['id_site'],$pattern['id_pattern']); ?>
                    
                    <input type="hidden" 
                                       name="<?php echo $pattern['machine_name']?>[]" 
                                       value="<?php echo $pattern['id']; ?>"/>
                            
                        <?php foreach ($value_patterns as $value): ?>
                            <div>
                                <input type="text" 
                                       name="<?php echo $pattern['machine_name']?>[]" 
                                       value="<?php echo htmlspecialchars($value['value_pattern']); ?>"/>
                                
                                <a href="#" class="remove_field">Remove</a>
                            </div>
                        <?php endforeach; ?>
                    
                    <button class="add_field_button">+</button>
                </div>
            <?php endforeach; ?>
         <br/>
         <p><h3> <a class='iframe' href="form_new_pattern.php?id_site=<?php isset($_GET['id_site']) ? print_r($_GET['id_site']) : (isset($sites) ? print_r($sites[0]['id']) : '-1'); ?>" id="link">Add pattern name</a></h3></p>
         <br/>
          <input type="submit" value="Save to databse" name="submit_all">
    </form>
</body>

    <!--javascript function-->
    <script type="text/javascript">
        $(document).ready(function() {
       
            $(".add_field_button").click(function(e) { //on add input button click
                e.preventDefault();
                var machine_name = $(this).parent().attr('class');
                $(this).parent().append('<div><input type="text" name="'+machine_name+'[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
            });

            $($(this).parent).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
            })
        });
    </script>
</html>