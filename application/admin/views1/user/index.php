<?php
echo $header;
echo $leftmenu;
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $module_name; ?>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i>
                    Home
                </a>
            </li>
            <li class="active"><?php echo $module_name; ?></li>
        </ol>
    </section>

                       
    
    <!-- Content Header (Page header) -->
                



    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" >
                <div class="box-tools pull-left">
                    <?php echo form_open('user/search', array('method' => 'post', 'id' => 'search_frm')); ?>
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" value="<?php echo $search_keyword; ?>" placeholder="Search" name="search_keyword" id="search_keyword">
                        <span  id="search_btn" class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                
                <?php 
           
            if($total_rows>0){
            if ($this->pagination->create_links()){
                $rec1=$offset+1;
                $rec2=$offset+$limit;
                if($rec2>$total_rows){
                    $rec2=$total_rows;
                }
                ?>
                    <div class="pull-left" style="margin-left: 50px;">
                      <?php  echo "Records $rec1 - $rec2 of $total_rows"; ?>
                    </div><?php 
            }else{ ?>
                <div class="pull-left" style="margin-left: 50px;">
                    <?php echo "Records 1 - $total_rows of $total_rows"; ?>
                </div>
                
            <?php }
            }
            ?>
                
                
                <div class=" pull-right">
                    <a href="<?php echo site_url('user/add'); ?>" class="btn btn-primary pull-right">Add User</a>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-xs-12" >
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert fade in alert-success myalert">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>  
                    <div class="alert fade in alert-danger myalert" >
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-xs-12">
                
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $section_title; ?></h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body">
                        <table id="datalist" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <?php if($this->uri->segment(2)=='' || $this->uri->segment(2)=='index'){
                                        $segment2='index';
                                     } else {
                                         $segment2='search';
                                     } ?>
                                    <th>
                                        <a href="Javascript:void(0)">AC</a>
                                    </th>
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'email' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/email/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/email/ASC/' . $offset); ?>" title=""> E-Mail
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'email' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'email' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 

                                    </th>
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'username' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/username/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/username/ASC/' . $offset); ?>" title=""> User name
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'username' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'username' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'status' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/status/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/status/ASC/' . $offset); ?>" title=""> Status
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'status' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'status' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 

                                    </th>
                                    <th style="text-align: left;">
                                        <!--<a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'created_date' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/created_date/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/created_date/ASC/' . $offset); ?>" title=""> Created Date-->
                                        <!--</a>-->
                                        <a href="Javascript:void(0)">Created Date</a>
                                        <?php //echo ( $this->uri->segment(3) == 'created_date' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'created_date' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 

                                    </th>
                                    <th style="text-align: left;">
                                        <a href="Javascript:void(0)">Contact No</a>
                                    </th>
                                   
                                                                       
                                    <th><a href="Javascript:void(0)">Action</a></th>

                                </tr>
                            </thead>
                             <tbody>
                                <?php if (!empty($user_list)) { ?>
                                <?php echo form_open('user/mdelete', array('method' => 'post', 'id' => 'search_frm')); ?>
                                    <?php foreach ($user_list as $user) { ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="deletes[]" id="deletes" class="deletes" value="<?php echo $user['userid'] ?>">
                                            </td>
                                            <td><?php echo $user['email'] ?></td>
                                            <td><?php echo $user['username'] ?></td>
<!--                                            <td><?php echo $user['name'] ?></td>-->
                                            <td>
                                                <a href="<?php echo base_url() . 'user/change_status/' . $user['userid'].'/'.$user['status'] ; ?>" id="edit_btn">
                                                <?php echo $user['status'] ?>
                                            </td>
                                            <td><?php echo $user['insert_date'] ?></td>
                                            <td><?php echo $user['contact_no'] ?></td>
<!--                                            <td><?php echo $user['last_visit'] ?></td>-->
                                            <td>
                                                <a href="<?php echo base_url() . 'user/edit/' . $user['userid']; ?>" id="edit_btn">
                                                    <button type="button" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                                                </a>
                                                <a data-href="<?php echo base_url() . 'user/delete/' . $user['userid']; ?>" id="delete_btn" data-toggle="modal" data-target="#confirm-delete" href="#">
                                                    <button type="button" class="btn btn-primary" ><i class="icon-trash"></i> Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                            
                                        
                                    <?php }?>
                                       
                                      <tr>
                                    <td>
                                        <input type="checkbox" name="checkedall" id="checkedall" class="checkedall"  onclick="checkedall()">
                                    </td>

                                    <td colspan="9">

                                           <?php
                                           $save_attr = array('id' => 'mdelete', 'name' => 'mdelete', 'value' => 'Multiple Delete', 'class' => 'btn btn-primary');
                                           echo form_submit($save_attr);
                                           ?>    

                                    </td>
                                </tr>    
                                        <?php echo form_close(); 
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="9">
                                            No Data Found.
                                        </td>
                                    </tr>
<?php } ?>
                            </tbody>
                            <tfoot>
                               
                            </tfoot>
                        </table>
                        <div class="row">
                           
                            
                            
                                    <!-- /pagination -->
                                    <?php if ($this->pagination->create_links()) { 
                                        $tot_page=ceil($total_rows / $limit);
                                        $cur_page=ceil($offset/$limit)+1;?>

                                     <div class="col-sm-7">
                                         <div id="example2_info" class="dataTables_info" role="status" aria-live="polite">
                                             
                                             <?php
                                        echo "Displaying Page $cur_page of $tot_page !";
                                    ?>
                                         </div>
                                    </div>
                                    
                                    <div class="col-sm-5">
                                        <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">
                                            <?php echo $this->pagination->create_links(); ?> 
                                        </div>
                                    </div>

                        </div>
                                       
                                 
                                       
                                    <?php } ?>
                                  
                           
                        
                        
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Delete Conformation</h4>
            </div>
            <div class="modal-body">
                Are you Sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">

    $(document).ready(function () {
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
        
        $('#search_frm').submit(function () {
            var value=$('#search_keyword').val();
            if(value=='')
                return false;
        });
        
        
        $('#checkedall').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $('.deletes').each(function() {
                    this.checked = true;
                });
            }
            else {
              $('.deletes').each(function() {
                    this.checked = false;
                });
            }
        });
        
        $('.deletes').click(function(event) {
            var flag=0;
            $('.deletes').each(function() {
                if(this.checked==false){
                   flag++;
                }
                });
                if(flag){
                    $('.checkedall').prop('checked', false);
                }
                else{
                    $('.checkedall').prop('checked', true);
                }
                 
           
        });
        
        
        
    });
</script>

