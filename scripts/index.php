<html> 
<head> 
<title>Regular Expression Test Tool</title>
</head> 
<body>
<pre id="output">		
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
$pattern = $_POST['pattern']; 
$subject = $_POST['subject']; 
$type = $_POST['type']; 

if ($type == 'match') { 
preg_match($pattern, $subject, $output); 
} elseif ($type == 'match_all') { 
preg_match_all($pattern, $subject, $output); 
} else { 
$replace = $_POST['replace']; 
$output = preg_replace($pattern, $replace, $subject); 
} 

print_r($output); 
}
?>
</pre> 
<form method="post"> 
<input type="radio" name="type" value="match" <?php echo (!isset($type) || ($type == 'match')) ? 'checked="true"' : ''?>>Match 
<input type="radio" name="type" value="match_all" <?php echo (isset($type) && ($type == 'match_all')) ? 'checked="true"' : ''?>>Match all 
<input type="radio" name="type" value="replace" <?php echo (isset($type) && ($type == 'replace')) ? 'checked="true"' : ''?>>Replace 
<br/> 

<label>Regex</label> 
<textarea type="text" name="pattern" rows="3" cols="99" required="true"><?php echo isset($pattern) ? $pattern : ''?></textarea> 
<br/> 

<label>Content</label> 
<textarea name="subject" rows="19" cols="99" required="true"><?php echo isset($subject) ? $subject : ''?></textarea> 
<br/> 

<label>Replace</label> 
<input type="text" name="replace" size="39" value="<?php echo isset($replace) ? $replace : ''?>"> 
<br/> 

<input type="submit"> 
</form> 
</body> 
</html>
