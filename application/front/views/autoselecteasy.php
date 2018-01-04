<!DOCTYPE html>
<html>

  <head>
    <script src="https://code.angularjs.org/1.3.16/angular.js"></script>
    <script data-semver="0.13.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="style.css" />-->
    <style>
        /* limit the height of the typeahead dropdown and make it scrollable */
        [typeahead-popup].dropdown-menu {
	overflow-y:auto;
}
    </style>
  </head>

  <body ng-app="app" ng-controller="appController">
    <h3>Typeahead Down Key Issue</h3>
    <div class="form-group">
      <label>Item</label>
      <input type="text" class="form-control" ng-model="model.item" 
        placeholder="Type: 'Item' then use down arrow to scroll list."
        typeahead="item as item.name for item in data | filter:$viewValue"/>
    </div>
    <script>
        angular.module('app', ['ui.bootstrap'])
  .controller('appController', function($scope) {
    $scope.data = [
      {name: 'Item 1'},
      {name: 'Item 2'},
      {name: 'Item 3'},
      {name: 'Item 4'},
      {name: 'Item 5'},
      {name: 'Item 6'},
      {name: 'Item 7'},
      {name: 'Item 8'},
      {name: 'Item 9'},
      {name: 'Item 10'}
      ];
  });
        </script>
    
  </body>

</html>
