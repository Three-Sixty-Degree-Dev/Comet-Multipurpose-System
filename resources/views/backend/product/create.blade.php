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
                            <h1 class="m-0">Manage Products</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <form action="{{ route("product.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title">Add Product</h2>
                                        <input type="submit" class="btn btn-primary float-right" value="Save">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Product Name</label>
                                                    <input type="text" name="name" class="form-control">
                                                    <font style="color: red;">{{ ($errors->has('name'))? $errors->first('name') : '' }}</font>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Price</label>
                                                    <input type="number" name="price" class="form-control">
                                                    <font style="color: red;">{{ ($errors->has('price'))? $errors->first('price') : '' }}</font>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Sale Price</label>
                                                    <input type="number" name="sale_price" class="form-control">
                                                    <font style="color: red;">{{ ($errors->has('sale_price'))? $errors->first('sale_price') : '' }}</font>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Quantity</label>
                                                    <input type="number" name="quantity" class="form-control">
                                                    <font style="color: red;">{{ ($errors->has('quantity'))? $errors->first('quantity') : '' }}</font>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Description</label>
                                                    <textarea name="desc" id="" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Short Description</label>
                                                    <textarea name="short_desc" id="" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="checkbox" name="trends" value="trends" id="trends"><label for="trends">&nbsp; Make it trending product</label>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <div class="col-md-5">
                                <!-- Start Category -->
                                <div class="card">
                                    <div class="card-header" data-toggle="collapse" data-target="#product_category" aria-expanded="false"  aria-controls="product_category">
                                        <h2 class="card-title">Category</h2>
                                        <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                    </div>
                                    <div class="card-body cat_list collapse" id="product_category">
                                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <ul>
                                                    @foreach($all_cats as $cat1)
                                                        <li><input type="checkbox" name="cat[]" class="mr-1" value="{{ $cat1->id }}"><label for="{{ $cat1->id }}">{{ $cat1->name }}</label>

                                                            <ul>
                                                                @foreach($cat1->parentCat as $cat2)
                                                                    <li><input type="checkbox" name="cat[]" class="mr-1" value="{{ $cat2->id }}"><label for="{{ $cat2->id }}">{{ $cat2->name }}</label>
                                                                        <ul>
                                                                            @foreach($cat2->parentCat as $cat3)
                                                                                <li><input type="checkbox" name="cat[]" class="mr-1" value="{{ $cat3->id }}"><label for="{{ $cat3->id }}">{{ $cat3->name }}</label>
                                                                                    <ul>
                                                                                        @foreach($cat3->parentCat as $cat4)
                                                                                            <li><input type="checkbox" name="cat[]" class="mr-1" value="{{ $cat4->id }}"><label for="{{ $cat4->id }}">{{ $cat4->name }}</label>
                                                                                                <ul>
                                                                                                    @foreach($cat4->parentCat as $cat5)
                                                                                                        <li><input type="checkbox" name="cat[]" class="mr-1" value="{{ $cat5->id }}"><label for="{{ $cat5->id }}">{{ $cat5->name }}</label></li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Category -->

                                <!-- Start Tag -->
                                <div class="card">
                                    <div class="card-header" data-toggle="collapse" data-target="#product_tag" aria-expanded="false"  aria-controls="product_category">
                                        <h2 class="card-title">Tag</h2>
                                        <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                    </div>
                                    <div class="card-body collapse" id="product_tag">
                                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <select class="select2" name="tag[]" multiple="multiple" style="width: 100%;">
                                                    @foreach($all_tags as $tag)
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tag -->

                                <!-- Start Brand -->
                                <div class="card">
                                    <div class="card-header" data-toggle="collapse" data-target="#product_brand" aria-expanded="false"  aria-controls="product_category">
                                        <h2 class="card-title">Brand</h2>
                                        <span class="accicon"><i class="fas fa-angle-down rotate-icon"></i></span>
                                    </div>
                                    <div class="card-body collapse" id="product_brand">
                                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                                <select class="select2 form-control" name="brand">
                                                    <option value="">-Select-</option>
                                                    @foreach($all_brnd as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Brand -->


                                <!-- Start Image -->
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title">Product Images</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="file" name="images[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Image -->


                                <!-- CHeck Variable Product Add Or Not -->
                                <input type="checkbox" value="variables" class="mr-1 v_b" id="variable_box"><label for="variable_box">Variable Option</label>

                                <div class="v_box">
                                    <!-- Start Size -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h2 class="card-title">Product Size</h2>
                                        </div>
                                        <div class="card-body">
                                            <button class="btn btn-primary btn-sm mb-1" id="add_p_size">Add Size</button>

                                            <div class="p_size_box">
                                            
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Size -->

                                    <!-- Start Color -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h2 class="card-title">Product Color</h2>
                                        </div>
                                        <div class="card-body">
                                            <button class="btn btn-primary btn-sm mb-1" id="add_p_color">Add Color</button>

                                            <div class="p_color_box">
                                            
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Color -->
                                </div>

                            </div>

                        </div>
                    </form>


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
