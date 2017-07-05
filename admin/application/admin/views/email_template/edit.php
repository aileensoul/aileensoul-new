<!DOCTYPE html>
<html lang="en">
    <?php echo $head; ?>

    <body>

        <section id="container" >
            <?php echo $header; ?>
            <?php echo $leftbar; ?>

            <section id="main-content">
                <section class="wrapper">
                       <!--breadcumb -->
                  <ol class="breadcrumb">
                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>
                <li><a href="<?php echo site_url('email_template'); ?>">email template</a></li>
                <li class="active">Edit</li>
                 </ol>
                    <!-- end breadcumb -->
                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?><button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>
             


                    <!-- BASIC FORM ELELEMNTS -->
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>
                                <?php
                                if ($this->session->flashdata('success')) {
                                    echo $this->session->flashdata('success');
                                }
                                ?>
                                <?php
                                $form_attr = array('id' => 'add_emailformat_frm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal style-form');
                                echo form_open_multipart('email_template/edit', $form_attr);
                                ?>
                                <input type="hidden" name="emailid" id="id" value="<?php echo $emailformat_detail[0]['emailid']; ?>" />
                                <div class="box-body">


                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-6">                                    
                                            <input type="text" class="form-control" name="vartitle" id="vartitle" value="<?php echo $emailformat_detail['0']['vartitle'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Unique Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="uniquename" id="uniquename" value="<?php echo $emailformat_detail['0']['uniquename'] ?>">                                                                        
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Variables</label>
                                        <div class="col-sm-6">
                                            <textarea id="variables" class="form-control"  cols="20"  rows="6" name="variables" disabled="disabled"><?php echo $emailformat_detail[0]['variables']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email Subject</label>
                                        <div class="col-sm-6">
                                            <textarea id="varsubject" class="form-control"  cols="20" rows="2" name="varsubject"><?php echo $emailformat_detail[0]['varsubject']; ?></textarea>
                                        </div>
                                    </div>                            

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email Format</label>
                                        <div class="col-sm-10">
                                            <?php echo form_textarea(array('name' => 'varmailformat', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($emailformat_detail[0]['varmailformat']))); ?><br>
                                        </div>
                                    </div>

                                </div><!-- /.box-body -->
                                <div class="box-footer done">
                                    <?php
                                    $save_attr = array('id' => 'btn_save', 'name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary btn_my');
                                    echo form_submit($save_attr);
                                    ?>    
                                 
                                    <!--<button type="submit" class="btn btn-info pull-right">Sign in</button>-->
                                </div><!-- /.box-footer -->
                                </form>
                            </div>
                        </div><!-- col-lg-12-->      	
                    </div><!-- /row -->


                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->

            <?php echo $footer; ?>

        </section>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url('admin/assets/js/jquery.js') ?>"></script>
        <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js') ?>"></script>
        <script class="include" type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>
        <script src="<?php echo base_url('admin/assets/js/jquery.scrollTo.min.js') ?>"></script>
        <script src="<?php echo base_url('admin/assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('admin/assets/js/jquery.sparkline.js') ?>"></script>


        <!--common script for all pages-->
        <script src="<?php echo base_url('admin/assets/js/common-scripts.js') ?>"></script>

        <!--script for this page-->
        <script src="<?php echo base_url('admin/assets/js/jquery-ui-1.9.2.custom.min.js') ?>"></script>

        <!--custom switch-->
        <script src="<?php echo base_url('admin/assets/js/bootstrap-switch.js') ?>"></script>

        <!--custom tagsinput-->
        <script src="<?php echo base_url('admin/assets/js/jquery.tagsinput.js') ?>"></script>

        <!--custom checkbox & radio-->

        <script src="<?php echo base_url('admin/assets/js/form-component.js') ?>"></script>    
        <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('.alert-success').fadeOut(3000).hide('700');
                                            $('.alert-danger').fadeOut(3000).hide('700');
                                        });
        </script>
        <script src="<?php echo base_url('admin/assets/ckeditor/ckeditor.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>
        <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#edit_banner").validate({
                                                rules: {
                                                    banner_name: {
                                                        required: true
                                                    },
                                                    banner_image1: {
                                                        required: true
                                                    }
                                                },
                                                messages: {
                                                    banner_name: {
                                                        required: "Please Enter Banner Name"
                                                    },
                                                    banner_image1: {
                                                        required: "Please Select Banner Image"
                                                    }
                                                },
                                            });

                                        });

                                        var roxyFileman = '<?php echo base_url() . '../uploads/upload.php'; ?>';

                                        CKEDITOR.replace('page_description', {
                                            filebrowserBrowseUrl: roxyFileman,
                                            filebrowserUploadUrl: roxyFileman,
                                            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
                                            filebrowserImageUploadUrl: roxyFileman,
                                            extraAllowedContent: 'img[alt,border,width,height,align,vspace,hspace,!src];',
                                            removeDialogTabs: 'link:upload;image:upload'});

                                        CKEDITOR.config.allowedContent = true;

                                        CKEDITOR.on('instanceReady', function (ev) {

                                            // Ends self closing tags the HTML4 way, like <br>.
                                            ev.editor.dataProcessor.htmlFilter.addRules({
                                                elements: {
                                                    $: function (element) {
                                                        // Output dimensions of images as width and height
                                                        if (element.name == 'img') {
                                                            var style = element.attributes.style;

                                                            if (style) {
                                                                // Get the width from the style.
                                                                var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                                                                        width = match && match[1];

                                                                // Get the height from the style.
                                                                match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                                                                var height = match && match[1];

                                                                // Get the float from the style.
                                                                match = /(?:^|\s)float\s*:\s*(\w+)/i.exec(style);
                                                                var float = match && match[1];

                                                                if (width) {
                                                                    element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                                                                    element.attributes.width = width;
                                                                }

                                                                if (height) {
                                                                    element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                                                                    element.attributes.height = height;
                                                                }
                                                                if (float) {
                                                                    element.attributes.style = element.attributes.style.replace(/(?:^|\s)float\s*:\s*(\w+)/i, '');
                                                                    element.attributes.align = float;
                                                                }

                                                            }
                                                        }

                                                        if (!element.attributes.style)
                                                            delete element.attributes.style;

                                                        return element;
                                                    }
                                                }
                                            });
                                        });

        </script>
        <!-- CK Editor -->

    </body>
</html>
