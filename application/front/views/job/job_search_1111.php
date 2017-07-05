 <?php
                         echo form_open('search/job_search'); ?>
                            <fieldset class="col-md-3 col-sm-5 col-xs-5">
                            
                                 <input type="text" id="tags" name="skills" placeholder="Find Your Job">
                               
                            </fieldset>
                            <fieldset class="col-md-3 col-sm-5 col-xs-5">
                            
                              <input type="text" id="searchplace" name="searchplace" placeholder="Find Your location">
                              <!-- <select class="" name="searchplace[]" id="searchplace" multiple="multiple"  placeholder="Find Your location"> -->
                               <!--  </select>
 -->
                              
                             <!--  <select class="" name="searchplace[]" id="searchplace" multiple="multiple"  placeholder="Find Your location">
                                </select> -->
                             <!--     <input type="text" id="searchplace" name="searchplace" placeholder="Find Your location"> -->

                            </fieldset>
                        <!--     <fieldset class="col-md-2">
                                <button onclick="return checkvalue();"> Search</button>
                            </fieldset>
                             -->
                            <fieldset class="col-md-2 col-sm-2 col-xs-2">
                                  <label for="search_btn" id="search_f"><i class="fa fa-search" aria-hidden="true"></i></label>
                                <button onclick="return checkvalue();"  id="search_btn" style="display: none;"> Search</button>
                            </fieldset>
                             <!-- new search popup for mobile -->
                            
                             <!-- end new search -->
<?php echo form_close();?>
                             <script>
                             $(function () {
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });
    
    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });
    
    
    //Do not include! This prevents the form from submitting for DEMO purposes only!
    $('form').submit(function(event) {
        event.preventDefault();
        return false;
    })
});
                             </script>