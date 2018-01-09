
<!DOCTYPE html>
<html ng-app="app">
  <head>
    <title>angular-vs-repeat</title>
    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.angularjs.org/1.2.16/angular.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/angular-vs-repeat.js'); ?>"></script>
    <style>
      body{
        padding: 20px 50px;
      }
      .repeater-container{
        height: 454px;
        overflow: auto;
        box-shadow: 0 0 10px;
        border-radius: 5px;
        -webkit-overflow-scrolling: touch;
      }
      .enclosing-ng-repeat .repeater-container{
        height: 216px;
      }
      .enclosing-ng-repeat .repeater-container:first-child{
        margin-bottom: 20px;
      }
      .ranges-inner-wrapper{
        padding: 10px 20px;
        width: 100%;
      }
      .repeater-container.ranges{
        height: 345px;
        margin-top: 20px;
        background: hsl(60, 100%, 90%);
      }
      .repeater-container.horizontal {
        white-space: nowrap;
      }
      .repeater-container.horizontal > * {
        display: inline-block;
        position: relative;
        top: -100%;
        margin-top: 35px;
      }
      .repeater-container.horizontal .item-element{
        width: 50px;
        height: 100%;
      }
      .repeater-container.horizontal.combined{
        height: 145px;
      }
      .repeater-container.horizontal.combined .item-element{
        width: 70px;
        text-align: center;
      }
      .third-array-ng-repeat{
        padding: 10px 20px;
      }
      .item-element{
        -webkit-transition: background-color 0.3s ease;
        -moz-transition: background-color 0.3s ease;
        -ms-transition: background-color 0.3s ease;
        -o-transition: background-color 0.3s ease;
        transition: background-color 0.3s ease;
      }
      .item-element:hover{
        background-color: hsla(180, 100%, 50%, 0.3);
      }
      tr.item-element {
        height: 30px;
      }
      tr.item-element td {
        padding: 0 20px;
      }
      #dom-preview-container pre{
        max-height: 500px;
        overflow: auto;
        font-size: 11px;
      }
      .repeater-container .item-element{
        margin: 0 !important;
        width: 100%;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
      }
      .array-switch-form{
        width: 400px;
        margin-top: 20px;
      }
      pre > code > span{
        display: block;
      }
      pre{
        padding-top: 0;
        padding-bottom: 0;
      }
      ul.nav > li{
        cursor: pointer;
      }
      li.imp a{
        color: crimson;
        font-weight: bold;
      }
      li.imp.active a{
        color: hsl(0, 100%, 35%);
        font-weight: bold;
      }
      li.imp a:hover{
        color: hsl(0, 100%, 45%);
      }
      li.imp.active a:hover{
        color: hsl(0, 100%, 35%);
      }
      li.imp2 a{
        color: magenta;
        font-weight: bold;
      }
      li.imp2.active a{
        color: magenta;
        font-weight: bold;
      }
      li.imp2 a:hover{
        color: magenta;
      }
      li.imp2.active a:hover{
        color: magenta;
      }
      .perf-container{
        overflow: auto;
        max-height: 300px;
        min-height: 50px;
        background-color: hsla(210, 75%, 50%, 0.2);
      }
      .perf-elem{
        padding: 10px 15px;
        border-bottom: 1px solid hsla(0, 0%, 0%, 0.1);
        width: 100%;
        box-sizing: border-box;
      }
      .perf-elem small{
        letter-spacing: 5px;
        color: hsla(0, 0%, 0%, 0.5);
      }
      .perf-summary{
        padding: 10px 0;
        font-size: 18px;
      }
      .danger{
        color: crimson;
      }
      .success{
        color: hsl(160, 100%, 35%);
      }
      .tab-1 label{
        cursor: pointer;
        font-size: 16px;
        padding: 10px 0;
      }
      .tab-1 label span{
        margin-left: 5px;
      }
      .tab-1 small{
        color: hsl(0, 0%, 60%);
      }
    </style>
    <script>
      function getRegularArray(size){
        var res = [];
        for(var i=0;i<size;i++){
          res.push({
            text: i,
            size: ~~(Math.random()*100 + 50)
          });
        }
        return res;
      }
      function appController($scope, $location){
        $scope.$root.arraySize = 1000;
        $scope.items = {
          collection: getRegularArray($scope.$root.arraySize)
        };
        $scope.switchCollection = function(){
          var parsed = parseInt($scope.newArray.size, 10);
          if(!isNaN(parsed)){
            $scope.$root.arraySize = parsed;
            $scope.items = {
              collection: getRegularArray(parsed)
            };
          }
        };
        $scope.getDomElementsDesc = function(){
          var arr = [];
          var elems = document.querySelectorAll('.item-element.well');
          elems = Array.prototype.slice.call(elems);
          elems.forEach(function(item){
            arr.push(item.innerHTML.trim());
          });
          return arr;
        }
        $scope.newArray = {};
        $scope.inputKeyDown = function(e){
          if(e.keyCode == 13)
            $scope.switchCollection();
        };

        $scope.outerArray = getRegularArray(2);
        $scope.thirdArray = getRegularArray(30);

        $scope.$watch(function(){
          return $location.search();
        }, function(obj){
          if(obj.tab)
            $scope.tab = obj.tab + '';
        }, true);

        $scope.$watch('tab', function(tab){
          $location.search({tab: tab});
        });

        $scope.$on('vsRepeatInnerCollectionUpdated', function () {
          if (!$scope.$root.$$phase) {
            $scope.$apply();
          }
        });
      }
      function PerfController($scope){
        function getArray(size){
          var arr = [];
          for(var i=0;i<size;i++){
            arr.push({
              a: '',
              b: ''
            })
          }
          return arr;
        }
        $scope.$watch('arraySize', function(s){
          $scope.bar = getArray(+s);
        });
        var interval = setInterval(function interval(){
          var t1 = Date.now();
          $scope.$digest();
          $scope.digestDuration = (Date.now() - t1);
        }, 1000);
        $scope.$on('$destroy', function(){
          clearInterval(interval);
        });
      }
      angular.module('app', ['vs-repeat']);
    </script>
  </head>
  <body ng-controller="appController">
  
          <div class="row">
            <div class="col-xs-6" ng-controller="PerfController">
              <div class="perf-container" vs-repeat>
                <div ng-repeat="foo in bar" >
                1
                </div>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>
      
    </div>
  </body>
</html>