<?php
echo $header;
echo $leftmenu;
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
              <i class="fa fa-rss" aria-hidden="true"></i>
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
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $section_title; ?></h3>
                    </div><!-- /.box-header -->

                     <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div>
                    <!-- form start -->
                    <?php
                    $form_attr = array('id' => 'add_gov_post', 'enctype' => 'multipart/form-data');
                    echo form_open_multipart('goverment/add_gov_post_insert', $form_attr);
                    ?>
                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="posttitle" name="posttitle" id="posttitle">Title*</label>
                            <input type="text" class="form-control" name="post_title" id="post_title" value="" placeholder="Enter Job Title">
                    </div>
                    </div>

                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="govcat" name="govcat" id="govcat">Category*</label>
                             <select name="category" id="category" tabindex="1" class="form-control">
                               <option value="">Select job Category</option> 
                            <?php                             
                                      foreach($job_category as $cnt){ 
                                              ?>
                                    <option value="<?php echo $cnt['id']; ?>"><?php echo $cnt['name'];?></option>    <?php  } ?>
                      </select>
                    </div>
                    </div>


                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="post_name" name="post_name" id="post_name">Post Name</label>
                            <input type="text" class="form-control" name="postname" id="postname" value="" placeholder="Enter post Name">
                    </div>
                    </div>


                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="novac" name="novac" id="novac">No Vacancies</label>
                            <input type="text" class="form-control" name="novacan" id="novacan" value="" placeholder="Enter No Vacancies">
                    </div>
                    </div>

                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="paysc" name="paysc" id="paysc">pay Scale</label>
                            <input type="text" class="form-control" name="payscale" id="payscale" value="" placeholder="Enter pay Scale">
                    </div>
                    </div>

                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="paysc" name="jobl" id="jobl">Job Location</label>
                            <input type="jobl" class="form-control" name="jobloc" id="jobloc" value="" placeholder="Enter Job Location">
                    </div>
                    </div>

                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="reqe" name="reqe" id="reqe">Require Experience</label>
                            <input type="text" class="form-control" name="reqexp" id="reqexp" value="" placeholder="Enter require experience">
                    </div>
                    </div>


                     <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="postim" name="postim" id="postim">Post Image</label>
                            <input type="file" class="form-control" name="post_image" id="post_image" value="">
                    </div>
                    </div>

                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="govtitle" name="govsector" id="govsector">Sector</label>
                            <input type="text" class="form-control" name="gov_sector" id="gov_sector" value="" placeholder="Enter Post Sector">
                    </div>
                    </div>

                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="govelg" name="govelg" id="govelg">Eligibility</label>
                            <input type="text" class="form-control" name="gov_elg" id="gov_elg" value="" placeholder="Enter Eligibility">
                    </div>
                    </div>

                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="govdate" name="govdate" id="govdate">Last_date</label>
                            <select tabindex="9" class="day" name="selday" id="selday">
                                            <option value="" disabled selected value>Day</option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <select tabindex="10" class="month" name="selmonth" id="selmonth">
                                            <option value="" disabled selected value>Month</option>
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                        <select tabindex="11" class="year" name="selyear" id="selyear">
                                            <option value="" disabled selected value>Year</option>
                                            <?php
                                            for ($i = date('Y'); $i >= 1900; $i--) {
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                    </div>
                    </div>


                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="govdes" name="govdes" id="govelg">Description</label>

                             <textarea id="gov_des" name="gov_des" rows="10" cols="80">
                             </textarea>
                    </div>
                    </div>


                     <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="govlink" name="govlink" id="govlink">Apply Link</label>
                            <input type="text" class="form-control" name="gov_link" id="gov_link" value="" placeholder="Enter Apply Link">
                    </div>
                    </div>

                
                    <div class="box-body">                   
                    <div class="form-group col-sm-10">
                            <label for="govstatus" name="govstatus" id="govstatus">Status</label>
                            <input type="radio"  name="status" id="status" value="1" checked="checked"> Publish
                            <input type="radio"  name="status" id="status" value="2"> Draft
                    </div>
                    </div>


                    <div class="box-footer">
                        <?php
                        $save_attr = array('id' => 'btn_save', 'name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');
                        echo form_submit($save_attr);
                        ?>    
                        <button type="button" onclick="window.history.back();" class="btn btn-default">Back</button>                     
                    </div>
                    </form>
                </div><!-- /.box -->


            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php echo $footer; ?>
<script src="<?php echo base_url('admin/assets/js/jquery.min.js?ver='.time()); ?>"></script>
        <script src="<?php echo base_url('admin/assets/js/jquery.validate.min.js?ver='.time()); ?>"></script>
<script type="text/javascript">

    var base_url = '<?php echo base_url(); ?>'; 

    //validation for edit email formate form
    $(document).ready(function () {
        $("#add_gov_post").validate({
            rules: {
                post_title: {
                    required: true,
                },
                category: {
                    required: true,
                },
               
            },
            messages:
                    {
                        post_title: {
                            required: "Please enter post title",
                        },
                        category: {
                            required: "Please select job category",
                        },
                       
                    },
        }); });

</script>

<script>
    $(".alert").delay(3200).fadeOut(300);
</script>


<!-- SCRIPT FOR CKEDITOR START-->
<script type="text/javascript">   
  var roxyFileman = '<?php echo SITEURL.'uploads/upload.php'; ?>' ; 
   CKEDITOR.replace( 'gov_des',{
                                filebrowserBrowseUrl : roxyFileman,
                                filebrowserUploadUrl : roxyFileman,
                                filebrowserImageBrowseUrl : roxyFileman+'?type=image',
                                filebrowserImageUploadUrl : roxyFileman,
                                extraAllowedContent:  'img[alt,border,width,height,align,vspace,hspace,!src];' ,
                                removeDialogTabs: 'link:upload;image:upload'}); 
CKEDITOR.config.allowedContent = true;
CKEDITOR.on('instanceReady', function(ev) {
    // Ends self closing tags the HTML4 way, like <br>.
    ev.editor.dataProcessor.htmlFilter.addRules({
        elements: {
            $: function(element) {
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
                if (!element.attributes.style) delete element.attributes.style;
                return element;
            }
        }
    });
});     
</script>
<!-- SCRIPT FOR CKEDITOR END-->