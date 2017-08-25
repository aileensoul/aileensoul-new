<div class="col-lg-3 col-md-4 col-sm-4">
   <div class="left-side-bar">
      <ul class="left-form-each">
         <?php if($this->uri->segment(2) == 'job_basicinfo_update')
            {
            ?>
         <li class="active init"><a href="javascript:void(0)">Basic Information</a></li>
         <?php
            }
            else
            {
            ?>
         <li class="custom-none "><a href="<?php echo base_url('job/job_basicinfo_update'); ?>">Basic Information</a></li>
         <?php
            }
            ?>
         <?php if($this->uri->segment(2) == 'job_education_update')
            {
            ?>
         <li class="active init"><a href="javascript:void(0)">Educational Qualification</a></li>
         <?php
            }
            else
            {
            ?>
         <li class="custom-none "><a href="<?php echo base_url('job/job_education_update'); ?>">Educational Qualification</a></li>
         <?php
            }
            ?>
         <?php if($this->uri->segment(2) == 'job_project_update')
            {
            ?>
         <li class="active init"><a href="javascript:void(0)">Project And Training / Internship</a></li>
         <?php
            }
            else
            {
            ?>
         <li class="custom-none "><a href="<?php echo base_url('job/job_project_update'); ?>">Project And Training / Internship</a></li>
         <?php
            }
            ?>
         <?php if($this->uri->segment(2) == 'job_skill_update')
            {
            ?>
         <li class="active init"><a href="javascript:void(0)">Work Area</a></li>
         <?php
            }
            else
            {
            ?>
         <li class="custom-none "><a href="<?php echo base_url('job/job_skill_update'); ?>">Work Area</a></li>
         <?php
            }
            ?>
         <?php if($this->uri->segment(2) == 'job_work_exp_update')
            {
            ?>
         <li class="active init"><a href="javascript:void(0)">Work Experience</a></li>
         <?php
            }
            else
            {
            ?>
         <li class="custom-none "><a href="<?php echo base_url('job/job_work_exp_update'); ?>">Work Experience</a></li>
         <?php
            }
            ?>
      </ul>
   </div>
</div>