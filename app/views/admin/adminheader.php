<!DOCTYPE html>
<html lang="en">
<head>
	<title>Web store(sample)</title>
	<link rel="stylesheet" href="<?php echo CSS_PATH ?>style.css" type="text/css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css">
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-1.7.1.min.js"></script>
	<script src="<?php echo URL; ?>public/js/application.js"></script>
	<script src="<?php echo URL; ?>public/js/admin.js"></script>
</head>
<body>
<body>
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
						<a class="navbar-brand" href="/">Home</a>
						<a class="navbar-brand" href="<?php echo URL ?>post">Posts</a>
						<a class="navbar-brand" href="<?php echo URL ?>product">Web Store</a>
						<?php if (Session::get('user_range') == 'admin'): ?>
							<a class="navbar-brand" href="<?php echo URL ?>admin">Admin</a>
						<?php endif ?>
					</ul>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<?php if (Session::get('user_login_status') == 1): ?>
							<li><a href="/user"> <?php echo Session::get('user_name') ?></a></li>
							<li><a href="/user/logout">Log Out</a></li>
						<?php else: ?>
							<li><a href="/user/login">Login</a></li>
							<li><a href="/user/register">Sign Up</a></li>
						<?php endif ?>
					</ul>
				</div>
			</div>
		</nav>