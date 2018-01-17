<div class="container pt20">


    <div class="custom-user-list">
        <div class="list-box-custom">
            <h3>Following</h3>
           
            <div class="p15 fw">
                <div class="custom-user-box" ng-repeat="follow in follow_data">
                    <div class="post-img" ng-if="follow.user_image != '' && follow.user_image != null">
                        <a href="#"><img ng-src="<?php echo USER_THUMB_UPLOAD_URL ?>{{follow.user_image}}"></a>
                    </div>

                    <div class="post-img" ng-if="follow.user_image == '' || follow.user_image == null">
                        <div class="post-img-mainuser">{{follow.first_name| limitTo:1 | uppercase}}{{follow.last_name| limitTo:1 | uppercase}}</div>
                    </div>
                    <div class="custom-user-detail">
                        <h4>

                            <a ng-click="goUserprofile(follow.user_slug)" ng-bind="(follow.first_name | limitTo:1 | uppercase) + (follow.first_name.substr(1) | lowercase) + ' ' + (follow.last_name | limitTo:1 |uppercase) + (follow.last_name.substr(1) | lowercase)"></a>
                        </h4>
                        <p ng-if="follow.degree_name != ''">{{follow.title_name}}</p>
                        <p ng-if="follow.degree_name == ''">{{follow.degree_name}}</p>
                        <p ng-if="follow.degree_name == null && follow.title_name == null">Current work</p>

                    </div>
                    <div class="custom-user-btn"  id="{{follow.user_id}}">
                        <a class="btn3"  id="{{follow.user_id}}" ng-click="unfollow_user(follow.user_id)">Following</a>				
                    </div>

                </div>

            </div>
            
        </div>
    </div>
    <div class="right-add">
        <div class="custom-user-add">
            <img src="img/add.jpg">
        </div>
    </div>


</div>