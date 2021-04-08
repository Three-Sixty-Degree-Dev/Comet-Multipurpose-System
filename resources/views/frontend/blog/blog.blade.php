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
                                <h6 class="upper"><span>By</span><a href="#"> {{ @$data->user->name }}</a><span class="dot"></span><span>{{ date('d F, Y', strtotime($data->created_at)) }}</span><span class="dot"></span><a href="#" class="post-tag">Startups</a></h6>
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

                            @if($media_data->post_type == 'Audio')
                                <div class="post-media">
                                    <div class="media-audio">
                                        <iframe src="{{ $media_data->post_audio }}"
                                                frameborder="0"></iframe>
                                    </div>
                                </div>
                            @endif

                            @if($media_data->post_type == 'Video')
                            <div class="post-media">
                                <div class="media-video">
                                    <iframe src="{{ $media_data->post_video }}" frameborder="0"></iframe>
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
            @include('frontend.blog.layouts.sidebar')
        </div>
        <!-- end of row-->
    </div>
    <!-- end of container-->
</section>
@endsection
