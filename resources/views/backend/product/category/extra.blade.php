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
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">All Categories</h2>
                        <a class="btn btn-sm btn-primary float-right" data-toggle="modal" href="#add_product_category_modal" ><i class="fas fa-plus"> Add New Category</i></a>
                        <div style="display: flex; margin-left: 0px; width: 100%;">
                            <a class="badge badge-primary" href="{{ route('categories.index') }}">Published <span class="p_category_publish"></span></a>
                            <a style="margin-left: 5px;" class="badge badge-danger" href="{{ route('products.category.trash') }}">Trash <span class="p_category_trash"></span></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="product_category_table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Trash</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                        </table>
                    </div>
                    <!-- /.card-body -->
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
    <div id="add_product_category_modal" class="modal fade">
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
                            <label for="p_image_l"><i class="fas fa-file-image fa-4x text-success" ></i></label>
                            <input type="file" name="image" class="form-control category_image_add d-none" id="p_image_l">
                            <img style="height: 120px;" class="category_photo_show" src="" alt="">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


{{--    Edit Brand Modal--}}
    <div id="edit_product_category_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Edit Category <button class="close" data-dismiss="modal">&times;</button></h2>
                    <hr>
                    <form method="POST" id="edit_product_category_form" class="pcategoryValidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="hidden" name="id" class="brand_id">
                            <input type="text" name="name" class="form-control product_category_name">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control product_category_image_edit">
                            <img style="height: 120px;" class="product_category_image_show" src="" alt="">
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="file" name="icon" class="form-control product_category_icon_edit">
                            <img style="height: 120px;" class="product_category_icon_show" src="" alt="">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


{{--    jquery Validation--}}
<script>
    $(function () {
        $('.pcategoryValidate').validate({
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Please enter a brand name",
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
