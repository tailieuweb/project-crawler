<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style type="text/css">
                #content .title{
                    font-weight: bold;
                    font-size: 15;
                    color: brown;
                }
                .enable_active{
                    background: #F7F4E9;
                    border: 1px solid #eee;
                    padding: 10px;
                    font-size: 14px;
                }
                .header{
                    //border-bottom: 1px solid #eee;
                    text-align: left;
                    margin:10px 30px;
                    padding:0px;
                }
                .header span{
                    font-size: 15px;
                    font-weight: bold;
                }
                .infor{
                    padding-left: 30px;
                   
                }
                #content .item{
                     margin: 15px 0px;
                }
                .clear{
                    clear: both;
                }
                #infor_simple {
                  margin: auto;
                }
                #infor_simple .item{
                   
                }
                #detail .infor{
                    text-align:justify;
                }
                #detail .title{
                     margin: 10px 0px;
                     text-align: left;
                     
                }
                .item .title{
                    width: 20%;
                    float: left;
                    text-align: left;
                    
                    
                }
                
                .item .infor{
                    width: 76%;
                    float: right;
                    text-align: justify;
                    color:#666;
                    font-size: 13px;
                    font-weight: bold;
                }
                .name_work{
                    background: #F7F4E9;
                    border: 1px dashed brown;
                    color: #333;
                    padding: 5px;
                    font-size: 18px;
                    text-align: center;
                    margin:20px 0px;
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
require_once '../model/keys_works.php';
require_once '../sites/Sites.php';
$words=new Works();
?>
<?php $item=$words->select(array("listId_works"=>$_GET["id"]),NULL.FALSE);?>
<?php include_once 'menu.php'; ?>
    
    <div id="content">
        <div class="header">
        <h2>
            Detail Works &nbsp;
            <span>
            <a href="edit_works.php?id=<?php echo $item[0]["id"]; ?>" class="edit" title="edit work"> Edit</a>
            <a href="delete_works.php?id=<?php echo $item[0]["id"]; ?>" class="delete" title="delete work"> Delete</a>
            </span>
        </h2>
        
    </div>
    <div style="width: 90%; margin: auto;">
        
    <div class="item">      
            <div class="name_work"><?php echo $item[0]["name"];?></div>
    </div> 
        <div id="infor_simple">
      <div class="item">   
            <div class="title">Company - Name: </div>
            <div class="infor"><?php echo $item[0]["company_name"];?></div>
            <div class="clear"></div>
      </div>
      <div class="item">
            <div class="title">Company - Localtion: </div>
            <div class="infor"><?php echo $item[0]["location"];?></div>
            <div class="clear"></div>
      </div> 
      <div class="item">
            <div class="title">Company - Address: </div>
            <div class="infor"><?php echo $item[0]["company_address"];?></div>
            <div class="clear"></div>
      </div>
     <div class="item">
            <div class="title">Company - Website: </div>
            <div class="infor"><?php echo $item[0]["url"];?></div> 
            <div class="clear"></div>
     </div>
        </div>
        <div id="detail">
        
            <div class="title">Company - Profile: </div>
            <div class="infor "><div class='enable_active'><?php echo $item[0]["company_profile"];?></div></div>
       
            <div class="title">Description: </div>
            <div class="infor"><div class='enable_active'><?php echo $item[0]["description"];?></div></div>
       
            <div class="title">experience_requirements:</div>
            <div class="infor"><div class='enable_active'><?php echo $item[0]["experience_requirements"];?></div></div>
     </div>
    </div>
        <br>
</div><!--End: #khung-->
 <?php require_once 'footer.php'; ?>
</div><!--End #Wraper -->
</body>
</html>