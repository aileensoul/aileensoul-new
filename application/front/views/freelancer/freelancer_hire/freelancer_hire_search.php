<div class="col-sm-7 col-md-7 col-xs-6 hidden-mob">
    <div class="job-search-box1 clearfix">
        <form action=<?php echo base_url('freelancer-hire/search') ?> method="get">
            <fieldset class="col-md-3 col-sm-5 col-xs-5">
                <input type="text" class="skill_keyword" id="tags" name="skills" placeholder="Designation, Skills, Field">
                <!--<input id="skills2" name="skills" tabindex="7" size="90" placeholder="Enter SKills">-->
            </fieldset>
            <fieldset class="col-md-3 col-sm-5 col-xs-5">
                <input type="text" class="skill_place" id="searchplace" name="searchplace" placeholder="Find Location"> 
            </fieldset>
            <fieldset class="col-md-2 col-sm-2 col-xs-2">
                <?php if (($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'edit-projects')) { ?>
                    <label for="search_btn" id="search_f"><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input type="button" name="search_submit" value="Search" onclick="return leave_page(4)"   id="search_btn" style="display: none;">
                <?php } else { ?>
                    <label for="search_btn" id="search_f"><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input type="submit" name="search_submit" value="Search" onclick="return checkvalue()" id="search_btn"  style="display: none;">
                <?php } ?>
            </fieldset>
        </form>
    </div>
</div>