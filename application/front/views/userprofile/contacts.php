<div class="container pt20">
    <div class="custom-user-list">
        <div class="list-box-custom">
            <h3>Contacts</h3>
            <div class="p15 fw" id="nocontact">
                <div class="custom-user-box" ng-if="contats_data != '0'" ng-repeat="contacts in contats_data">
                    <input type="hidden" name="page_number" class="page_number" ng-class="page_number" ng-model="post.page_number" ng-value="{{post.page_data.page}}">
                    <input type="hidden" name="total_record" class="total_record" ng-class="total_record" ng-model="post.total_record" ng-value="{{post.page_data.total_record}}">
                    <input type="hidden" name="perpage_record" class="perpage_record" ng-class="perpage_record" ng-model="post.perpage_record" ng-value="{{post.page_data.perpage_record}}">


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

                <div class="custom-user-box"  ng-if="contats_data == '0'">
                    <div class='art-img-nn'>
                        <div class='art_no_post_img'>
                            <img src='assets/img/icon_notification_big.png' alt='notification image'>
                        </div>
                        <div class='art_no_post_text'>No Contacts Available. </div>

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