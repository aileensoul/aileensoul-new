<!DOCTYPE html><html lang="en">   
 <?php    echo $head;    ?>  
   <body>  
     <section id="container" >       
         <!--header-->          
       <?php echo $header; ?>        
         <!--sidebar menu-->          
       <?php echo $leftbar; ?>       
         <!--main content start-->        
         <section id="main-content">            
         <section class="wrapper">                   
           <!--breadcumb -->              
           <ol class="breadcrumb">         
           <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>    
           <li class="active">sem</li>            
           </ol>               
           <!-- end breadcumb -->               
           <h3><i class="fa fa-angle-right">
                              	
           </i> <?php echo $module_name; ?><span class="add_button"><a data-toggle="modal" href="#myModal1"><button class="btn btn-theme"  name="Add Degree"><i class="fa fa-plus" aria-hidden="true"></i>ADD Degree </button> </span></a>
                              </h3>                  
             <!--start action-->                   
            <!-- <div class="action_buttons">                     
               </div>   -->        
                  <!--end action-->     
               <div class="row mt">         
                <div class="col-md-12">   
                 <div class="content-panel">     
                  <table class="table table-striped table-advance table-hover comon" id="sem">                        
                    <h4><i class="fa fa-angle-right"></i> <?php echo $section_title; ?> </h4>                 
                   <hr><?php if ($this->session->flashdata('error')) {echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>'; }    if ($this->session->flashdata('success')) {  echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';} ?> 
                <thead> 
                  <tr>                           
                   <th><i class="fa fa-bullhorn"></i>  #  </th>                                           
                 <th><i class="fa fa-facebook"></i> <a href="javascript:void(0);"> Degree Name </a> </th>
                 <th><i class=" fa fa-edit"></i> <a href="javascript:void(0);"> Status </a></th>                                    
                   <th><a href="javascript:void(0);">Action</a></th>                                        
                  </tr>                                   
                 </thead>                                 
                <tbody>                                   
               <?php if ($total_rows != 0) {
                  foreach ($degree as $degree) {
                    $encode_id = base64_encode($degree['degree_id']);?>                                             
                    <tr>                                                    
                     <td data-title="#"><?php echo $degree['degree_id']; ?> </td>                           
                     <td data-title="Degree Name"><?php echo $degree['degree_name']; ?></td> 
                     <td data-title="Status">

                                                        <?php

                                                        if ($degree['status'] == 1) {

                                                            ?>

                                                            <button class="btn btn-primary btn-xs"><a href="<?php echo site_url('admin/degree/change_status/' . $degree['degree_id'] . '/0'); ?>" style='color:#fff;'>Active</a></button>

                                                            <?php

                                                        } else {

                                                            ?>

                                                            <button class="btn btn-primary btn-xs"><a href="<?php echo site_url('admin/degree/change_status/' . $degree['degree_id'] . '/1'); ?>" style='color:#fff;'>Not Active</a></button>

                                                            <?php

                                                        }

                                                        ?>

                                                    </td>
       
                      <td data-title="Action">
                        <a data-toggle="modal" href="#myModal-<?php echo $degree['degree_id']; ?>">
                         <button class="btn btn-primary btn-xs"><i class="fa fa fa-check"></i>
                         </button></a>

                         <a onClick="if (!confirm('Do you really 
                         want to delete Degree?')) {
                                     return false; }" 
                                     href="<?php echo site_url('admin/degree/delete/' . $encode_id); ?>">
                                     <button class="btn btn-danger btn-xs">
                                     <i class="fa fa-trash-o "></i></button></a>
                          </td>                                     
                      </tr>                               

                       <!-- Modal -->                     
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-<?php echo $degree['degree_id']; ?>" class="modal fade">
                       <div class="modal-dialog">
                       <div class="modal-content" style="min-height:165px;">      
                       <div class="modal-header">                            
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">Edit</h4>                                                 </div>                                                      
                      <div class="modal-body" style="margin-bottom:10px;">     
                       <div class="col-sm-3">                                           
                         <p>Degree Name</p>                                                           
                         </div>                                                           
                         <?php  $form_attr = array('name' => 'degree_form', 'id' => 'degree_form');  echo form_open('admin/degree/edit', $form_attr); ?>
                           <div class="col-sm-9">                    
                           <input type="hidden" value="<?php echo $degree['degree_id']; ?>" name="degree_id"  autocomplete="off" class="form-control placeholder-no-fix">            
                           <input type="text" value="<?php echo $degree['degree_name']; ?>" name="degree_name"  autocomplete="off" class="form-control placeholder-no-fix">                           
                             </div>                                          
                           <div class="col-sm-3">                        
                           <input type="submit" class="btn btn-theme" name="submit" value="Submit" />    </div>                                
                           </form>                                               
                            </div>                                                 
                            </div>                                               
                             </div>                                           
                             </div>                                          
                             <!-- modal -->      
                                                               <!-- Modal 2 -->
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1" class="modal fade">
                       <div class="modal-dialog">
                       <div class="modal-content" style="min-height:165px;">      
                       <div class="modal-header">                            
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">ADD Degree</h4>                                                 </div>                                                      
                      <div class="modal-body" style="margin-bottom:10px;">     
                       <div class="col-sm-3">                                           
                         <p>Degree Name</p>                                                           
                         </div>                                                           
                         <?php  $form_attr = array('name' => 'add_form', 'id' => 'add_form');  echo form_open('admin/degree/add', $form_attr); ?>
                           <div class="col-sm-9">                                
                           <input type="text" value="" name="degree_name"  autocomplete="off" class="form-control placeholder-no-fix">                           
                             </div>                                          
                           <div class="col-sm-3">                        
                           <input type="submit" class="btn btn-theme" name="submit" value="Submit" />    </div>                                
                           </form>                                               
                            </div>                                                 
                            </div>                                               
                             </div>                                           
                             </div>
                                                               <!-- modal 2 -->
                                 <?php   }   } else {   ?>                  
                             <tr><td align="center" colspan="6">Oops! No Data Found.</td></tr>         <?php    }   ?> 
                             </tbody>                                
                              </table>                            
                              </div>
                               <!-- /content-panel -->                       
                               </div>
                               <!-- /col-md-12 -->                        
                                                               
                              <div class="dta_left">                            
                               <?php if ($total_rows > 0) {                                        
                                  	if ($this->pagination->create_links()) { 
                                           $rec1 = $offset + 1;                    
                                            $rec2 = $offset + $limit;                                           
                                            if ($rec2 > $total_rows) {            
                                               $rec2 = $total_rows;    }                                          
                                                 ?>   
                                         <div style="margin-left: 20px;">                                <?php echo "Records $rec1 - $rec2 of $total_rows"; ?>           </div>
                                           <?php } else { ?>                                       
                                         <div  style="margin-left: 20px;">                               <?php echo "Records 1 - $total_rows of $total_rows"; ?>         </div>
                                           <?php  }    }  ?>             
                                            </div>                  
                                                <!-- /pagination -->   
                                         <?php  if ($this->pagination->create_links())
                                           { $tot_page = ceil($total_rows / $limit);       
                                              $cur_page = ceil($offset / $limit) + 1;  ?>                                                     
                                               <div class="text_right data_right">
                                               <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">                                   
                                               <?php echo $this->pagination->create_links(); ?> </div>                            
                                                 </div>                        
                                                 <?php } ?>                    
                                                   </div><!-- /row -->               
                                                   </section>
                                                 <! --/wrapper -->            
                                                 </section>
                                                 <!-- /MAIN CONTENT -->           
                                                  <!--main content end-->           
                                                 <?php echo $footer; ?>        
                                                </section>       
                            <!-- js placed at the end of the document so the pages load faster -->        
     <script src="<?php echo base_url('admin/assets/js/jquery.js') ?>"></script>   
     <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js') ?>"></script>      
       <script class="include" type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>       
        <script src="<?php echo base_url('admin/assets/js/jquery.scrollTo.min.js') ?>"></script>      
          <script src="<?php echo base_url('admin/assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>  
                <!--common script for all pages-->       
           <script src="<?php echo base_url('admin/assets/js/common-scripts.js') ?>"></script> 

               <script type="text/javascript">      
                     $(document).ready(function () {$(".alert-danger").fadeOut(3000).hide("1000");                $(".alert-success").fadeOut(3000).hide("1000"); });       
                      </script>       
                        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>   
                             <script type="text/javascript">            //validation for edit email formate form            $(document).ready(function () {                $("#sem_form").validate({                    rules: {                        semfieldvalue: {                            required: true,                        }                    },                    messages: {                        semfieldvalue: {                            required: "Field value is required.",                        }                    },                });            });        </Script>  
                               </body>
                               </html>