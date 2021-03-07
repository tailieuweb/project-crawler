<?php 

$pattern = '/user-gravatar32[\S\s]*?<img.*?src="(.*?)"/';
$content = file_get_contents('http://localhost/project-crawler/tagged.html');
preg_match_all($pattern, $content, $out);
var_dump($out);

// if(isset($_POST['submit'])) {
    
    
// }

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
    <!-- <form action="" method="post">
        <input type="text" name="pre" id="" value="/summary[\S\s]*?<a.*?question-hyperlink.>(.*?)<\/a>/"><br><br>
        <textarea name="content" id="" cols="30" rows="10" value="<?php echo file_get_contents('https://stackoverflow.com/questions/tagged/angular'); ?>"></textarea>
        <input type="submit" value="Submit" name="submit">
    </form> -->
</body>
</html>