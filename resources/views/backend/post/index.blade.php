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
                            <h1 class="m-0">Manage Posts</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Posts</li>
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
                            <h2 class="card-title">All Post (Published)</h2>
                            <a class="btn btn-sm btn-primary float-right" href="{{ route('create') }}" ><i class="fas fa-plus"> Add New Post</i></a><br>
                            <div style="display: flex; margin-left: 0px; width: 100%;">
                                <a class="badge badge-primary" href="{{ route('index') }}">Published {{ ($published)? $published : '' }}</a>
                                <a style="margin-left: 5px;" class="badge badge-danger" href="{{ route('post.trash') }}">Trash {{ ($trash)? $trash : '' }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Post Title</th>
                                    <th>Author</th>
                                    <th>Post Type</th>
                                    <th>Featured</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th width="90">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_data as $data)
                                    @php
                                        $featured_info = json_decode($data -> featured);
                                    @endphp
                                    <tr class="{{ $data->id }}">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $featured_info->post_type }}</td>
                                        <td>
                                            @if($featured_info -> post_image != NULL)
                                                <img width="50" src="{{ URL::to('/') }}/media/posts/{{ $featured_info -> post_image }}" alt="">
                                            @elseif($featured_info -> post_gallery != NULL)
                                                <img width="50" src="{{ URL::to('/') }}/media/posts/{{ $featured_info -> post_gallery[0] }}" alt="">
                                            @elseif($featured_info->post_video != NULL)
                                                <iframe width="50" height="50" src="{{ $featured_info->post_video }}" frameborder="0"></iframe>
                                            @elseif($featured_info->post_audio != NULL)
                                                <iframe width="50" height="50" src="{{ $featured_info->post_audio }}" frameborder="0"></iframe>
                                            @endif
                                        </td>
                                        <td>{{ $data->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" post_id="{{ $data->id }}" class="custom-control-input post_status" {{ ($data->status == true)? 'checked="checked"' : '' }} id="customSwitch_{{ $loop->index+1 }}">
                                                <label class="custom-control-label" for="customSwitch_{{ $loop->index+1 }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a title="View" id="Post_view" post_view="{{ $data->id }}" class="btn btn-sm btn-info" href="#" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a title="Edit" href="{{ route('post.edit', $data->id) }}" id="manage_post_type" class="btn btn-sm btn-warning"><i class="fas fa-edit text-white"></i></a>
                                            <a title="Trash" class="btn btn-sm btn-danger" href="{{route('post.trash.update', $data->id)}}"><i class="fa fa-trash"></i></a>
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

    {{--    Post Details Modal--}}
    <div id="post_details_modal" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="m-auto">Single Post Information</h2>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover">
                        <tr id="p_type">
                            <td style="font-weight: bold" width="200">Post Type</td>
                            <td id="post_type"></td>
                        </tr>
                        <tr id="p_t">
                            <td style="font-weight: bold" width="200">Post Title</td>
                            <td id="post_title"></td>
                        </tr>
                        <tr id="p_s">
                            <td style="font-weight: bold" width="200">Post Slug</td>
                            <td id="post_slug"></td>
                        </tr>
                        <tr id="p_c">
                            <td style="font-weight: bold" width="200">Post Category</td>
                            <td id="post_category"></td>
                        </tr>
                        <tr id="p_tag">
                            <td style="font-weight: bold" width="200">Post Tag</td>
                            <td id="post_tag"></td>
                        </tr>
                        <tr id="p_sta">
                            <td style="font-weight: bold" width="200">Post Status</td>
                            <td id="post_status"></td>
                        </tr>
                        <tr id="p_i">
                            <td style="font-weight: bold" width="200">Post Image</td>
                            <td id="post_image"><img width="300" src="" alt=""></td>
                        </tr>
                        <tr id="p_g">
                            <td style="font-weight: bold" width="200">Post Gallery Image</td>
                            <td id="post_g_image"></td>
                        </tr>
                        <tr id="p_a">
                            <td style="font-weight: bold" width="200">Post Audio</td>
                            <td id="post_audio"></td>
                        </tr>
                        <tr id="p_v">
                            <td style="font-weight: bold" width="200">Post Video</td>
                            <td id="post_video"></td>
                        </tr>
                        <tr id="p_con">
                            <td style="font-weight: bold" width="200">Post Content</td>
                            <td id="post_content"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="close" style="float: right;" data-dismiss="modal" id="remove_gallary_image">&times;</button>
                </div>
            </div>
        </div>
    </div>
@endsection
