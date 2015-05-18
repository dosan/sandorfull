			<div class="span10">
				<p class="pull-right visible-xs">
					<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
				</p>

					<div class="col-xs-6 col-lg-4 item" ng-repeat="phone in phones | filter:search">
						<div class="span2">
							<img ng-src="public/img/products/{{phone.product_image}}" on-error-src="public/no-image.jpg" alt="{{phones.product_name}}">
							<span class="label"
							ng-init="product_status = phone.product_status == 1 ? 'Есть в наличи' : 'Под заказ'"
							ng-class="{'label-success': (phone.product_status == 1), 'label-warning': !(phone.product_status == 1)}"
							>{{product_status}}</span>
						</div>
						<h4><a class="" href="#/phone/{{phone.name_id}}">{{phone.product_name}}</a></h4>
						<p class="description">{{phone.product_description | limitTo: 255}}{{phone.product_description.length > 255 ? '...' : ''}}</p>
					</div>
			</div>