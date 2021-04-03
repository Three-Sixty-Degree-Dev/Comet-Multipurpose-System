@extends('backend.layouts.app')

@section('main-content')
<div class="wrapper">

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
                        <a class="btn btn-sm btn-primary float-right" data-toggle="modal" href="#add_category_modal" ><i class="fas fa-plus"> Add New Category</i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Category Slug</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_data as $data)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->slug }}</td>
                                    <td>{{ $data->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if($data->status == true)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-danger">Unpublished</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a title="View" href="" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a title="Edit" href="" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></a>
                                        <a title="Delete" href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
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
    <div id="add_category_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Add New Category <button class="close" data-dismiss="modal">&times;</button></h2>
                    <hr>
                    <form action="{{ route('category.store') }}" method="POST" id="categoryValidate">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--    jquery Validation--}}
<script>
    $(function () {
        $('#categoryValidate').validate({
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
@endsection
