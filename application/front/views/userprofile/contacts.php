<div class="container pt20">
    <div class="custom-user-list">
        <div class="list-box-custom">
            <h3>Contacts</h3>
            <div class="p15 fw" >
                <div class="custom-user-box" ng-repeat="contacts in contats_data">
                    <div class="post-img" ng-if="contacts.user_image != '' && contacts.user_image != null">
                        <a href="#"><img ng-src="<?php echo USER_THUMB_UPLOAD_URL ?>{{contacts.user_image}}"></a>
                    </div>
                    <div class="post-img" ng-if="contacts.user_image == '' || contacts.user_image == null">
                        <div class="post-img-mainuser">{{contacts.first_name| limitTo:1 | uppercase}}{{contacts.last_name| limitTo:1 | uppercase}}</div>
                    </div>
                    <div class="custom-user-detail">
                        <h4>
                            <a ng-click="goUserprofile(contacts.user_slug)" ng-bind="(contacts.first_name | limitTo:1 | uppercase) + (contacts.first_name.substr(1) | lowercase) + ' ' + (contacts.last_name | limitTo:1 |uppercase) + (contacts.last_name.substr(1) | lowercase)"></a>
                        </h4>
                        <p ng-if="contacts.degree_name != ''">{{contacts.title_name}}</p>
                        <p ng-if="contacts.degree_name == ''">{{contacts.degree_name}}</p>
                        <p ng-if="contacts.degree_name == null && contacts.title_name == null">Current work</p>
                    </div>
                    <div class="custom-user-btn">
                        <a class="btn3" id="{{contacts.user_id}}" ng-click="remove(contacts.user_id)">In Contacts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="right-add">
        <div class="custom-user-add">
            <img ng-src="<?php echo base_url('assets/n-images/add.jpg') ?>">
        </div>
    </div>
</div>