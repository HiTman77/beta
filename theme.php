<?php
global $Wcms;
$page_image = $Wcms->asset('images/default.jpg');
$heading = $Wcms->page('title');
$height = 100;
$subtitle = "";
$type = "";
$readMore = "";
if($Wcms->currentPage == $Wcms->get('config', 'login')) {
	$subtitle = $Wcms->page('content');
} else {
	// Check if image for this page exisis
	if(isset($Wcms->get("pages", $Wcms->currentPage)->background) && $Wcms->get("pages", $Wcms->currentPage)->background != "") {
		$page_image = "data/files/" . $Wcms->get("pages", $Wcms->currentPage)->background;
	}
	$height = isset($Wcms->get('pages', $Wcms->currentPage)->themeHeaderHeight) ? $Wcms->get('pages', $Wcms->currentPage)->themeHeaderHeight : 100;
	// $heading = getEditableArea("heading", $Wcms->page('title'));
	// $subtitle = getEditableArea("subtitle", "");
	$type = isset($Wcms->get('pages', $Wcms->currentPage)->parallax) ? $Wcms->get('pages', $Wcms->currentPage)->parallax : "dual";
	$readMore = isset($Wcms->get('pages', $Wcms->currentPage)->readMoreText) ? $Wcms->get('pages', $Wcms->currentPage)->readMoreText : "Read more";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$Wcms->page('title')?> - <?=$Wcms->get('config','siteTitle')?></title>
<meta name="description" content="<?=$Wcms->page('description')?>">
<meta name="keywords" content="<?=$Wcms->page('keywords')?>">
<link rel="shortcut icon" href="/data/files/favicon.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400&display=swap" rel="stylesheet">
<?= $Wcms->css() ?>
 
<link rel="stylesheet" href="<?= $Wcms->asset('css/style.css') ?>?v10">

<script>var page=<?=json_encode($Wcms->currentPage)?>,heading=<?=json_encode($heading)?>,subtitle=<?=json_encode($subtitle)?>,image=<?=json_encode($page_image)?>,height=<?=json_encode($height)?>,type=<?=json_encode($type)?>,loggedIn=<?=json_encode($Wcms->loggedIn)?>;</script>
<style>.parallax{height:<?=htmlentities($height)?>vh;}</style>
</head>
<body>
<?= $Wcms->settings() ?>
<?= $Wcms->alerts() ?>
<nav class="navbar navbar-default<?php if($height == 0)echo " background"; if(!$Wcms->loggedIn && $height == 0)echo " sticky no-animation"; ?>">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?=$Wcms->url()?>" title="<?=$Wcms->page('title')?> on <?=$Wcms->get('config','siteTitle')?>"><img src="/data/files/logo.png" alt="<?=$Wcms->page('title')?>"></a>
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav navbar-right"><?=$Wcms->menu()?></ul>
</div></div></nav>
<?php if($height != 0): ?>
<header class="parallax-wrapper">
<div class="parallax" style='background-image: url(<?=json_encode($page_image)?>);'>
<div class="inner">
<h1><?= $heading ?></h1>
<h3><?=$Wcms->page('description')?></h3>
<h2><?=$Wcms->page('keywords')?></h2>
<?= $Wcms->loggedIn ? $subtitle : "<p>$subtitle</p>" ?>
</div>
<div class="rolly"><?php if($readMore): ?><a href="#content" class="scrolly"><?=$readMore?></a></div><br>
<?php endif; ?>
</div>
</header>
<?php endif; ?>
<?php if($Wcms->currentPage != $Wcms->get('config', 'login')): ?>
<div class="container" id="content"><div class="row"><div class="col-lg-12 text-center padding40">
<?=$Wcms->page('content')?>
</div></div></div>
<div class="container-fluid CTA">
<div class="text-center padding40">
<?=$Wcms->block('subside')?>
</div></div>
<?php else: ?>
<style>.parallax .scrolly { display: none }</style>
<?php endif; ?>
<footer class="container-fluid"><div class="text-center padding20">
<br><br>
<?=$Wcms->footer()?>
<br><br><br>
</div>
</footer>
<?php
		if(!$Wcms->loggedIn) {
			echo "<script src='https://code.jquery.com/jquery-1.12.4.min.js' integrity='sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ' crossorigin='anonymous'></script>";
		}
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
<?=$Wcms->js()?>
<script src="<?=$Wcms->asset('js/script.js')?>"></script>
<?php if($type == "scroll") echo "<style>.parallax{background-attachment:fixed;}</style>"; ?>
<?php if($height == 100) echo "<style>.parallax{padding-top:0;}</style>"; ?>
</body>
</html>