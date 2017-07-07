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
                    $form_attr = array('id' => 'edit_local_community_frm', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('local_community/edit', $form_attr);
                    ?>
                    <input type="hidden" name="local_id" value="<?php echo $local_community_detail[0]['id'] ?>">
                    <div class="box-body">
                        <!-- local community description start -->
                        <!--  name start -->
                        <div class="form-group col-sm-10">
                            <label for="name" name="name" id="page_title"> Name*</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $local_community_detail[0]['name'] ?>">
                        </div>
                        <!-- name end -->
                        <!-- designation name start -->
                        <div class="form-group col-sm-10">
                            <label for="designation" name="designation_name" id="page_title">Designation*</label>
                            <input type="text" class="form-control" name="designation" id="designation" value="<?php echo $local_community_detail[0]['designation'] ?>">
                        </div>
                        <!-- designation name end -->
                        <div class="form-group col-sm-10">
                            <label for="localdescription" name="local_description" id="local_description">Description *</label>
                            <?php
                            echo form_textarea(array('name' => 'description', 'id' => 'description editor1', 'class' => "textarea", 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;',
                                'value' => $local_community_detail[0]['description']));
                            ?><br>
                        </div>
                        <!-- local community description end -->
                        <!-- local_community image start -->
                        <div class="form-group col-sm-10">
                            <label for="local_communityimage" name="local_communityimage" id="local_communityimage">Image *</label>
                            <input type="file" class="form-control" name="image" id="image" value="" style="border: none;">
                        </div>
                        <div class="form-group col-sm-10">
                            <label for="local_communityimage" name="local_communityimage" id="local_communityimage"></label>
                            <img src="<?php echo base_url() . '../uploads/local/thumbs/' . $local_community_detail[0]['image'] ?>" alt="<?php echo $local_community_detail[0]['name'] ?>" width="180">
                            <input type="hidden" name="old_image" value="<?php echo $local_community_detail[0]['image']; ?>" />
                        </div>
                        <!-- local_community image end -->

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


        $("#edit_local_community_frm").validate({
            rules: {
                description: {
                    required: true,
                },
                image: {
                    required: true,
                },
                name: {
                    required: true,
                },
                designation: {
                    required: true,
                }
            },
            messages:
                    {
                        description: {
                            required: "Please enter description",
                        },
                        image: {
                            required: "Please select image",
                        },
                        name: {
                            required: "Please enter name",
                        },
                        designation: {
                            required: "Please enter designation",
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