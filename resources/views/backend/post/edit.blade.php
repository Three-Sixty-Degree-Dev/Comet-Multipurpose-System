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
                                <li class="breadcrumb-item active">Posts/ Edit</li>
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
                            <h2 class="card-title">Edit Posts</h2>
                            <a class="btn btn-sm btn-primary float-right" href="{{ route('index') }}" ><i class="fas fa-list"> Post List</i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('post.update', $data->id) }}" method="POST" enctype="multipart/form-data" class="postValidate">
                                @csrf
                                @method('PATCH')
                                @php
                                    $featured = json_decode($data->featured);
                                @endphp
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Post Format</label>
                                        <select name="post_type" id="post_format" class="form-control">
                                            <option value="">--Select--</option>
                                            <option value="Image" {{ ($featured->post_type == 'Image')? 'selected': ''  }}>Image</option>
                                            <option value="Gallery" {{ ($featured->post_type == 'Gallery')? 'selected': ''  }}>Gallery</option>
                                            <option value="Audio" {{ ($featured->post_type == 'Audio')? 'selected': ''  }}>Audio</option>
                                            <option value="Video" {{ ($featured->post_type == 'Video')? 'selected': ''  }}>Video</option>
                                        </select>
                                        <font style="color: red;">{{ ($errors->has('post_type'))? $errors->first('post_type') : '' }}</font>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Post Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $data->title }}">
                                        <font style="color: red;">{{ ($errors->has('title'))? $errors->first('title') : '' }}</font>
                                    </div>
                                    @php
                                        $selected_category = $data->categories;
                                        $select_category = [];
                                        foreach ($selected_category as $value) {
                                            array_push($select_category, $value->id);
                                        }
                                    @endphp
                                    <div class="form-group col-md-6">
                                        <label for="">Category</label>
                                        <select class="select2" name="category[]" multiple="multiple" style="width: 100%;">
                                            @foreach($all_cats as $category)
                                                <option value="{{ $category->id }}"  {{ (in_array($category->id, $select_category))? 'selected': ''  }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php
                                        $selected_tag = $data->tags;
                                        $select_tag = [];
                                        foreach ($selected_tag as $value) {
                                            array_push($select_tag, $value->id);
                                        }
                                    @endphp
                                    <div class="form-group col-md-6">
                                        <label for="">Tag</label>
                                        <select class="select2" name="tag[]" multiple="multiple" style="width: 100%;">
                                            @foreach($all_tags as $tag)
                                                <option value="{{ $tag->id }}"  {{ (in_array($tag->id, $select_tag))? 'selected': ''  }}>{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 post_image">
                                        <img id="post_image_load" style="width: 400px;" src="{{ URL::to('/') }}/media/posts/{{ $featured->post_image }}" class="d-block" alt="">
                                        <label for="post_image"><img style="width: 100px; cursor: pointer;" src="{{ URL::to('/') }}/backend/assets/dist/img/image-file.png" alt=""></label>
                                        <input type="file" name="post_image" class="form-control d-none" id="post_image">
                                    </div>
                                    <div class="form-group col-md-12 post_image_g">
                                        <div class="post_gallery_image">
                                            @foreach($featured->post_gallery as $gallery)
                                                <img width="200" src="{{ URL::to('/') }}/media/posts/{{ $gallery }}" alt="">
                                            @endforeach
                                        </div>
                                        <br>
                                        <br>
                                        <label for="post_image_g"><img style="width: 100px; cursor: pointer;" src="{{ URL::to('/') }}/backend/assets/dist/img/image-file.png" alt=""></label>
                                        <input type="file" name="post_gallery_image[]" class="form-control d-none" id="post_image_g" multiple>
                                    </div>
                                    <div class="form-group col-md-12 post_image_a">
                                        <label for="">Post Audio Link</label>
                                        <input type="text" name="post_audio" class="form-control" value="{{ $featured->post_audio }}">
                                        <font style="color: red;">{{ ($errors->has('post_audio'))? $errors->first('post_audio') : '' }}</font>
                                    </div>
                                    <div class="form-group col-md-12 post_image_v">
                                        <label for="">Post Video Link</label>
                                        <input type="text" name="post_video" class="form-control" value="{{ $featured->post_video }}">
                                        <font style="color: red;">{{ ($errors->has('post_video'))? $errors->first('post_video') : '' }}</font>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="content" id="content">{{ $data->content }}</textarea>
                                        <font style="color: red;">{{ ($errors->has('content'))? $errors->first('content') : '' }}</font>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="submit" class="btn btn-primary float-right mt-4" value="Submit">
                                    </div>
                                </div>
                            </form>
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

    <!--   jquery Validation-->
    <script>
        $(function () {
            $('.postValidate').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    content: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: "Please insert title",
                    },
                    content: {
                        required: "Please insert post content",
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
