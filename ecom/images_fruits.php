<?php
  include "include/header.php";
  include "include/navbar.php";
  include "include/sidebar.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Fruit of Images</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="images_fruit" data-toggle="modal" data-target="#images_fruit_modal">
                        Click to Add Fruit Images
                    </button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Start content -->
    <section class="content">
        <!-- Add Client Modal -->
        <div class="modal fade" id="images_fruit_modal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="images_fruit_modalLabel" >Add Fruit Images</h5>
                        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="images_fruit_form" name="images_fruit_form" method="post">
                        <div class="modal-body">
                            <!-- client code  -->
                            <div class="row">
                                <div id="msg"></div>
                            </div>
                            <div class="row">    
                                <!-- Update Hidden id  -->
                                <input type="hidden" name="pduct_image_id" id="pduct_image_id" class="form-control" value="0">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image_name">Image Fruits Name<span class="must">*</span></label>
                                        <input type="text" name="image_name" id="image_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fruits_id">Fruits<span class="must">*</span></label>
                                        <select class="form-control" id="fruits_id" name="fruits_id" style="width: 100%;"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fee">Upload Image</label>
                                        <!-- <input type="hidden" id="imagePath" value=""/> -->
                                        <input type="file" name="product_images" multiple onchange="encodeImagetoBase64(this, 'image_file_base64')" id="product_images" class="form-control"/>
                                        <input type="hidden" name="image_file_base64" id="image_file_base64" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="save" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Client Modal -->


        <!-- Start Client Table -->
        <div class="card">
            <div class="alert alert-warning alert-dismissible fade hide d-none" role="alert" id="notice">
                <p id="message"></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="col-md-12" id="result"></div> -->
            <!-- /.card-header -->
            <div class="card-body">
                <table id="imagesFruit_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width='8%'>S.No.</th>
                            <th width='15%'>Fruits Name</th>
                            <th>Image Fruit Name</th>
                            <th width='7%'>Images</th>
                            <th width='7%'>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- Start Client Table -->
    </section>
    <!-- End content -->
</div>




