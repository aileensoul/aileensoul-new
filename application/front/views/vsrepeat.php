
<!DOCTYPE html>
<html>
<head>
    <style>
        md-virtual-repeat-container {
  background-color: green;
}
md-list-item {
  background-color: red;
}
.repeated-item {
  border-bottom: 1px solid #ddd;
  box-sizing: border-box;
  height: 40px;
  padding-top: 10px;
}
        </style>
    <title></title>
	<meta charset="utf-8" />
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0-rc1/angular-material.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=RobotoDraft:300,400,500,700,400italic">
  <link rel="stylesheet" href="style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-aria.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0-rc1/angular-material.min.js"></script>

  <script src="script.js"></script>
  
</head>
<body ng-app="BlankApp" ng-controller="MainVM" layout="column">
  <h1 flex="none">{{vm.title}}</h1>
  
  <div flex layout="row">
   <!--  <md-list flex layout="column">
      <md-virtual-repeat-container flex>
         <md-list-item md-virtual-repeat="item in vm.items">
           Item {{item.name}}
         </md-list-item>
      </md-virtual-repeat-container> 
    </md-list> -->
    <md-virtual-repeat-container flex id="lazy-container">
      <div md-virtual-repeat="item in self.userdata" item-size="5" md-on-demand class="repeated-item">
              {{item.name}}
      
    </md-virtual-repeat-container>
  </div>
  
  <script>
      var base_url = '<?php echo base_url(); ?>';
      var app = angular.module('BlankApp', ['ngMaterial']);
app.controller('MainVM',function ($scope,$timeout,$http) {

    var self = this;
    self.title = "Virtual Repeat - Lazy Loading";
    
   getFieldList();
                        function getFieldList() {
                            $http({
                                method: 'POST',
                                url: base_url + 'userprofile_page/vsrepeat_data',
                               // data: 'q=' + $scope.user.cityList,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                    .then(function (success) {
                                        data123 = success.data;
                                     self.userdata    = data123;
                                    });
                        }
                        
    // self.items = [];

    // for (var i = 0; i < 500; i++) {
    //     self.items.push({
    //         name: "item " + i
    //     });
    // }

    self.infiniteItems = {
        numLoaded_: -1,
        toLoad_: 0,
        getItemAtIndex: function (index) {
           // alert(index);
           // alert(self.infiniteItems.numLoaded_);
            if (index > self.infiniteItems.numLoaded_) {
                self.infiniteItems.fetchMoreItems_(index);
                return null;
            }
            return index;
        },
        getLength: function () {
            return self.infiniteItems.numLoaded_ + 5;
        },
        fetchMoreItems_: function (index) {

          
            if (self.infiniteItems.toLoad_ < index) {
                self.infiniteItems.toLoad_ += 10;
                $timeout(function () {
                    self.infiniteItems.numLoaded_ = self.infiniteItems.toLoad_;
                  
                  self.title += "I";
                }, 1000);
            }
        }

    }
});
                
//app.controller('MainVM', MainVM);// JavaScript source code


      </script>
      
</body>
</html>


