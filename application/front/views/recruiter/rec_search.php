
                         <!-- <?php //echo form_open('search/recruiter_search');  ?> -->
                         <form action=<?php echo base_url('search/recruiter_search')?> method="get">
                            <fieldset class="col-md-3 col-sm-5 col-xs-5">

                              <input type="text" id="tags" name="skills" placeholder="Find Persons">
        
                              
                            </fieldset>
                            <fieldset class="col-md-3 col-sm-5 col-xs-5">
                              
                            

                                 <input type="text" id="searchplace" name="searchplace" placeholder="Find Location">
                            </fieldset><!-- 
                            <fieldset class="col-md-2">
                               <input type="submit" name="search_submit" value="Search" onclick="return checkvalue()">
                            </fieldset> -->
                               <fieldset class="col-md-2 col-sm-2 col-xs-2">
                                


                                <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post')){?>
                                
                                 <label for="search_btn" id="search_f"><i class="fa fa-search" aria-hidden="true"></i></label>
                               <input type="button" name="search_submit" value="Search" onclick="return leave_page(4)"   id="search_btn" style="display: none;">
                              <!--  <button type="button" class="btn btn-primary btn-block" data-title="Delete" onclick="return leave_page(4)" data-toggle="modal" data-target="#delete" >SIGN UP AS SKATER</button> -->
                               <!--   <a href="javascript:void(0);" name="search_submit" value="Search"  id="search_btn" style="color:white;"  onclick="return leave_page(4)">search</a> -->


                                 <?php }else{?>

                                 <label for="search_btn" id="search_f"><i class="fa fa-search" aria-hidden="true"></i></label>
                               <input type="submit" name="search_submit" value="Search" onclick="return checkvalue()"    id="search_btn" style="
                               display: none;">
                                 <?php } ?>
                            </fieldset>
                       <?php echo form_close();?>
                  