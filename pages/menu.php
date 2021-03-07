<link rel="stylesheet" href="../public/css/menu.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="../public/css/style.css">
<h1 id="head">Admin page </h1>
<?php
$web_path = $_SERVER['REQUEST_URI'];
$pattern = '/\.php$/';
$match = preg_match($pattern, $web_path);
$pattern = '/pages\/(.*?)\.php/';
preg_match_all($pattern, $web_path, $matches);
$classes = array(
    'home'  =>  '',
    'works' =>  '',
    'companies' =>  '',
    'keywords'  =>  '',
    'show_log'  =>  '',
    'login'  =>  '',
    'categories'=>'',
);
if (isset($matches[1][0]) && (strcmp($matches[1][0], 'index') == 0)) {
    $classes['home'] = 'class ="active"';
}
if (isset($matches[1][0]) && (strcmp($matches[1][0], 'works') == 0)) {
    $classes['works'] = 'class ="active"';
}
if (isset($matches[1][0]) && (strcmp($matches[1][0], 'companies') == 0)) {
    $classes['companies'] = 'class ="active"';
}
if (isset($matches[1][0]) && (strcmp($matches[1][0], 'keywords') == 0)) {
    $classes['keywords'] = 'class ="active"';
}
if (isset($matches[1][0]) && (strcmp($matches[1][0], 'categories') == 0)) {
    $classes['categories'] = 'class ="active"';
}
if (isset($matches[1][0]) && (strcmp($matches[1][0], 'show_log') == 0)) {
    $classes['show_log'] = 'class ="active"';
}
if (isset($matches[1][0]) && (strcmp($matches[1][0], 'login') == 0)) {
    $classes['login'] = 'class ="active"';
}

if ($match) {
    $pattern = '/pages\/.*?\.php/';
    $web_path = preg_replace($pattern, 'pages/', $web_path);
}
?>
<div id="navigation">
<ul>
    <li <?php echo $classes['home']?>><a href="<?php // echo $web_path ?>index.php">Home</a></span></li>
    <li <?php echo $classes['works']?>><a href="<?php // echo $web_path ?>works.php">Works</a></li>
    <li <?php echo $classes['companies']?>><a href="<?php // echo $web_path ?>companies.php">Companies</a></li>
    <li <?php echo $classes['keywords']?>><a href="<?php // echo $web_path ?>keywords.php">Keywords</a></li>
     <li <?php echo $classes['categories']?>><a href="<?php // echo $web_path ?>categories.php">Categories</a></li>
    <li <?php echo $classes['show_log']?>><a href="<?php // echo $web_path ?>show_log.php">Show Log</a></li>
    <?php if(!isset($_SESSION['id'])):?>
        <li <?php echo $classes['login'] ?>><a href="login.php">Login</a></li> 
    <?php else: ?>
        <li <?php echo $classes['login'] ?>><a href="logout.php">Logout</a></li>
    <?php endif;?>
</ul>
    <div style="clear: both"></div>
</div>
