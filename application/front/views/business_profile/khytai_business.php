<body ng-app="SelectModule"><?php echo $head_profile_reg; ?>  
<div ng-controller="selectController">
    <div>
        Select not initialized:
        <select class="form-control" ng-model="selectedBook_noinit" ng-options="book.id as book.title for book in books"></select>
    </div>
    <div>
        Select initialized to a specific value:
        <select class="form-control" ng-model="selectedBook" ng-options="book.id as book.title for book in books" ng-init="selectedBook=0"></select>
    </div>
</div>
 <script type="text/javascript" src="<?php echo base_url('assets/js/angular-validate.min.js?ver=' . time()) ?>"></script>
<script>
angular.module("SelectModule", [])
    .controller("selectController", function selectController($scope) {
    $scope.books = [
        {
            "id": 0,
            "title": "Title Book #1"
        },
        {
            "id": 1,
            "title": "Title Book #2"
        },
        {
            "id": 2,
            "title": "Title Book #3"
        },
    ];
});
</script>