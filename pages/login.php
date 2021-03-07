<?php
session_start();
?>
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">
       <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>    -->  
        <style type="text/css">
            #login{
                width: 30%;
                margin:50px auto;
                border: 1px solid #ccc;
                padding: 5px;
                
                box-shadow:0px 0px 3px #ccc;
            }
            .head{
                border-bottom: 1px solid #999;
                padding: 7px 0px;
                margin: 10px;
                font-size: 13px;
                color: brown;
            }
            .head span{
                font-size: 20px;
                font-weight: bold;
                color: #333;
            }
            label{
                font-size: 14px;
                font-weight: bold;
                color: #666;
            }
            input[type="text"],input[type="password"]{
                width: 100%;
                background: #fff;
                border: 1px solid #ccc;
                padding: 5px;
                margin: 5px 0px;
                border-radius:20px;
        </style>
    </head>
    <?php require_once '../model/login.php';?>
    <?php $md_log=new Login(); ?>
    <body>
        <?php include_once 'menu.php'; ?>
        <div id="content">
            <div id="login">
            <?php
                if(isset($_POST['submit'])){
                    $params=array(
                                    'name'=>$_POST['name'],
                                    'pass'=>$_POST['pass']
                                  );
                    $login=$md_log->checkLogin($params);
                            if($login):
                                $_SESSION['id']=$login['id'];
                                header('location:index.php');
                            else:
                                echo '<div class="notice_erro" style="width:100%;"><div class="child">The username or password you entered is incorrect.</div></div>';
                            endif;
                        }
             ?>
                <form method="post" action="login.php">
                    <table width="100%">
                        <tr>
                            <td colspan="2" align="left" class="head"> <span>Login &laquo; </span> &nbsp; Enter your username and Password</td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td><label>Username</label></td>
                            <td><input type="text" name="name"></td>
                        </tr>
                        <tr>
                            <td><label>Password</label></td>
                            <td><input type="password" name="pass"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="right"><input type="submit" name="submit" value="Login"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
         <?php require_once 'footer.php'; ?>
    </body>
</html>