<?php 

if(isset($_POST['submit'])) {
    preg_match_all($_POST['pre'], $_POST['content'], $out);
    
    var_dump($out);
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="pre" id="" value="/title.*?last 7 days.*?>(.*?)this week<\/a>/"><br><br>
        <textarea name="content" id="" cols="30" rows="10" value="<?php echo file_get_contents('https://stackoverflow.com/tags'); ?>"></textarea>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>