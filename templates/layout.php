<!doctype html>
<html lang="en" ng-app="phonecatApp">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/angular.css">
</head>
<body ng-controller="PhoneListCtrl">
	<div class="container">
		<div class="row">
			<div class="header span3">
				<h1>CSS Grid</h1>
			</div>
			<div class="search span3 offset6"><input type="text" name="" id="" placeholder="Search..." ng-model="search"></div>
		</div>
		<div class="row">
			<div class="slider span12"></div>
		</div>
		<div class="row">
			<div ng-view=""></div>
		</div>
		<div class="row">
			<div class="thumb span2"><img src="http://place-hold.it/140x100"></div>
			<div class="thumb span2"><img src="http://place-hold.it/140x100"></div>
			<div class="thumb span2"><img src="http://place-hold.it/140x100"></div>
			<div class="thumb span2"><img src="http://place-hold.it/140x100"></div>
			<div class="thumb span2"><img src="http://place-hold.it/140x100"></div>
			<div class="thumb span2"><img src="http://place-hold.it/140x100"></div>
		</div>
		<div class="row">
			<div class="sidebar span2">
				<nav>
					<ul>
						<li><a href="">Item 1</a></li>
						<li><a href="">Item 2</a></li>
						<li><a href="">Item 3</a></li>
						<li><a href="">Item 4</a></li>
						<li><a href="">Item 5</a></li>
						<li><a href="">Item 6</a></li>
					</ul>
				</nav>
			</div>
			<div class="content span10">
				<h2>Lorem ipsum dolor sit amet.</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint quibusdam eveniet aliquam voluptatibus voluptate sed a labore optio deserunt rerum ducimus tenetur numquam rem aspernatur iusto. Cumque rem amet dignissimos sed adipisci necessitatibus possimus! Harum labore laudantium eligendi quaerat maiores minima nihil doloremque iure quod vitae facilis neque ipsam? A quod itaque eaque at nostrum officia commodi harum fugiat rem vitae debitis sit ut corporis. Rerum sapiente amet error aut.</p>
				<p>Dignissimos perspiciatis sint beatae nesciunt ipsum nemo optio eius obcaecati ullam expedita aliquid ab id alias recusandae velit commodi non necessitatibus autem quasi incidunt adipisci minima placeat culpa excepturi fugit in ducimus quas eum quia ipsa. Illum non veniam necessitatibus beatae blanditiis laboriosam amet dolorum doloribus quia tempore rem nemo a vero delectus veritatis pariatur illo! Adipisci repudiandae consequatur quae est voluptates odio delectus veniam consequuntur voluptas explicabo tempore temporibus.</p>
				<p>Repellat beatae assumenda corporis placeat nulla iste incidunt nobis tempore aliquam ipsam sunt labore consequuntur consectetur ab itaque recusandae eius impedit maiores tenetur nisi eligendi ipsum repellendus soluta earum numquam ullam vel perferendis laboriosam fugiat laudantium a minus veritatis necessitatibus quis cum qui officia animi quae doloribus non repudiandae esse. Repellendus numquam placeat itaque incidunt provident molestias sunt asperiores voluptatibus necessitatibus maxime? Doloremque est modi cum magni quo incidunt deserunt.</p>
				<p>Consequuntur et non laudantium modi aut. Magnam aperiam optio et ea ratione. Provident perferendis quam ullam error soluta ipsa praesentium assumenda consequuntur fuga incidunt ducimus labore quisquam. Rerum cupiditate totam odit amet fugit soluta facere minima similique autem dignissimos exercitationem voluptates ab molestias labore aliquam velit enim? Repudiandae laborum tenetur modi sit necessitatibus numquam excepturi rerum eaque nemo minus nobis at aspernatur tempora accusantium amet? Temporibus sunt nemo dolore et.</p>
			</div>
		</div>
		<div class="row">
			<div class="footer span12"><small>2012 © Lorem ipsum dolor sit amet.</small></div>
		</div>
	</div>
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<script type="text/javascript" src="/public/js/jquery.js"></script>
	<script type="text/javascript" src="/public/js/bootstrap.min.js"></script>
	<script src="js/angular.js"></script>
	<script src="js/angular-route.js"></script>
	<script src="js/angular-animate.js"></script>
	<script src="js/animate.js"></script>
	<script src="js/controllers.js"></script>
</body>
</html>
