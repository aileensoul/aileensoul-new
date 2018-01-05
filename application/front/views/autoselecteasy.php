<!DOCTYPE html>
<html>
    
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>

<body ng-app="myApp">

<p><a href="#/!">Main</a></p>

<a href="red">Red</a>
<a href="angularurl/green">Green</a>
<a href="angularurl/blue">Blue</a>

<div ng-view></div>

<script>
var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider,$locationProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "main.html"
    })
    .when("/red", {
        templateUrl : "red.html"
    })
    .when("/green", {
        templateUrl : "green.html"
    })
    .when("/blue", {
        templateUrl : "blue.html"
    });
    
    $locationProvider.html5Mode(true);
});
</script>

<p>Click on the links to navigate to "red.htm", "green.htm", "blue.htm", or back to "main.htm"</p>
</body>
</html>
