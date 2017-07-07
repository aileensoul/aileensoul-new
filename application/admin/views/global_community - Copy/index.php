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
                    $form_attr = array('id' => 'add_global_community_frm', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('global_community/edit', $form_attr);
                    ?>

                    <?php
                    for ($i = 1; $i <= 15; $i++) {
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-1 control-label"><?php echo $i; ?></label>
                                <input type="hidden" class="form-control" id="inputEmail3" name="id[<?php echo $i ?>]" value="<?php echo $i ?>" placeholder="Id">
                                <label for="inputEmail3" class="col-sm-1 control-label">Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="inputEmail3" name="name[<?php echo $i ?>]" value="<?php echo $global_community[$i-1]['name'] ?>" placeholder="Name <?php echo $i ?>">
                                </div>
                                  <label for="inputEmail3" class="col-sm-1 control-label">Link</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputEmail3" name="link[<?php echo $i ?>]" value="<?php echo $global_community[$i-1]['link'] ?>" placeholder="Link <?php echo $i ?>">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <?php
                    }
                    ?>

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


        $("#add_global_community_frm").validate({
            rules: {
                description: {
                    required: true,
                },
                image: {
                    required: true,
                }
            },
            messages:
                    {
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