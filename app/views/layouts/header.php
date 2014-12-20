<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contoct secure</title>
	<link rel="stylesheet" href="<?php echo CSS_PATH ?>style.css" type="text/css">
	<link rel="stylesheet" href="<?php echo JS_PATH ?>uploadify/uploadify.css" type="text/css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css">
	<script type="text/javascript" src="<?php echo JS_PATH ?>jquery.js"></script>
	<script type="text/javascript" src="<?php echo JS_PATH ?>core.js"></script>
	<script type="text/javascript" src="<?php echo JS_PATH ?>formObject.js"></script>
	<script type="text/javascript" src="<?php echo JS_PATH ?>uploadify/jquery.uploadify.min.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/application.js"></script>
	<script>
	<?php
		$jsMessages = json_encode($this->mess);
		echo "var jsMessages = ". $jsMessages . ";\n";
	?>
	</script>
</head>
<body>
	<div class="err"></div>
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
						<a class="navbar-brand" href="/">Home</a>
						<a class="navbar-brand" href="<?php echo URL ?>post">Posts</a>
						<a class="navbar-brand" href="<?php echo URL ?>product">Web Store</a>
						<?php if (Session::get('user_range') == 'admin'): ?>
							<a class="navbar-brand" href="<?php echo URL ?>admin">Admin</a>
						<?php endif ?>
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