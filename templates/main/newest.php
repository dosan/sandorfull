			<div class="offset3 span10 item">
				<div class="span3"  style="background-color:white" ng-repeat="phone in phones | filter:search">
					<div class="">
						<img class="product" ng-src="public/img/products/{{phone.product_image}}" on-error-src="public/no-image.jpg" alt="{{phones.product_name}}">
						<div>
						<span class="label"
						ng-init="product_status = phone.product_status == 1 ? 'Есть в наличи' : 'Под заказ'"
						ng-class="{'label-success': (phone.product_status == 1), 'label-warning': !(phone.product_status == 1)}"
						>{{product_status}}</span>
						</div>
					</div>
					<div class="">
					<h4><a href="#/phone/{{phone.name_id}}">{{phone.product_name}}</a></h4>
					<p>{{phone.product_description | limitTo: 200}}{{phone.product_description.length > 200 ? '...' : ''}}</p>
					</div>
				</div>
			</div>