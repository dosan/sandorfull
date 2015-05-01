'use strict';
var phonecatApp = angular.module('phonecatApp', ['ngRoute', 'ngAnimate']);

phonecatApp.config(["$routeProvider", "$locationProvider", function($routeProvide, $locationProvider)
{
	$routeProvide.when("/", {
		templateUrl: "/templates/home.php",
		controller: "PhoneListCtrl"
	}).when("/about", {
		templateUrl: "/templates/about.php",
		controller: "AboutCtrl"
	}).when("/contact", {
		templateUrl: "/templates/contact.php",
		controller: "ContactCtrl"
	}).when("/phone/:phoneId", {
		templateUrl: "/templates/phone-detail.php",
		controller: "PhoneDetailCtrl"
	}).otherwise({
		redirectTo: "/"
	});
}]);
phonecatApp.filter('checkmark', function() {
  return function(input) {
    return input ? '\u2713' : '\u2718';
  }
});

phonecatApp.controller('PhoneListCtrl',['$scope', '$http', '$location', function($scope, $http, $location){
	$http.get('/phones/getphones').success(function(data){
		$scope.phones = data;
	}).error(function(data, status, headers, config){
		console.log("This is error ", data);
	});
}]);
phonecatApp.controller('AboutCtrl', ['$scope', '$http', '$location', function($scope, $http, $location){
}]);
phonecatApp.controller('ContactCtrl', ['$scope', '$http', '$location', function($scope, $http, $location){
}]);
phonecatApp.controller('PhoneDetailCtrl', ['$scope', '$http', '$location', '$routeParams', function($scope, $http, $location, $routeParams){
	$scope.phoneId = $routeParams.phoneId;
	var url = 'public/js/phones/'+$routeParams.phoneId+'.json';
	$http.get(url).success(function(data){
		$scope.phone = data;
		$scope.mainImageUrl = data.images[0];
	});
	$scope.setImage = function(imageUrl){
		$scope.mainImageUrl = imageUrl;
	}
}]);