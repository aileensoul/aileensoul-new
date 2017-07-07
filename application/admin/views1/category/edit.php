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

                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert fade in alert-success">
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('error')) { ?>  
                            <div class="alert fade in alert-danger" >
                                <i class="icon-remove close" data-dismiss="alert"></i>
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } ?>


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
                        $form_attr = array('id' => 'add_category_frm','enctype' => 'multipart/form-data');
                        echo form_open_multipart('category/edit', $form_attr);
                        ?>
                    <input type="hidden" name="categoryid" value="<?php echo $category_list[0]['categoryid']; ?>">
                        <div class="box-body">
                            
<!--                            <div class="form-group col-sm-10">
                                <label for="inputEmail3"  class="col-sm-2 control-label">Parent Category</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="parent_id" id="parent_id" style="width: 100%;" tabindex="-1" >
                                        <option value="0">Select Parent </option>
                                        <?php // datalist_parent_cat($category_list[0]['parent_id']); ?>
                                    </select>
                                </div>
                            </div>-->
<!--    <div class="form-group col-sm-10">
                                <label for="inputEmail3"  class="col-sm-2 control-label">Sub Category</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="sub_id" id="sub_id" style="width: 100%;" tabindex="-1" >
                                        <option value="0">select Sub </option>
                                    </select>
                                </div>
                            </div>   -->
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" name="category_title" id="category_title" class="col-sm-2 control-label">Category Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="category_title" id="category_title" value="<?php echo $category_list[0]['category_title']; ?>">
                                </div>
                            </div>
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" class="col-sm-2 control-label">Sort Description</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="sort_description" id="sort_description" value="<?php echo $category_list[0]['sort_description']; ?>">
                                </div>
                            </div>
                                                                                 
                            <div class="form-group col-sm-10">
                                <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-6">
                                    <!--<input type="text" class="form-control" name="description" id="description" value="<?php echo $category_list[0]['description']; ?>" >-->
                                     <textarea class="form-control ckeditor" id="description" name="description" rows="10" cols="80"><?php echo $category_list[0]['description']; ?></textarea> 
                                    
                                </div>
                            </div>
                            <div class="form-group col-sm-10" id="cat_image">
                                
                                <label for="inputEmail3"  class="col-sm-2 control-label">Category image </label>
                                <div class="col-sm-6">
                                    <img src="<?=$this->config->item("MAIN_SITE_URL")?>uploads/category/main/<?php echo $category_list[0]['category_image'] ?>" width='150' height="50">
                                </div>
                            </div>
                            
                            <div class="form-group col-sm-10" id="cat_image1">
                                <label for="inputEmail3" class="col-sm-2 control-labely">Category File *<br>(gif|jpg|png)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="category" id="category"   />
                                </div>
                            </div>
                            
                            <input type="hidden" name="oldcategory" value="<?php echo $category_list['0']['category_image']; ?>">
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
       
        $("#add_category_frm").validate({
            
            rules: {
                category_title: {
                   required: true,
                },
                description: {
                   required: true,
                },
                sort_description: {
                   required: true,
                }
            },
            messages:{
                category_title: {
                    required: "category name is required",
                },
                sort_description: {
                    required: "sort description is required",
                },
                description: {
                   required: "category description  is required",
                }

            },
        });

    });
</script>