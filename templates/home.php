	<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-xs-12 col-sm-9">
				<p class="pull-right visible-xs">
					<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
				</p>
				<div class="jumbotron">
					<h1>Hello, world!</h1>
					<p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
				</div>
				<div class="row">
					<div class="col-xs-6 col-lg-4 item" ng-repeat="phone in phones | filter:search">
						<div class="preview-img text-center">
							<img ng-src="{{phone.image_url}}" alt="{{phones.name}}">
							<span class="label"
							ng-init="status = phone.status == 1 ? 'Есть в наличи' : 'Под заказ'"
							ng-class="{'label-success': (phone.status == 1), 'label-warning': !(phone.status == 1)}"
							>{{status}}</span>
						</div>
						<h2>{{phone.name}}</h2>
						<p>{{phone.snippet}}</p>
						<p><a class="btn btn-default" href="#/phone/{{phone.name_id}}" role="button">View details &raquo;</a></p>
					</div><!--/.col-xs-6.col-lg-4-->
				</div><!--/row-->
			</div><!--/.col-xs-12.col-sm-9-->
			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
				<h3 class="text-center">Фильтр телефонов</h3>
					<div class="list-group">
						<div class="list-group-item text-center">
						<form>
							<input type="text" class="form-control" placeholder="Search..." ng-model="search">
						</form>
						</div>
					</div>
			 </div><!--/.sidebar-offcanvas-->
		</div><!--/row-->

		<hr>