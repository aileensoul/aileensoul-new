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
                    $form_attr = array('id' => 'edit_faqs_frm', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('faqs/edit', $form_attr);
                    ?>
                    <input type="hidden" name="faqs_id" value="<?php echo $faqs_detail[0]['id'] ?>">
                    <div class="box-body">
                        <!-- faqs question start -->
                        <div class="form-group col-sm-10">
                            <label for="faqsquestion" question="faqs_question" id="faqs_question">Question*</label>
                            <input type="text" class="form-control" name="question" id="question" value="<?php echo $faqs_detail[0]['question'] ?>">
                        </div>
                        <!-- faqs question end -->
                        
                        <!-- faqs answer start -->
                        <div class="form-group col-sm-10">
                            <label for="faqsanswer" question="faqs_answer" id="faqs_answer">Answer *</label>
                            <?php
                            echo form_textarea(array('name' => 'answer', 'id' => 'answer editor1', 'class' => "textarea", 'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;',
                                'value' => $faqs_detail[0]['answer']));
                            ?><br>
                        </div>
                        <!-- faqs answer end -->
                        
                        
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


        $("#edit_faqs_frm").validate({
            rules: {
                question: {
                    required: true,
                },
                position: {
                    required: true,
                },
                answer: {
                    required: true,
                }
            },
            messages:
                    {
                        question: {
                            required: "Please enter question",
                        },
                        position: {
                            required: "Please enter position",
                        },
                        answer: {
                            required: "Please enter answer",
                        },
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