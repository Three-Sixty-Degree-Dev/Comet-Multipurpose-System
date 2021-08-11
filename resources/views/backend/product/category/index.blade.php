@extends('backend.layouts.app')

@section('main-content')
<div class="wrapper">
    {{--Toster CSS--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />

    <!-- Navbar -->
    @include('backend.layouts.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('backend.layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-5">
                        <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Add New Categorey</h3>
                            </div>
                            <form method="POST" id="product_categroy_form" class="pcategroyValidate" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label>Parent Category</label>
                                        <select class="form-control select2" name="parent_id" id="parent_category" style="width: 100%;">
                                          <option value="">-Select-</option>



                                        </select>
                                    </div>

                                    <div class="input-group">
                                        <label for="" class="w-100">Icon</label><br>
                                        <span class="input-group-prepend">
                                            <button class="btn btn-secondary" name="icon" id="category_icon" data-icon="" role="iconpicker"></button>
                                        </span>
                                        <input type="text" id="icon_name" class="form-control">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="p_image_l"><i class="fas fa-file-image fa-4x text-success" ></i></label>
                                        <input type="file" name="image" class="form-control category_image_add d-none" id="p_image_l">
                                        <img style="height: 120px; margin-left: 50px;" class="category_photo_show" src="" alt="">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; <a href="https://adminlte.io">Salim66</a>.</strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Designed & Developed by</b> Salim66
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

{{--    Add Category Modal--}}
    {{-- <div id="add_product_category_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Add New Category <button class="close" data-dismiss="modal">&times;</button></h2>
                    <hr>
                    <form method="POST" id="product_categroy_form" class="pcategroyValidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="input-group">
                            <span class="input-group-prepend">
                                <button class="btn btn-secondary" name="icon" data-icon="" role="iconpicker"></button>
                            </span>
                            <input type="text" class="form-control">
                        </div><br>

                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}





{{--    jquery Validation--}}
<script>
    $(function () {
        $('.product_categroy_form').validate({
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Please enter a category name",
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
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@include('validation')
@endsection





