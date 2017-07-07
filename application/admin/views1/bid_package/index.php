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
                        <div class=" pull-right">
                            <a href="#myModal1" data-toggle="modal" class="btn btn-primary pull-right">Add Bid Package</a>
                        </div>
                    </div>



                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Package Coins</th>
                                    <th>Package Amount</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Modify Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($package_list as $package) {
                                    if ($package['status'] == 1) {
                                        $status = 'Publish';
                                    } else {
                                        $status = 'Draft';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $package['package_id'] ?></td>
                                        <td><?php echo $package['package'] ?></td>
                                        <td><?php echo $package['price'] ?></td>
                                        <td><a href="<?php echo base_url('bid_package/change_status/' . $package['package_id'] . '/' . $package['status']); ?>"><?php echo $status ?></a></td>
                                        <td><?php echo $package['create_date'] ?></td>
                                        <td><?php echo $package['modify_date'] ?></td>
                                        <td>
                                            <a href="#myModal" id="edit_package_btn" onclick="getPackage(<?php echo $package['package_id'] ?>);"  data-toggle="modal" title="Edit Bid Package">
                                                <button type="button" class="btn btn-primary"><i class="icon-pencil"></i> <i class="fa fa-pencil-square-o"></i></button>
                                            </a>
                                            <a data-href="<?php echo base_url() . 'bid_package/delete/' . $package['package_id']; ?>" id="delete_btn" data-toggle="modal" data-target="#confirm-delete" href="#" title="Delete Bid Package">
                                                <button type="button" class="btn btn-primary" ><i class="icon-trash"></i> <i class="fa fa-trash-o"></i></button>
                                            </a>
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
                <h4 class="modal-title">Edit Bid Package</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('bid_package/edit', array('name' => 'package_edit_frm', 'id' => 'package_edit_frm', 'method' => 'POST')); ?>
                <input type="hidden" class="form-control" name="package_id" id="package_id" value="">
                <div class="row">
                    <div class="form-group col-sm-10">
                        <label for="inputEmail3" name="package_coins" id="package_coins">Package Coins</label>
                        <input type="number" class="form-control" name="package" id="package" class="package" value="">
                    </div>
                    <div class="form-group col-sm-10">
                        <label for="inputEmail3" name="package_amount" id="package_amount">Package Amount</label>
                        <input type="number" class="form-control" name="price" id="price" class="price" value="">
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
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Bid Package</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('bid_package/add', array('name' => 'package_add_frm', 'id' => 'package_add_frm', 'method' => 'POST')); ?>
                <div class="row">
                    <div class="form-group col-sm-10">
                        <label for="inputEmail3" name="package_coin" id="package_coin">Package Coin</label>
                        <input type="text" class="form-control" name="package" id="package" class="package" value="">
                    </div>
                    <div class="form-group col-sm-10">
                        <label for="inputEmail3" name="package_price" id="package_price">Package Price</label>
                        <input type="text" class="form-control" name="price" id="price" class="price" value="">
                    </div>

                    <div class="col-sm-3   ">
                        <button type="submit" name="submit" value="send" class="btn btn-primary btn-block btn-flat">send</button>
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
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="frm_title">Delete Conformation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this package?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">

    $(document).ready(function () {
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });

        $('#search_frm').submit(function () {
            var value = $('#search_keyword').val();
            if (value == '')
                return false;
        });


        $('#checkedall').click(function (service) {
            if (this.checked) {
                // Iterate each checkbox
                $('.deletes').each(function () {
                    this.checked = true;
                });
            }
            else {
                $('.deletes').each(function () {
                    this.checked = false;
                });
            }
        });

        $('.deletes').click(function (service) {
            var flag = 0;
            $('.deletes').each(function () {
                if (this.checked == false) {
                    flag++;
                }
            });
            if (flag) {
                $('.checkedall').prop('checked', false);
            }
            else {
                $('.checkedall').prop('checked', true);
            }


        });



    });
</script>
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
    function getPackage($id)
    {
        var package_id = $id;
        $.ajax({
            url: "<?php echo base_url('bid_package/getPackageData'); ?>",
            type: "POST",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'package_id': package_id},
            success: function (data) {
                console.log(data);
                $("#package").val(data['package']);
                $("#price").val(data['price']);
                $("#package_id").val(package_id);
                //   $("#category_name").val("Dolly Duck");
            }
        });
    }
</script>
<script type="text/javascript">
    //validation for edit email formate form
    $(document).ready(function () {

        $("#package_edit_frm").validate({
            rules: {
                package: {
                    required: true,
                },
                price: {
                    required: true,
                }
            },
            messages:
                    {
                        package: {
                            required: "Package coins is required",
                        },
                        price: {
                            required: "Package price is required",
                        }
                    },
        });
        $("#package_add_frm").validate({
            rules: {
                package: {
                    required: true,
                },
                price: {
                    required: true,
                }
            },
            messages:
                    {
                        package: {
                            required: "Package coins is required",
                        },
                        price: {
                            required: "Package price is required",
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