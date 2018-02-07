<div class="search-banner" ng-controller="searchFreelancerApplyController">
    <div class="container">
        <div class="text-right pt20">
            <a class="btn5" href="<?php echo base_url('business-profile/registration/business-information') ?>">Create Freelance Apply Profile</a>
        </div>
        <div class="search-bnr-text">
            <h1>Lorem Ipsum the dummy text</h1>
        </div>
        <div class="search-box">
            <form ng-submit="searchSubmit()">
                <div class="pb20 search-input">
                    <input type="text" ng-model="keyword" id="q" name="q" placeholder="Keywords, Title, Or Company" autocomplete="off">
                    <input type="text" ng-model="city" id="l" name="q" placeholder="City, State or Country" autocomplete="off">
                    <input type="submit" class="btn1" name="submit" value="Submit">
                </div>
                <div class="pt5">
                    <ul class="work-timing">
                        <li>
                            <label class="control control--checkbox">Full-Time
                                <input type="checkbox"/>
                                <div class="control__indicator"></div>
                            </label>
                        </li>
                        <li>
                            <label class="control control--checkbox">Part-Time
                                <input type="checkbox"/>
                                <div class="control__indicator"></div>
                            </label>
                        </li>

                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>