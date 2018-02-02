<div class="search-banner" ng-controller="searchBusinessController">
    <div class="container">
        <div class="text-right pt20">
            <a class="btn5" href="<?php echo base_url('business-profile/business-information') ?>">Create Business Profile</a>
        </div>
        <div class="search-bnr-text">
            <h1>Find The Business That Fits Your Life</h1>
        </div>
        <div class="search-box">
            <form ng-submit="searchSubmit()">
                <div class="search-input">
                    <input type="text" ng-model="sb.business" name="q" placeholder="Company, Cat, Products">
                    <input type="text" ng-model="sb.location" name="l" placeholder="Location">
                    <input type="submit" class="btn1" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>