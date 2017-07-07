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
    <section class="content-header">
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="callout callout-success">
                <p><?php echo $this->session->flashdata('success'); ?></p>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>  
            <div class="callout callout-danger" >
                <p><?php echo $this->session->flashdata('error'); ?></p>
            </div>
        <?php } ?>

    </section>
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
                    $form_attr = array('id' => 'add_testimonials_frm', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('testimonials/add', $form_attr);
                    ?>
                    <div class="box-body">
                        <!-- testimonial name start -->
                        <div class="form-group col-sm-10">
                            <label for="testimonialname" name="testimonial_name" id="testimonial_name">Name*</label>
                            <input type="text" class="form-control" name="name" id="name" value="">
                        </div>
                        <!-- testimonial name end -->
                        <!-- testimonial position start -->
                        <div class="form-group col-sm-10">
                            <label for="testimonialposition" name="testimonial_position" id="testimonial_position">Position*</label>
                            <input type="text" class="form-control" name="position" id="position" value="">
                        </div>
                        <!-- testimonial position end -->
                        <!-- testimonials description start -->
                        <div class="form-group col-sm-10">
                            <label for="testimonialdescription" name="testimonial_description" id="testimonial_description">Description *</label>
                            <?php echo form_textarea(array('name' => 'description', 'id' => 'description editor1', 'class' => "textarea", 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;', 'value' => '')); ?><br>
                        </div>
                        <!-- testimonials description end -->
                        <!-- testimonials image start -->
                        <div class="form-group col-sm-10">
                            <label for="testimonialsimage" name="testimonialsimage" id="testimonialsimage">Image *</label>
                            <input type="file" class="form-control" name="image" id="image" value="" style="border: none;">
                        </div>
                        <!-- testimonials image end -->
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


        $("#add_testimonials_frm").validate({
            rules: {
                name: {
                    required: true,
                },
                position: {
                    required: true,
                },
                description: {
                    required: true,
                },
                image: {
                    required: true,
                }
            },
            messages:
                    {
                        name: {
                            required: "Please enter name",
                        },
                        position: {
                            required: "Please enter position",
                        },
                        description: {
                            required: "Please enter description",
                        },
                        image: {
                            required: "Please enter image",
                        }
                    },
        });
    });

</script>

<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //   CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea1").wysihtml5();
    });
</script>
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
        $('.callout-danger').delay(3000).hide('700');
        $('.callout-success').delay(3000).hide('700');
    });
</script>