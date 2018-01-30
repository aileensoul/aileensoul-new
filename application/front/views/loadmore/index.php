<!doctype html>
<html>
    <head>
        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>

        <title>Load more pagination with AngularJS and PHP</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-commen.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-style.css') ?>">
        <!--<link href="style.css" type="text/css" rel="stylesheet">-->

    </head>
    <body ng-app='myapp'>
        <div class="container" ng-controller='fetchCtrl'>
            <!-- Post -->
            <input type="hidden" name="page_number" class="page_number"  ng-model="page_number" ng-value="postData.pagedata.page">
            <input type="hidden" name="total_record" class="total_record"  ng-model="total_record" ng-value="postData.pagedata.total_record">
            <input type="hidden" name="perpage_record" class="perpage_record"  ng-model="perpage_record" ng-value="postData.pagedata.perpage_record">
            <div ng-if="postData.length != 0" class="all-post-box" ng-repeat="post in forData">

                <div class="all-post-top">
                  {{post.post_data.id}}
                    <div class="post-head">
                        <div class="post-img">
                            <img ng-src="<?php// echo USER_THUMB_UPLOAD_URL ?>{{post.user_data.user_image}}" ng-if="post.user_data.user_image != ''">
                            <img ng-src="<?php// echo NOBUSIMAGE2 ?>" ng-if="post.user_data.user_image == ''">
                        </div>
                        <div class="post-detail">
                            <div class="fw">
                                <a ng-href="<?php //echo base_url('profiless/') ?>{{post.user_data.user_slug}}" class="post-name" ng-bind="post.user_data.fullname"></a><span class="post-time">7 hours ago</span>
                            </div>
                            <div class="fw">
                                <span class="post-designation" ng-if="post.user_data.title_name != ''" ng-bind="post.user_data.title_name"></span>
                                <span class="post-designation" ng-if="post.user_data.title_name == ''" ng-bind="post.user_data.degree_name"></span>
                                <!--<span class="post-designation" ng-if="post.user_data.title_name == null && post.user_data.degree_name == null" ng-bind="CURRENT WORK"></span>-->
                            </div>
                        </div>
                        <div class="post-right-dropdown dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img ng-src="<?php echo base_url('assets/n-images/right-down.png') ?>" alt="Right Down"></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0);" ng-click="EditPost(post.post_data.id, post.post_data.post_for, $index)">Edit Post</a></li>
                                <li><a href="javascript:void(0);" ng-click="deletePost(post.post_data.id, $index)">Delete Post</a></li>
                            </ul>
                        </div>
                    </div>
                   
                </div>
                
            </div><!--

            <!--<h1 class="load-more" ng-show="showLoadmore" ng-click='getPosts()'>{{ buttonText}}</h1>-->
            <input type="hidden" id="row" ng-model='row'>

        </div>
        <!-- Script -->
        <!--<script src="angular.min.js"></script>-->
        <script>
                var base_url = '<?php echo base_url(); ?>';
                var user_slug = '<?php echo "dhaval-shah"; ?>';
                var fetch = angular.module('myapp', []);
                fetch.controller('fetchCtrl', ['$scope', '$http', '$window', function ($scope, $http, $window) {

                // Variables
                $scope.showLoadmore = true;
                $scope.row = 0;
                $scope.rowperpage = 3;
                $scope.buttonText = "Load More";
                // Fetch data
                $scope.getPosts = function(pagenum = ''){

                $http({
                method: 'post',
                        url: base_url + "userprofile/getUserDashboardPost?page=" + pagenum + "&user_slug=" + user_slug,
                        data: {row:$scope.row, rowperpage:$scope.rowperpage}
                }).then(function successCallback(response) {

                if (response.data != ''){

                $scope.row += $scope.rowperpage;
                if ($scope.postData != undefined){
                $scope.page_number = response.data.pagedata.page;
                for (var i in response.data.postrecord) {
                $scope.forData.push(response.data.postrecord[i]);
                }
                } else{
                $scope.postData = response.data;
                $scope.forData = response.data.postrecord;
                }
                } else{
                $scope.showLoadmore = false;
                }
                });
                }
                angular.element($window).bind("scroll", function(e) {
                if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                var page = $(".page_number").val();
                var total_record = $(".total_record").val();
                var perpage_record = $(".perpage_record").val();
              alert(page);
                if (parseInt(perpage_record * page) <= parseInt(total_record)) {
                var available_page = total_record / perpage_record;
                available_page = parseInt(available_page, 10);
                var mod_page = total_record % perpage_record;
                if (mod_page > 0) {
                available_page = available_page + 1;
                }
                if (parseInt(page) <= parseInt(available_page)) {alert("go");
                var pagenum = parseInt($(".page_number").val()) + 1;
               // alert(pagenum);
                $scope.getPosts(pagenum);
                }
                }
                }
                });
                // Call function
                $scope.getPosts();
                }]);
        </script>
    </body>
</html>
