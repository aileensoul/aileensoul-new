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

                <li><a href="<?php echo site_url('pages'); ?>">pages</a></li>

                <li class="active">Edit</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?><button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

                  



                    <!-- BASIC FORM ELELEMNTS -->

                    <div class="row mt">
                        <div class="col-lg-3"></div>

                        <div class="col-lg-9">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('site_setting_success')) {

                                    echo $this->session->flashdata('site_setting_success');

                                }

                                ?>

                                <?php

                                $form_attr = array('name' => 'edit_page', 'id' => 'edit_page', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('pages/edit_pages', $form_attr);

                                ?>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Page Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="page_name" value="<?php echo $page_name ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Page Title</label>

                                    <div class="col-sm-7">

                                        <input type="tet" name="page_title" value="<?php echo $page_title ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Page Short Description</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="short_description" value="<?php echo $short_description ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Page Description</label>

                                    <div class="col-sm-7">

                                        <textarea class="ckeditor" name="page_description"><?php echo $page_description ?></textarea>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Page Image</label>

                                    <div class="col-sm-3">

                                        <input type="file" name="page_image" value="" class="form-control">

                                    </div>

                                    <div class="col-sm-4">

                                    <img src="<?php echo base_url(pageimages.$image) ?>" style="width: 100px; height: 80px;">

                                    </div>

                                </div>

                                <hr>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Page SEO Title</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="seo_title" value="<?php echo $seo_title ?>" class="form-control">

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Page SEO Keywords</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="seo_keywords" value="<?php echo $seo_keywords ?>" class="form-control">

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Page SEO Description</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="seo_description" value="<?php echo $seo_description ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="done">

                                <input type="hidden" name="old_image" value="<?php echo $image; ?>" />    

                                <input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />    

                                <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                </div>

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

            });</script>

        <script src="<?php echo base_url('admin/assets/ckeditor/ckeditor.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>

        <script type="text/javascript">

             //validation for edit email formate form

            $(document).ready(function () {



                $("#edit_page").validate({

                    rules: {

                        section_title: {

                            required: true,

                        },

                        page_title: {

                            required: true,

                        }

                    },

                    messages: {

                        section_title: {

                            required: "Page Name Is Required",

                        },

                        page_title: {

                            required: "Page Ttile Is Required",

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

