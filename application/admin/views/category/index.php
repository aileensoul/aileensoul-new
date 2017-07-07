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



    <!-- Content Header (Page header) -->




    <!-- Main content -->
    <section class="content">
        <div class="row" >
            <div class="col-xs-12" >
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="callout callout-success">
                        <p><?php echo $this->session->flashdata('success'); ?></p>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>  
                    <div class="callout callout-danger">
                        <p><?php echo $this->session->flashdata('error'); ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $section_title ?></h3>
                    </div>



                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category Name</th>
                                    <!--<th>Created Date</th>-->
                                    <th>Modify Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($category_list as $category) {
                                    ?>
                                    <tr>
                                        <td><?php echo $category['id'] ?></td>
                                        <td><?php echo $category['name'] ?></td>
                                        <!--<td><?php echo $category['create_date'] ?></td>-->
                                        <td><?php echo $category['modify_date'] ?></td>
                                        <td>
                                            <a href="<?php echo base_url('category/edit/'.$category['id']) ?>" id="edit_category_btn" title="Edit Category">
                                                <button type="button" class="btn btn-primary"><i class="icon-pencil"></i> <i class="fa fa-pencil-square-o"></i></button>
                                            </a>
<!--                                            <a href="#myModal" id="edit_category_btn" onclick="getCategoryname(<?php echo $category['id'] ?>);"  data-toggle="modal" title="Edit Category">
                                                <button type="button" class="btn btn-primary"><i class="icon-pencil"></i> <i class="fa fa-pencil-square-o"></i></button>
                                            </a>-->
                                        </td>
                                    </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


                </tbody>
                <tfoot>

                </tfoot>
                </table>
            </div><!-- /.box -->


        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit Category</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('category/edit', array('name' => 'category_frm_user', 'id' => 'category_frm', 'method' => 'POST')); ?>
                                                <input type="hidden" class="form-control" name="category_id" id="category_id" value="">
                                                <div class="row">
                                                    <div class="form-group col-sm-10">
                                                        <label for="inputEmail3" name="category" id="category">Category Name</label>
                                                        <input type="text" class="form-control" name="category_name" id="category_name" class="category_name" value="">
                                                    </div>


                                                    <div class="col-sm-3   ">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">send</button>
                                                    </div><!-- /.col -->
                                                </div>



                                                <?php echo form_close(); ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<?php echo $footer; ?>


<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<script type="text/javascript">
    function getCategoryname($id)
    {
        var category_id = $id;
        $.ajax({
            url: "<?php echo base_url('category/getCatName'); ?>",
            type: "POST",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'category_id': category_id},
            success: function (data) {
                console.log(data['category_name']);
                $("#category_name").val(data['category_name']);
                $("#category_id").val(category_id);
             //   $("#category_name").val("Dolly Duck");
            }
        });
    }
</script>
<script type="text/javascript">
    //validation for edit email formate form
    $(document).ready(function () {
        $("#category_frm").validate({
            rules: {
                category_name: {
                    required: true,
                }
            },
            messages:
                    {
                        category_name: {
                            required: "Category name is required",
                        }
                    },
        });

    });

</script>
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
        $('.callout-danger').delay(3000).hide('700');
        $('.callout-success').delay(3000).hide('700');
    });
</script>