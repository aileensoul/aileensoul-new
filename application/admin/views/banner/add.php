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
                    $form_attr = array('id' => 'add_banner_frm', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('banner/add', $form_attr);
                    ?>
                    <div class="box-body">
                        <!-- banner name start -->
                        <div class="form-group col-sm-10">
                            <label for="bannername" name="banner_name" id="page_title">Banner Title*</label>
                            <input type="text" class="form-control" name="name" id="name" value="">
                        </div>
                        <!-- banner name end -->
                        <!-- banner short desc start -->
                        <div class="form-group col-sm-10">
                            <label for="bannershortdesc" name="bannershortdesc" id="page_title">Banner Link*</label>
                            <input type="text" class="form-control" name="link" id="link" value="">
                        </div>
                        <!-- banner short desc end -->
                        <!-- banner short desc start -->
                        <div class="form-group col-sm-10">
                            <label for="bannershortdesc" name="bannershortdesc" id="page_title">Banner Short Description*</label>
                            <input type="text" class="form-control" name="description" id="description" value="">
                        </div>
                        <!-- banner short desc end -->
                        <!-- banner image start -->
                        <div class="form-group col-sm-10">
                            <label for="bannerimage" name="bannerimage" id="bannerimage">Image *</label>
                            <input type="file" class="form-control" name="image" id="image" value="" style="border: none;">
                        </div>
                        <!-- banner image end -->
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


        $("#add_banner_frm").validate({
            rules: {
                name: {
                    required: true,
                },
                link: {
                    required: true,
                },
                description:{
                    required: true,
                }
            },
            messages:
                    {
                        name: {
                            required: "Please enter banner title",
                        },
                        link: {
                            required: "Please enter link",
                        },
                        description:{
                            required: "Please enter description",
                        }
                    },
        });
        $(".bidding").hide();
        $(".available_for").click(function () {
            var available_for = this.value;
            if (available_for == 'buy')
            {
                $(".bidding").hide();
                $(".stock").show();
            }
            if (available_for == 'bid')
            {
                $(".bidding").show();
                $(".stock").hide();
            }
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
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
    });
</script> 