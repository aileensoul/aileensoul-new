<?php
echo $header;
echo $leftmenu;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <img src="<?php echo SITEURL .'/img/i1.jpg' ?>" alt=""  style="height: 50px; width: 50px;">
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
            <li class="active">Goverment Job Post List</li>
        </ol>
        <!-- <div class="fr">
                         <button name="Add" class="btn bg-orange btn-flat margin" ><i class="fa fa-fw fa-user-plus" aria-hidden="true"></i> Add User</button>
        </div> -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Goverment Job Post List</h3>      
                    
                    <div class="box-tools">
                       <?php echo form_open('goverment/post_search', array('method' => 'post', 'id' => 'search_frm', 'class' => 'form-inline','autocomplete' => 'off')); ?>
                           <div class="input-group input-group-sm" >


                        <input type="text" class="form-control input-sm" value="<?php echo $search_keyword; ?>" placeholder="Search" name="search_keyword" id="search_keyword">

                        <div class="input-group-btn">
                                <button type="submit" class="btn btn-default" id="search_btn"><i class="fa fa-search"></i></button>          
                        </div><!--input-group-btn-->
                <?php echo form_close(); ?>
                     
                     <?php if ($this->session->userdata('user_search_keyword')) 
                            { 
                    ?>

                            <a href="<?php echo base_url('goverment/clear_postsearch') ?>">Clear Search</a>

                        <?php 
                                } 
                        ?>

                    </div><!--input-group input-group-sm-->
                </div><!--box-tools-->
                </div><!-- box-header -->

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <tbody>
                <tr>
                 <?php

                        if ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'view_gov_post') 
                        {

                                $segment2 = 'view_gov_post';

                        } 
                        else 
                        {

                                $segment2 = 'search';

                        }

                ?>

                    <th><i class="fa fa-bullhorn"></i> 
                    <a href="javascript:void(0);">ID.</a></th>

                    <th><i class="fa fa-user"></i>
                    <a href="<?php echo ( $this->uri->segment(3) == 'title' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/' . $segment2 . '/title/DESC/' . $offset) : site_url($this->uri->segment(1) . '/' . $segment2 . '/title/ASC/' . $offset); ?>"> 
                     Title
                     </a>

                     <?php echo ( $this->uri->segment(3) == 'fname' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'fname' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?>

                    </th>

                    <th><i class="fa fa-fw fa-pencil"></i> 
                    <a href="javascript:void(0);">Category</a>
                    </th>

                    <th><i class="fa fa-fw fa-pencil"></i> 
                    <a href="javascript:void(0);">Sector</a>
                    </th>

                     <th><i class="fa fa-fw fa-pencil"></i> 
                    <a href="javascript:void(0);">Eligibility</a>
                    </th>

                    <th><i class=" fa fa-edit"></i> 
                     <a href="javascript:void(0);">last_date</a>
                     </th>

                     <th><i class=" fa fa-edit"></i> 
                     <a href="javascript:void(0);">Description</a>
                     </th>

                     <th><i class=" fa fa-edit"></i> 
                     <a href="javascript:void(0);">Apply_link</a>
                     </th>

                     <th><i class=" fa fa-edit"></i> 
                     <a href="javascript:void(0);">Created_date</a>
                     </th>
                     <th><i class=" fa fa-edit"></i> 
                     <a href="javascript:void(0);">Modified_date</a>
                     </th>

                     <th><i class=" fa fa-edit"></i> 
                     <a href="javascript:void(0);">Status</a>
                     </th>

                     <th><i class=" fa fa-edit"></i> 
                     <a href="javascript:void(0);">Action</a>
                     </th>
                </tr>

                 <?php
                if ($total_rows != 0) 
                {

                        $i = $offset + 1; 
                        foreach ($post as $cat) {
                ?>

                <tr id="post_del<?php echo $cat['id']?>">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo ucfirst($cat['title']); ?></td>
                    <td>
                        <?php

                        $category = $this->db->select('name')->get_where('gov_category', array('id' => $cat['id']))->row()->name;


                         echo $category; ?>
                            
                    </td>
                    <td><?php echo $cat['sector']; ?></td>
                    <td><?php echo $cat['eligibility']; ?></td>
                    <td><?php echo $cat['last_date']; ?></td>
                    <td><?php echo $cat['description']; ?></td>
                    <td><?php echo $this->common->make_links($cat['apply_link']); ?></td>
                    <td><?php echo $cat['created_date']; ?></td>
                    <td><?php echo $cat['modified_date']; ?></td>

                    <td>
                        <?php if($cat['status']=="1")
                        {
                            echo "Publish";
                        }
                        if($cat['status']=="2")
                        {
                             echo "Draft";
                        }
                        ?>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" onclick="delete_post(<?php echo $cat['id']; ?>);">
                        <i class="fa fa-trash-o"></i>
                        </button>

                        <a class="btn btn-success btn-xs" href="<?php echo base_url('goverment1/edit_gov_post/'.$cat['id'] ); ?>">
                         <i class="fa fa-fw fa-eye"></i>
                        </a>
                    </td>

                </tr>
                 <?php
                      }//for loop close
                        }//if close
                        else 
                        {

                    ?>

                    <tr>

                        <td align="center" colspan="11"> Oops! No Data Found</td>

                    </tr>  

                    <?php

                        }

                    ?>
          
              </tbody></table>

            </div><!--box-body table-responsive no-padding -->

            </div><!-- /.box -->
        </div><!-- /.col -->

<div class="dta_left col-md-6" id="pagination">

                        <?php
                            if ($total_rows > 0) 
                            {

                                if ($this->pagination->create_links())
                                {
                                            $rec1 = $offset + 1;
                                            $rec2 = $offset + $limit;
                                            if ($rec2 > $total_rows) 
                                            {
                                                $rec2 = $total_rows;
                                            }

                            ?>

                <div style="margin-left: 20px;">

                    <?php  echo "Records $rec1 - $rec2 of $total_rows"; ?>

                </div><?php     
                            }
                            else 
                            {

                    ?>

                <div style="margin-left: 20px;">

                        <?php echo "Records 1 - $total_rows of $total_rows"; ?>

                </div>

                        <?php

                            }   }      

                        ?>
</div><!-- dta_left col-md-6--> 

<!-- /pagination Start-->

<?php
                        if ($this->pagination->create_links()) 
                        {

                            $tot_client = ceil($total_rows / $limit);
                            $cur_client = ceil($offset / $limit) + 1;
                        ?>

                            <div class="text-right data_right col-md-6">
                                <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">
                                    <?php echo $this->pagination->create_links(); ?> 
                                </div>
                            </div>
                        <?php } ?>
<!-- /pagination End-->

</div><!-- /.row -->


</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Footer start -->
<?php echo $footer; ?>
<!-- Footer End -->

<script language="javascript" type="text/javascript">
    $(document).ready(function () {
        $('.callout-danger').delay(3000).hide('700');
        $('.callout-success').delay(3000).hide('700');
    });
</script>

<script>
//Delete user Start
   function delete_post(id) 
   {
   
       $.fancybox.open('<div class="message"><h2>Are you Sure you want to Delete this Post?</h2><button id="delete" class="mesg_link btn btn1">OK</a><button data-fancybox-close="" class="btn btn1">Cancel</button></div>');

        $('.message #delete').on('click', function () 
        {
            $.ajax({
                         type: 'POST',
                          url: '<?php echo base_url() . "goverment/delete_post" ?>',
                          data: 'id=' + id,
                          success: function (response) 
                          {          
                                 $('#' + 'post_del' + id).remove();
                                  $.fancybox.close('<div class="message"><h2>Are you Sure you want to Delete this Post?</h2><button id="delete" class="mesg_link btn btn1">OK</a><button data-fancybox-close="" class="btn btn1">Cancel</button></div>');
                          }
            });   
        });
    }
//Delete user End

//Enable search button when user write something on textbox Start
 $(document).ready(function(){
    $('#search_btn').attr('disabled',true);

    $('#search_keyword').keyup(function()
    {  
        if($(this).val().length !=0)
        {
            $('#search_btn').attr('disabled', false);
        }
        else
        {  
            $('#search_btn').attr('disabled', true);        
        }
    })

     $('body').on('keydown', '#search_keyword', function(e) {
    console.log(this.value);
    if (e.which === 32 &&  e.target.selectionStart === 0) {
      return false;
    }  
  });
});
//Enable search button when user write something on textbox End

// $(function() {
 
// });
</script>