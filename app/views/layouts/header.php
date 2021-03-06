<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact secure</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo CSS_PATH ?>core.css" type="text/css">
	<link rel="stylesheet" href="<?php echo CSS_PATH ?>style.css" type="text/css">
	<link rel="stylesheet" href="<?php echo JS_PATH ?>uploadify/uploadify.css" type="text/css">
	<?php echo isset($hd_script) ? $hd_script : NULL ?>
	
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/">Web Store</a>
				<a class="navbar-brand" href="<?php echo URL ?>gallery">Gallery</a>
				<a class="navbar-brand" href="<?php echo URL ?>post">Posts</a>
				<a class="navbar-brand" href="<?php echo URL ?>contact">Contact</a>
				<a class="navbar-brand" href="<?php echo URL ?>admin">Admin</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<?php if (Session::get('user_login_status') == 1): ?>
						<li><a href="/user"> <?php echo Session::get('user_name') ?></a></li>
						<li><a href="/user/logout">Log Out</a></li>
					<?php else: ?>
						<li><a href="/user">Login</a></li>
						<li><a href="/user/register">Sign Up</a></li>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container" ng-app="productApp" ng-controller="PhoneListCtrl">
	<div class="err"></div>
	<div class="row">