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
                    $form_attr = array('id' => 'edit_category_frm', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('category/edit', $form_attr);
                    ?>
                    <input type="hidden" name="category_id" value="<?php echo $category_detail[0]['id'] ?>">
                    <input type="hidden" name="create_date" value="<?php echo $category_detail[0]['create_date'] ?>">
                    <div class="box-body">
                        <!-- category name start -->
                        <div class="form-group col-sm-10">
                            <label for="categoryname" name="category_name" id="page_title">Category Name*</label>
                            <input type="text" class="form-control" name="category_name" id="name" value="<?php echo $category_detail[0]['name'] ?>">
                        </div>
                        <!-- category name end -->
                        
                        <!-- category banner start -->
                        <div class="form-group col-sm-10">
                            <label for="categorybanner" name="categorybanner" id="categorybanner">Category Banner</label>
                            <input type="file" class="form-control" name="category_banner[]" multiple="5" id="category_banner" value="" style="border: none;">
                        </div>
                        <!-- category banner end -->
                        <div class="form-group col-sm-10">
                            <label for="categorybanner" name="categorybanner" id="categorybanner"></label>
                            <?php
                            if ($image_list != '') {
                                foreach ($image_list as $image) {
                                    ?>
                                    <div class="image-box" style="border:1px solid #eee; padding:10px; width: 170px; float: left; margin: 5px;">
                                        <img src="<?php echo base_url() . '../uploads/category/thumbs/' . $image['image'] ?>" width="150" height="100">
                                        <input type="hidden" name="old_sub_image[]" value="<?php echo $image['image'] ?>" />
                                        <a href="<?php echo base_url('category/delete_image/' . $category_detail[0]['id'] . '/' . $image['id']) ?>" title="Delete" style="margin: 0 auto; width: 120px;" >Delete</a>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <!-- category sub image end -->
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


        $("#edit_category_frm").validate({
            rules: {
                name: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                manufacture_id: {
                    required: true,
                },
                cost_price: {
                    required: true,
                    digits: true,
                },
                sell_price: {
                    required: true,
                    digits: true,
                },
                stock: {
                    required: true,
                },
                available_for: {
                    required: true,
                },
                bid_time: {
                    required: true,
                },
                available_date: {
                    required: true,
                },
                description: {
                    required: true,
                }
            },
            messages:
                    {
                        name: {
                            required: "Please enter category name",
                        },
                        category_id: {
                            required: "Please enter category",
                        },
                        manufacture_id: {
                            required: "Please enter manufacturers",
                        },
                        cost_price: {
                            required: "Please enter category price",
                            digits: "Category cost price should be numeric",
                        },
                        sell_price: {
                            required: "Please enter category selling price",
                            digits: "Category sell price should be numeric",
                        },
                        stock: {
                            required: "Please enter category stock",
                        },
                        available_for: {
                            required: "Please enter category available for",
                        },
                        bid_time: {
                            required: "Please enter category bidding time",
                        },
                        available_date: {
                            required: "Please enter available date",
                        },
                        description: {
                            required: "Please enter category description",
                        }
                    },
        });


        //var available_for = document.getElementsByName("available_for");
        //alert(available_for);
        var available = $('input[name=available_for]:checked').val();
        if (available== 'buy')
        {
            $(".bidding").hide();
            $(".stock").show();
        }
        if (available == 'bid')
        {
            $(".bidding").show();
            $(".stock").hide();
        }
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