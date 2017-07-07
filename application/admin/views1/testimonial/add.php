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

                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert fade in alert-success">
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('error')) { ?>  
                            <div class="alert fade in alert-danger" >
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } ?>


    <!-- Main content -->
    <section class="content">
        <div class="row">
           
            <div class="col-md-12">
               
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $section_title; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                     <?php
                        $form_attr = array('id' => 'add_testimonial_frm','enctype' => 'multipart/form-data');
                        echo form_open_multipart('testimonial/add', $form_attr);
                        ?>
                        <div class="box-body">
                            
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="clientname" id="clientname" class="col-sm-2 control-label">Client Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="clientname" id="clientname" placeholder="please enter client name">
                                </div>
                            </div>
                            
                            
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="clientprofession" id="clientprofession" class="col-sm-2 control-label">Client's Profession</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="clientprofession" id="clientprofession" placeholder="please enter client Profession">
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="text" id="text_label" class="col-sm-2 control-label">Testimonial Text </label>
                                <div class="col-sm-6">
                                    <!--<input type="text" class="form-control" placeholder="Testimonial Short Description" name="testimonial_description" id="desc" >-->
                                     <textarea class="form-control" id="text" name="text"  placeholder="please enter testimonialtext" rows="10" cols="80"></textarea> 
                                    
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="clientimage" id="clientimage_label" class="col-sm-2 control-label">Client Image</label>
                                <div class="col-sm-6">
                                    <input type="file" name="clientimage" id="clientimage"   />
                                </div>
                            </div>
                            
                            
                           
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <?php
                            $save_attr = array('id' => 'btn_save', 'name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');
                            echo form_submit($save_attr);
                            ?>    
                            <button type="button" onclick="window.history.back();" class="btn btn-default">Back</button>
                            <!--<button type="submit" class="btn btn-info pull-right">Sign in</button>-->
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box -->
              
              
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php echo $footer; ?>

<script type="text/javascript">
    //validation for edit email formate form
    $(document).ready(function () {
        

        $("#add_testimonial_frm").validate({
            
            rules: {
                clientprofession: {
                   required: true,
                },
                clientname: {
                   required: true,
                },
                text:{
                   required: true,
                },
                clientimage:{
                   required: true,
                }
            },
            messages:{
                clientprofession: {
                    required: "Clientrofession is required",
                },
                clientname: {
                    required: "Client name is required",
                },
                text: {
                   required: "Testimonial text is required",
                },
                clientimage: {
                   required: "testimonial image  is required",
                }

            },
        });
       
    

    });
</script>