    <div class="phone-images">
      <img ng-src="{{mainImageUrl}}">
    </div>
    <ul class="phone-thumbs list-unstyled">
      <li ng-repeat="img in phone.images">
        <img ng-src="{{img}}" ng-click="setImage(img)">
      </li>
    </ul>
  </div>
  <div class="col-xs-12 col-sm-8">
    <h1>{{phone.product_name}}</h1>
    <p>{{phone.product_description}}</p>
    <hr>

</div>