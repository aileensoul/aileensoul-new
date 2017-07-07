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
                    $form_attr = array('id' => 'edit_global_frm', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('global_community/edit', $form_attr);
                    ?>
                    <input type="hidden" name="global_id" value="<?php echo $global_community_detail[0]['id'] ?>">
                    <div class="box-body">
                        <!-- global name start -->
                        <div class="form-group col-sm-10">
                            <label for="globalname" name="global_name" id="page_title">Global Community Name*</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $global_community_detail[0]['name'] ?>">
                        </div>
                        <!-- global name end -->
                        
                        <!-- global link start -->
                        <div class="form-group col-sm-10">
                            <label for="globallink" name="global_link" id="page_title">Global Community Link*</label>
                            <input type="text" class="form-control" name="link" id="link" value="<?php echo $global_community_detail[0]['link'] ?>">
                        </div>
                        <!-- global link end -->

                        <!-- global banner start -->
                        <div class="form-group col-sm-10">
                            <label for="globalbanner" name="globalbanner" id="globalbanner">Global Community Image</label>
                            <input type="file" class="form-control" name="image" multiple="1" id="global_banner" value="" style="border: none;">
                        </div>
                        <div class="form-group col-sm-10">
                            <label for="globalbanner" name="globalbanner" id="globalbanner"></label>
                            <div class="image-box" style="border:1px solid #eee; padding:10px; width: 120px; float: left; margin: 5px;">
                                <img src="<?php echo base_url() . '../uploads/global/main/' . $global_community_detail[0]['image'] ?>" width="100" height="100">
                                <input type="hidden" name="old_image" value="<?php echo $global_community_detail[0]['image'] ?>" />
                            </div>
                        </div>
                        <div class="form-group col-sm-10">
                            <label for="globalbanner" name="globalbanner" id="globalbanner">Global Community Hover Image</label>
                            <input type="file" class="form-control" name="hover_image" multiple="1" id="global_banner" value="" style="border: none;">
                        </div>                        <!-- global banner end -->
                        <div class="form-group col-sm-10">
                            <label for="globalbanner" name="globalbanner" id="globalbanner"></label>
                            <div class="image-box" style="border:1px solid #eee; padding:10px; width: 120px; float: left; margin: 5px;">
                                <img src="<?php echo base_url() . '../uploads/global/main/' . $global_community_detail[0]['hover_image'] ?>" width="100" height="100">
                                <input type="hidden" name="old_hover_image" value="<?php echo $global_community_detail[0]['hover_image'] ?>" />
                            </div>
                        </div>
                        <!-- global sub image end -->
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


        $("#edit_global_frm").validate({
            rules: {
                name: {
                    required: true,
                },
                global_id: {
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
                            required: "Please enter global name",
                        },
                        global_id: {
                            required: "Please enter global",
                        },
                        manufacture_id: {
                            required: "Please enter manufacturers",
                        },
                        cost_price: {
                            required: "Please enter global price",
                            digits: "Global Community cost price should be numeric",
                        },
                        sell_price: {
                            required: "Please enter global selling price",
                            digits: "Global Community sell price should be numeric",
                        },
                        stock: {
                            required: "Please enter global stock",
                        },
                        available_for: {
                            required: "Please enter global available for",
                        },
                        bid_time: {
                            required: "Please enter global bidding time",
                        },
                        available_date: {
                            required: "Please enter available date",
                        },
                        description: {
                            required: "Please enter global description",
                        }
                    },
        });


        //var available_for = document.getElementsByName("available_for");
        //alert(available_for);
        var available = $('input[name=available_for]:checked').val();
        if (available == 'buy')
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