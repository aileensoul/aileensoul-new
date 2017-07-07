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
                    <?php echo form_open('inquiries/search', array('method' => 'post', 'id' => 'search_frm')); ?>
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" value="<?php echo $search_keyword; ?>" placeholder="Search" name="search_keyword" id="search_keyword">
                        <span  id="search_btn" class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                
                  <!--for clear search-->
                <div class="col-sm-2 pull-left">
                    <?php if ($this->session->userdata('user_search_keyword')) { ?>
                   <a href="<?php echo base_url('inquiries/clear_search'); ?>" >
                       <button type="button" class="btn btn-primary">Clear Search</button>
                    </a>
                   <?php } ?>
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
                                    
                                   
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'name' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/name/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/name/ASC/' . $offset); ?>" title=""> Name
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'name' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'name' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>
                                    
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'email' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/email/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/email/ASC/' . $offset); ?>" title=""> Email
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'email' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'email' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>
                                    <th style="text-align: left;">
                                        <a class="text-white" href="<?php echo ( $this->uri->segment(3) == 'number' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/number/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/number/ASC/' . $offset); ?>" title=""> Phone No
                                        </a>
                                        <?php echo ( $this->uri->segment(3) == 'number' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'number' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 
                                    </th>
                                              
                                    <th><a href="Javascript:void(0)"> Status </a></th>
                                    <th><a href="Javascript:void(0)"> Inquiry Date </a></th>
                                    <th><a href="Javascript:void(0)"> Action </a></th>

                                </tr>
                            </thead>
                             <tbody>
                                <?php if (!empty($inquiries_list)) { 
                                    ?>
                                
                                    <?php foreach ($inquiries_list as $inquiries) { ?>
                                        <tr>
                                          
                                            
                                            <td><?php echo $inquiries['name'] ?></td>
                                            <td><?php echo $inquiries['email'] ?></td>
                                            <td><?php echo $inquiries['number'] ?></td>
                                            <td>
                                                <?php 
                                                
                                                if($inquiries['status']=='pending'){
                                                   $btn='btn-success';
                                                }
                                                elseif($inquiries['status']=="proccess"){
                                                   $btn='btn-warning';
                                                }else{
                                                   $btn='btn-danger';
                                                }
                                                ?>
                                                <a class="click_status" id="status_btn" data-toggle="modal" data-inquieryid="<?php echo $inquiries['inquieryid']; ?>" data-status="<?php echo $inquiries['status'] ?>" data-target="#status_change" href="#">
                                                    <button type="button" class="btn <?php echo $btn; ?> repair_button_grp" ><i class="icon-eye-open"></i>
                                                        <?php echo $inquiries['status'] ?>
                                                    </button>
                                                </a>
                                            </td>
                                           
                                            <td><?php echo $inquiries['timestamp'] ?></td>
                                            
                                            <td>
                                                 <a id="view_btn" onclick="getDetail('<?php echo $inquiries['inquieryid']; ?>');" data-toggle="modal" data-target="#view_detail" href="#">
                                                    <button type="button" class="btn btn-primary repair_button_grp" ><i class="icon-eye-open"></i> View Details</button>

                                                </a>
                                            </td>
                                            
                                        </tr>
                                            
                                        
                                    <?php }?>
                                       
                                    
                                        <?php 
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
<?php echo $footer; ?>
<div class="modal fade" id="view_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-catname" id="frm_catname">Inquiries Detail</h4>
            </div>
            <div class="modal-body" id="detail_model_body">
                
           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               
            </div>
        </div>
    </div>
</div>
<!--//for status-->
<div class="modal fade" id="status_change" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-catname" id="frm_catname">Change Status</h4>
            </div>
            <div class="modal-body" id="detail_model_body">
                <?php echo form_open('inquiries/change_status', array('method' => 'post', 'id' => 'inquiries_frm')); ?>
                <input type="hidden" name="inquieryid" class="status_change_id" value="">
                <?php 
                    $enum_type=get_enum_values('mon_inquiries','status');
//                    print_r($enum_type);
                    foreach($enum_type as $key=>$enum){
                        echo '<input id="'.$enum.'" name="status" type="radio" value="'.$enum.'" >'.  ucfirst($enum).'<br>';
                    }
                    //'_'.$key.
                ?>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
             <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", ".click_status", function () {
     var status = $(this).data('status');
     var inquieryid = $(this).data('inquieryid');
//     var inquieryid=
     

     $(".status_change_id").val(inquieryid);
     $("#"+status).prop('checked', 'checked');
    });
  
   function getDetail(id){
        $('#detail_model_body').html('');
        $.ajax({
           url:"<?php echo site_url('inquiries/get_detail') ?>",
           type:"post",
           dataType:"html",
            data:{'id':id,
                  '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                 },
           success:function(data){
                $('#detail_model_body').append(data);
           }
        });
    }
   
   
</script>

