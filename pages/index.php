<?php
session_start(); 
if(!isset($_SESSION['id']))
    header ('location:login.php?login=0');
?>
<html>
    <head>
        <title>Home page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            #content{
                text-align: left;
            }
       
            #total_crawl img{
                border: 1px solid #ccc;
                padding: 3px;
                width: 100px;
                height:50px;
                margin-right: 5px;
            }
            #total_crawl a{
                color: #3B5998;
                font-size: 14px;
                text-decoration: none;
                font-weight: bold;
            }
            #total_crawl h3{  
                //border-bottom: 1px solid #ccc;
                padding: 3px 3px 3px 20px;
                font-size: 16px;
                
            }
            #total_crawl{
                width: 100%;
            }
            #total_crawl table{
                margin: auto;
                font-size: 14px;
              border-left: 1px solid #eee;
                border-top: 1px solid #eee;
            }
            #total_crawl td{
               // border: 1px solid #eee;
               
                border-right: 1px solid #eee;
                 border-bottom: 1px solid #eee;
                
                padding: 10px 5px; 
                
            }           
           .title{
               color: #333;
               height: 25px;
           }
        </style>
    </head>
    <body>
        <?php
        require_once '../model/db.php';
        require_once '../model/works.php';
        $works=new Works();
        ?>
        <div id="wraper">
            <?php include_once 'menu.php'; ?>
            <div id="content">
                    <div>
                    <div id="total_crawl">
                        <?php $total=$intership=$works->select($params=array("id_site"=>null,"keywork"=>null), null, TRUE) ?>
                        <?php $total=$total[0]["counter"]!=0?$total[0]["counter"]:1;?>
                        <h3>collect from website  </h3>
                        <table border="0" width="90%" cellspacing="0" cellpadding="0">
                            <tr class="title">
                                <td width="33.333%">Website</td>
                                <td width="33.333%">Works</td>
                                <td width="33.333%">percent</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="http://images.vietnamworks.com/img/jobseekers/logo.png" align="middle">
                                    <a href="http://www.vietnamworks.com/" target="_blank">VietnamWorks</a>
                                </td>
                                <td class="right">
                                    <?php $vietnamwork=$works->select($params=array("id_site"=>1,"keywork"=>null), null, TRUE)?>
                                    <?php echo $vietnamwork[0]["counter"];?>
                                </td>
                                <td class="right"><?php echo (float) round(($vietnamwork[0]["counter"]/$total)*100,2)." %" ?></td>
                            </tr>
                            <tr>
                                <td> 
                                    <img src="http://www.careerlink.vn/images/logo.png?v7" align="middle">
                                    <a href="http://www.careerlink.vn/" target="_blank">CareerLink</a>
                                </td>
                                <td class="right">
                                    <?php $careerlink=$works->select($params=array("id_site"=>2,"keywork"=>null), null, TRUE)?>
                               <?php echo $careerlink[0]["counter"];?>
                                </td>
                                <td class="right"><?php echo (float)  round(($careerlink[0]["counter"]/$total)*100,2)." %"?></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="http://www.internship.edu.vn/images/stories/bannersuppost.png" align="middle">
                                    <a href="http://www.internship.edu.vn/" target="_blank">Internship</a>
                                </td>
                                <td class="right">
                                <?php $intership=$works->select($params=array("id_site"=>3,"keywork"=>null), null, TRUE)?>
                               <?php echo $intership[0]["counter"];?>    
                                </td>
                                <td class="right"> <?php echo (float) round(($intership[0]["counter"]/$total)*100,2)." %" ?></td>
                            </tr>
                            <tr>
                                <td class="title">Total works </td>
                                <td class="right"><?php echo $total?></td>
                                <td class="right">100%</td>
                            </tr>
                        </table>   
                    </div>
                    <div class="clear" style="clear: both;">&nbsp;</div>
            </div>
        </div><!-- End #Content -->
        <?php require_once 'footer.php';?>
    </body>
</html>

