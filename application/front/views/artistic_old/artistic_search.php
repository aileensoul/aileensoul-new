<div class="col-md-7 col-sm-7">
    <div class="job-search-box1 clearfix">
        <?php echo form_open('search/execute_search'); ?>

        <fieldset class="col-md-3">
            <!--    <label>Find Your Skills</label>
            -->   
          <!-- <input type="text" name="searchartistic" placeholder="Find Your Art"> -->
            <input type="text" id="tags" name="skills" placeholder="Find Your art">
        </fieldset>
        <fieldset class="col-md-3">
            <!--    <label>Find Your Location</label>
            -->   
            <select class="" name="searchplace[]" id="searchplace" multiple="multiple"></select>
        </fieldset>
        <!--                            <fieldset class="col-md-2">
                                       <input type="submit" name="search_submit" value="Search" onclick="return checkvalue()">
                                    </fieldset>-->
        <fieldset class="col-md-2">
            <label for="search_btn" id="search_f"><i class="fa fa-search" aria-hidden="true"></i></label>
            <input id="search_btn" style="display: none;" type="submit" name="search_submit" value="Search" onclick="return checkvalue()">
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
