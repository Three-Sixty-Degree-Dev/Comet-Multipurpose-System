@extends('frontend.blog.layouts.app')

@section('main-content')
<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="{{ asset('frontend/assets/images/') }}/bg/18.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
        <div class="centrize">
            <div class="v-center">
                <div class="container">
                    <div class="title center">
                        <h1 class="upper">This is our blog<span class="red-dot"></span></h1>
                        <h4>We have a few tips for you.</h4>
                        <hr>
                    </div>
                </div>
                <!-- end of container-->
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-posts">

                    @foreach($all_data as $data)
                        @php
                            $media_data = json_decode($data->featured);
                        @endphp
                        <article class="post-single">
                            <div class="post-info">
                                <h2><a href="#">{{ $data->title }}</a></h2>
                                <h6 class="upper"><span>By</span><a href="#"> {{ @$data->author->name }}</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Startups</a></h6>
                            </div>

                            @if($media_data->post_type == 'Image')
                                <div class="post-media">
                                    <a href="#">
                                        <img src="{{ URL::to('/') }}/media/posts/{{ $media_data->post_image }}" alt="">
                                    </a>
                                </div>
                            @endif

                            @if($media_data->post_type == 'Gallery')
                                <div class="post-media">
                                    <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
                                        <ul class="slides">
                                            @foreach($media_data->post_gallery as $gallery)
                                            <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;" class="flex-active-slide">
                                                <img src="{{ URL::to('/') }}/media/posts/{{ $gallery }}" alt="" draggable="false">
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="post-body">
                                <p>
                                    {!! Str::of(htmlspecialchars_decode($data->content))->words('50', '<span style="color: red;"> >>></span>') !!}
                                </p>
                                <p><a href="#" class="btn btn-color btn-sm">Read More</a>
                                </p>
                            </div>
                        </article>
                    @endforeach

                    <!-- end of article-->
                </div>


                {{ $all_data->links('pagination::bootstrap-4') }}


                <ul class="pagination">
                    <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a>
                    </li>
                    <li class="active"><a href="#">1</a>
                    </li>
                    <li><a href="#">2</a>
                    </li>
                    <li><a href="#">3</a>
                    </li>
                    <li><a href="#">4</a>
                    </li>
                    <li><a href="#">5</a>
                    </li>
                    <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a>
                    </li>
                </ul>
                <!-- end of pagination-->


            </div>
            <div class="col-md-3 col-md-offset-1">
                <div class="sidebar hidden-sm hidden-xs">
                    <div class="widget">
                        <h6 class="upper">Search blog</h6>
                        <form>
                            <input type="text" placeholder="Search.." class="form-control">
                        </form>
                    </div>
                    <!-- end of widget        -->
                    <div class="widget">
                        <h6 class="upper">Categories</h6>
                        <ul class="nav">
                            <li><a href="#">Fashion</a>
                            </li>
                            <li><a href="#">Tech</a>
                            </li>
                            <li><a href="#">Gaming</a>
                            </li>
                            <li><a href="#">Food</a>
                            </li>
                            <li><a href="#">Lifestyle</a>
                            </li>
                            <li><a href="#">Money</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end of widget        -->
                    <div class="widget">
                        <h6 class="upper">Popular Tags</h6>
                        <div class="tags clearfix"><a href="#">Design</a><a href="#">Fashion</a><a href="#">Startups</a><a href="#">Tech</a><a href="#">Web</a><a href="#">Lifestyle</a>
                        </div>
                    </div>
                    <!-- end of widget      -->
                    <div class="widget">
                        <h6 class="upper">Latest Posts</h6>
                        <ul class="nav">
                            <li><a href="#">Checklists for Startups<i class="ti-arrow-right"></i><span>30 Sep, 2015</span></a>
                            </li>
                            <li><a href="#">The Death of Thought<i class="ti-arrow-right"></i><span>29 Sep, 2015</span></a>
                            </li>
                            <li><a href="#">Give it five minutes<i class="ti-arrow-right"></i><span>24 Sep, 2015</span></a>
                            </li>
                            <li><a href="#">Uber launches in Las Vegas<i class="ti-arrow-right"></i><span>20 Sep, 2015</span></a>
                            </li>
                            <li><a href="#">Fun with Product Hunt<i class="ti-arrow-right"></i><span>16 Sep, 2015</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- end of widget          -->
                </div>
                <!-- end of sidebar-->
            </div>
        </div>
        <!-- end of row-->
    </div>
    <!-- end of container-->
</section>
@endsection
