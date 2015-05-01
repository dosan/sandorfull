<!DOCTYPE html>
<html lang="en" ng-app="phonecatApp">
<head>
	<meta charset="utf-8">
	<title>Angular Phonecat App</title>
	<link rel="stylesheet" href="/css/angular.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" type="text/css">
</head>
<body ng-controller="PhoneListCtrl">
	 <nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Project name</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#/">Home</a></li>
				<li><a href="#/about">About</a></li>
				<li><a href="#/contact">Contact</a></li>
			</ul>
		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	 </nav><!-- /.navbar -->

	 <div class="container view-container">
  		<div ng-view class="view-frame"></div>
		<footer>
		  <p>&copy; Company 2014</p>
		</footer>

	 </div><!--/.container-->
<!-- Angular.js core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript" src="/public/js/bootstrap.min.js"></script>
<script src="js/angular.js"></script>
<script src="js/angular-route.js"></script>
<script src="js/angular-animate.js"></script>
<script src="js/animate.js"></script>
<script src="js/controllers.js"></script>
<!--Angular.js Route-->

</body>
</html>

