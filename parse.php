<?php 

$pattern = '/header[\S\s]*?<a\shref="(.*?)"/';
$content = file_get_contents('http://localhost/project-crawler/tag.html');
preg_match_all($pattern, $content, $out);

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
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="pattern_form">
            <div class="header-form">
                <h1>Contactanos</h1>
                <p>Con gusto te ayudaremos</p>
            </div>
            <form action="" method="POST" name="formRegular">
                <input type="text" name="regularText" id="" placeholder="Regular Expression">
                <input type="text" name="regularFile" id="file_regular" placeholder="Name file..">
                <textarea name="" id="" cols="30" rows="10" placeholder="HTML.."></textarea>
                <button id="btn-pattern" name="submit-regular">Submit</button>
            </form>
            
                
        </div>
</body>
</html>