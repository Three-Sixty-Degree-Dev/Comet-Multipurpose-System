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
                        <h1 class="m-0">Manage Tags</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tags</li>
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
                        <h2 class="card-title">All Trash Tags</h2>
                        <div style="display: flex; margin-left: 0px; width: 100%;">
                            <a class="badge badge-primary" href="{{ route('products.tags') }}">Published <span class="product_tag_publish"></span></a>
                            <a style="margin-left: 5px;" class="badge badge-danger" href="{{ route('products.tag.trash') }}">Trash <span class="product_tag_trash"></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="product_tag_trash_table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Tag Name</th>
                                    <th>Tag Slug</th>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@include('validation')
@endsection
