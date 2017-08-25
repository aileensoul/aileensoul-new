                    
                         <form action=<?php echo base_url('search/job_search')?> method="get">
                            <fieldset class="col-md-4 col-sm-5 col-xs-5 sec_h2">
                            
                                 <input type="text" id="tags" name="skills" placeholder="Job Title, Skill, Company" maxlength="255">
                               
                            </fieldset>
                            <fieldset class="col-md-4 col-sm-5 col-xs-5 sec_h2">
                            
                              <input type="text" id="searchplace" name="searchplace" placeholder="Find Location" maxlength="255">
                            

                            </fieldset>
                       
                            <fieldset class="col-md-2 col-sm-2 col-xs-2">
                                  <label for="search_btn" id="search_f"><i class="fa fa-search" aria-hidden="true"></i></label>
                                <button onclick="return checkvalue();"  id="search_btn" style="display: none;"> Search</button>
                            </fieldset>
                        <?php echo form_close();?>