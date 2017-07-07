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
                    $form_attr = array('id' => 'add_pages_frm', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('pages/edit', $form_attr);
                    ?>
                    <input type="hidden" name="page_id" id="id" value="<?php echo $pages_detail[0]['id']; ?>" />
                    <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $pages_detail[0]['id']; ?>" />
                    <div class="box-body">
                        <!-- page name start -->
                        <div class="form-group col-sm-10">
                            <label for="inputEmail3" name="page_title" id="page_title">Page Name*</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $pages_detail['0']['name'] ?>">
                        </div>
                        <!-- page name end -->
                        <!-- page title start -->
                        <div class="form-group col-sm-10">
                            <label for="inputEmail3" name="page_title" id="page_title">Page Title*</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $pages_detail['0']['page_title'] ?>">
                        </div>
                        <!-- page name end -->
                        <!-- page description start -->
                        <div class="form-group col-sm-10">
                            <label for="inputEmail3" name="page_title" id="page_title">App Description *</label>
                            <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'class' => "textarea", 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;', 'value' => $pages_detail[0]['description'])); ?><br>
                        </div>
                        <!-- page description end -->


                        <div class="form-group col-sm-10">
                            <label for="inputEmail3" name="page_title" id="page_title">Web Description *</label>
                            <textarea id="editor1" name="description1" rows="10" cols="80">
                                <?php echo $pages_detail[0]['description1'] ?>
                            </textarea>
                        </div>
                        <!-- page banner start -->
                        <div class="form-group col-sm-10">
                            <label for="pagebanner" name="pagebanner" id="pagebanner">Page Banner</label>
                            <input type="file" class="form-control" name="image" multiple="1" id="page_banner" value="" style="border: none;">
                        </div>
                        <!-- page banner end -->
                        <div class="form-group col-sm-10">
                            <label for="pagebanner" name="pagebanner" id="pagebanner"></label>
                            <?php
                            if ($pages_detail[0]['image']) {
                                ?>
                                <div class="image-box" style="border:1px solid #eee; padding:10px; width: 170px; float: left; margin: 5px;">

                                    <img src="<?php echo base_url() . '../uploads/pages/thumbs/' . $pages_detail[0]['image'] ?>" width="150" height="100">
                                    <input type="hidden" name="old_image" value="<?php echo $pages_detail[0]['image'] ?>" />
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        
                        <div class="form-group col-sm-10">
                            <label for="pageappbanner" name="pageappbanner" id="pageappbanner">Page App Banner</label>
                            <input type="file" class="form-control" name="app_image" multiple="1" id="page_banner" value="" style="border: none;">
                        </div>
                        <!-- page banner end -->
                        <div class="form-group col-sm-10">
                            <label for="pageappbanner" name="pageappbanner" id="pageappbanner"></label>
                            <?php
                            if ($pages_detail[0]['app_image']) {
                                ?>
                                <div class="image-box" style="border:1px solid #eee; padding:10px; width: 170px; float: left; margin: 5px;">

                                    <img src="<?php echo base_url() . '../uploads/pages_app/thumbs/' . $pages_detail[0]['app_image'] ?>" width="150" height="100">
                                    <input type="hidden" name="old_app_image" value="<?php echo $pages_detail[0]['app_image'] ?>" />
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        <!-- page sub image end -->

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


        $("#add_pages_frm").validate({
            rules: {
                name: {
                    required: true,
                },
            /*    description: {
                    required: true,
                }, */
                title: {
                    required: true,
                }
            },
            messages:
                    {
                        name: {
                            required: "Page name is required",
                        },
                    /*    description: {
                            required: "Page description is required",
                        }, */
                        title: {
                            required: "Page title is required",
                        }
                    },
        });

    });

</script>

<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
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