<!-- Start Footer -->
<?php include "include/footerJs.php"; ?>
<!-- End Footer -->
<script src="theme/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="theme/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(function () {
        let arr = {
            action: 'get'
        };
        var request = JSON.stringify(arr);
        $.ajax({
            method: "POST",
            url: "controller/fruit_cateC.php",
            data: request,
            dataType: "JSON",
            async: false,
            headers: {
                "Content-Type": "application/json"
            },
            beforeSend: function() {
                console.log(request);
            },
        }).done(function(Response) {
            $('#fruits_id').html('<option value="0">Select Fruit</option>');
            $.each(Response.data, function(index, value) {
                if (value.is_status == 1) {
                    $('#fruits_id').append('<option value="' + value.fruits_id + '">' + value.fruits_name + '</option>');
                }
            });
        }).fail(function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseJSON.msg;
            }
            $("#message").html(msg).show();
        }).always(function(xhr) {
            console.log(xhr);
        });
    })

    $(function () {
        var DataTable =  $("#imagesFruit_table").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: {
                url: "controller/images_fruitsC.php",
                type: "POST",
                dataType: "json",
                async: false,
                headers: {
                    "Content-Type": "application/json"
                },
                data: function (d) {
                    d.action = 'get';
                    return JSON.stringify(d);
                }
            },
            "columns": [
                { "data": "s_no", "searchable": false, "orderable": false },
                { "data": "fruits_name"},
                { "data": "image_name"},
                { "data": "product_images", "searchable": false, "orderable": false},
                { "data": "action", "searchable": false, "orderable": false },
            ]
        }).buttons().container().appendTo('#fruitsName_table_wrapper .col-md-6:eq(0)');

        // Add Button click
        $(document).on('click', '#images_fruit', function() {
            // $("#lawyer_advisory_modal_label").html("Add Senior Lawyer Advisory");
            $("#save").html("Save");
            $("#pduct_image_id").val(0);
            $("#fruits_id").val(0);
            $("#image_name").val('');
            $("#product_images").val('');
            $("#image_file_base64").val('');
            
            $("#pduct_image_id").removeClass('is-invalid');
            $("#fruits_id").removeClass('is-invalid');
            $("#image_name").removeClass('is-invalid');
            
            $("#pduct_image_id-error").hide();
            $("#fruits_id-error").hide();
            $("#image_name-error").hide();
            $("#msg").hide();
            // $('#images_fruit_form').trigger("reset");
        });
        $.validator.setDefaults({
            submitHandler: function(e) {
                let pduct_image_id = $.trim($("#pduct_image_id").val());
                let fruits_id = $.trim($("#fruits_id").val());
                let image_name = $.trim($("#image_name").val());
                let image_file_base64 = $("#image_file_base64").val();
                
                let action = 'add';
                if (pduct_image_id > 0) {
                    action = 'update';
                }
                let arr = {
                    action: action,
                    pduct_image_id,pduct_image_id,
                    fruits_id: fruits_id,
                    image_name: image_name,
                    image_file_base64:image_file_base64
                };
                var request = JSON.stringify(arr);
                $.ajax({
                    method: "POST",
                    url: "controller/images_fruitsC.php",
                    data: request,
                    dataType: "JSON",
                    async: false,
                    headers: {
                        "Content-Type": "application/json"
                    },
                    beforeSend: function() {
                        console.log(request);
                    },
                }).done(function(Response) {
                    $("#images_fruit_modal").modal('hide');
                    $('#imagesFruit_table').DataTable().ajax.reload();
                    $("#message").html(Response.msg).show();
                    $("#notice").removeClass("d-none");
                    $("#notice").removeClass("hide");
                    $("#notice").addClass("d-block");
                    $("#notice").addClass("show");
                }).fail(function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseJSON.msg;
                    }
                    $("#message").html(msg).show();
                }).always(function(xhr) {
                    console.log(xhr);
                });
            }
        });
        // form validation
        $('#images_fruit_form').validate({
            rules: {
                image_name: {
                    required: true,
                    minlength: 3
                },
               
            },
            messages: {
                image_name: {
                    required: "Please enter a Fruits Names",
                    minlength: "Fruits Names must be at least 3 characters long"
                },
                

            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        // $(document).on('click','.edit',function(e){
        //     save.html("Done");
        //     let fruits_id = $(this).data('id');
        //     let fruits_name = $(this).data('fname');
        //     $("#fruits_id").val(fruits_id);
        //     $("#fruits_name").val(fruits_name);
        //     $("#fruits_name_modal").modal('show');
        // });

        // $(document).on('click','.delete',function(e) {
        //     if (confirm("Are you sure delete this Case Detail!")) {
        //         let fruits_id = $(this).data('id');
        //         let arr = { 
        //             action : 'delete',
        //             fruits_id: fruits_id
        //         };
        //         var request = JSON.stringify(arr); 
        //         $.ajax({
        //             method: "POST",
        //             url: "controller/fruit_cateC.php",
        //             data: request,
        //             dataType: "JSON",
        //             async: false,
        //             headers: {
        //                 "Content-Type": "application/json"
        //             },
        //             beforeSend: function() {
        //                 console.log(request);
        //             },
        //         }).done(function (Response) {
        //             $('#fruitsName_table').DataTable().ajax.reload();
        //             $("#message").html(Response.msg).show();
        //             $("#notice").removeClass("d-none");
        //             $("#notice").removeClass("hide");
        //             $("#notice").addClass("d-block");
        //             $("#notice").addClass("show");
        //         }).fail(function (jqXHR, exception) {
        //             var msg = '';
        //             if (jqXHR.status === 0) {
        //                 msg = 'Not connect.\n Verify Network.';
        //             } else if (jqXHR.status == 404) {
        //                 msg = 'Requested page not found. [404]';
        //             } else if (jqXHR.status == 500) {
        //                 msg = 'Internal Server Error [500].';
        //             } else if (exception === 'parsererror') {
        //                 msg = 'Requested JSON parse failed.';
        //             } else if (exception === 'timeout') {
        //                 msg = 'Time out error.';
        //             } else if (exception === 'abort') {
        //                 msg = 'Ajax request aborted.';
        //             } else {
        //                 msg = 'Uncaught Error.\n' + jqXHR.responseJSON.msg;
        //             }
        //             $("#message").html(msg).show();
        //         }).always(function (xhr) {
        //             console.log(xhr);
        //         });
        //     }
        // });

        // $(document).on('click','.statusHide',function(e){
        //     let fruits_id = $(this).data('id');
        //     let is_status = $(this).data('issts');
        //     let fruits_name = $(this).data('fname');
            
        //     if(is_status == 1){
        //         let arr = { 
        //             action : 'statusHide',
        //             fruits_id:fruits_id,
        //             is_status: is_status,
        //             fruits_name:fruits_name
        //         };
        //         var request = JSON.stringify(arr);
        //         $.ajax({
        //                 method: "POST",
        //                 url: "controller/fruit_cateC.php",
        //                 data: request,
        //                 dataType: "JSON",
        //                 async: false,
        //                 headers: {
        //                     "Content-Type": "application/json"
        //                 },
        //                 beforeSend: function() {
        //                     console.log(request);
        //                 },
        //             }).done(function (Response) {
        //                 $('#fruitsName_table').DataTable().ajax.reload();
        //                 $("#message").html(Response.msg).show();
        //                 $("#notice").removeClass("d-none");
        //                 $("#notice").removeClass("hide");
        //                 $("#notice").addClass("d-block");
        //                 $("#notice").addClass("show");
        //             }).fail(function (jqXHR, exception) {
        //                 var msg = '';
        //                 if (jqXHR.status === 0) {
        //                     msg = 'Not connect.\n Verify Network.';
        //                 } else if (jqXHR.status == 404) {
        //                     msg = 'Requested page not found. [404]';
        //                 } else if (jqXHR.status == 500) {
        //                     msg = 'Internal Server Error [500].';
        //                 } else if (exception === 'parsererror') {
        //                     msg = 'Requested JSON parse failed.';
        //                 } else if (exception === 'timeout') {
        //                     msg = 'Time out error.';
        //                 } else if (exception === 'abort') {
        //                     msg = 'Ajax request aborted.';
        //                 } else {
        //                     msg = 'Uncaught Error.\n' + jqXHR.responseJSON.msg;
        //                 }
        //                 $("#message").html(msg).show();
        //             }).always(function (xhr) {
        //                 console.log(xhr);
        //         });
        //     }
        // });

        // $(document).on('click','.statusShow',function(e){
        //     let fruits_id = $(this).data('id');
        //     let is_status = $(this).data('issts');
        //     let fruits_name = $(this).data('fname');
            
        //     if(is_status == 2){
        //         let arr = { 
        //             action : 'statusShow',
        //             fruits_id:fruits_id,
        //             is_status: is_status,
        //             fruits_name:fruits_name
        //         };
        //         var request = JSON.stringify(arr);
        //         $.ajax({
        //                 method: "POST",
        //                 url: "controller/fruit_cateC.php",
        //                 data: request,
        //                 dataType: "JSON",
        //                 async: false,
        //                 headers: {
        //                     "Content-Type": "application/json"
        //                 },
        //                 beforeSend: function() {
        //                     console.log(request);
        //                 },
        //             }).done(function (Response) {
        //                 $('#fruitsName_table').DataTable().ajax.reload();
        //                 $("#message").html(Response.msg).show();
        //                 $("#notice").removeClass("d-none");
        //                 $("#notice").removeClass("hide");
        //                 $("#notice").addClass("d-block");
        //                 $("#notice").addClass("show");
        //             }).fail(function (jqXHR, exception) {
        //                 var msg = '';
        //                 if (jqXHR.status === 0) {
        //                     msg = 'Not connect.\n Verify Network.';
        //                 } else if (jqXHR.status == 404) {
        //                     msg = 'Requested page not found. [404]';
        //                 } else if (jqXHR.status == 500) {
        //                     msg = 'Internal Server Error [500].';
        //                 } else if (exception === 'parsererror') {
        //                     msg = 'Requested JSON parse failed.';
        //                 } else if (exception === 'timeout') {
        //                     msg = 'Time out error.';
        //                 } else if (exception === 'abort') {
        //                     msg = 'Ajax request aborted.';
        //                 } else {
        //                     msg = 'Uncaught Error.\n' + jqXHR.responseJSON.msg;
        //                 }
        //                 $("#message").html(msg).show();
        //             }).always(function (xhr) {
        //                 console.log(xhr);
        //         });
        //     }
        // });
    });
    function encodeImagetoBase64(element, base64Id) {
        console.log('working');
        var File = element.files[0];
        var FR = new FileReader();
        FR.addEventListener("load", function() {
            $("#" + base64Id).val(FR.result);
        });
        FR.readAsDataURL(File);
    }
</script>
<?php include "include/footer.php"; ?>