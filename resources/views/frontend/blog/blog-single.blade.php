@extends('frontend.blog.layouts.app')

@section('page-title', $data->title)


@section('main-content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <article class="post-single">
                    <div class="post-info text-center">
                        <h2><a href="#">{{ $data->title }}</a></h2>
                        <h6 class="upper"><span>By</span><a href="{{ route('single.user.blog', @$data->user->id) }}">
                                {{ $data->user->name }}</a><span
                                class="dot"></span><span>{{ date('d, F, Y', strtotime($data->created_at)) }}</span><span
                                class="dot"></span>
                            @foreach($data->categories as $category)
                            <a href="{{ route('blog.category.wise.search', $category->slug) }}"
                                class="post-tag">{{ $category->name }}</a> ,
                            @endforeach
                        </h6>
                    </div>

                    @php
                    $media_data = json_decode($data->featured);
                    @endphp


                    @if($media_data->post_type == 'Image')
                    <div class="post-media">
                        @section('page-image', $media_data->post_image)
                        <a href="#">
                            <img src="{{ URL::to('/') }}/media/posts/{{ $media_data->post_image }}" alt="">
                        </a>
                    </div>
                    @endif

                    @if($media_data->post_type == 'Gallery')
                    <div class="post-media">
                        <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true"
                            class="flexslider nav-outside">
                            <ul class="slides">
                                @foreach($media_data->post_gallery as $gallery)
                                <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;"
                                    class="flex-active-slide">
                                    @section('page-image', $gallery)
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
                            <iframe src="{{ $media_data->post_audio }}" frameborder="0"></iframe>
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
                        {!! htmlspecialchars_decode($data->content) !!}
                    </div>
                </article>



                <!-- end of article-->
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}<button class="close" data-dismiss="alert">&times;</button></p>
                @endif
                <div id="comments">
                    <h5 class="upper">3 Comments</h5>
                    <ul class="comments-list">

                        @foreach($data->comments as $comment)

                            @if($comment->comment_id == NULL)
                                <li>
                                    <div class="comment">
                                        <div class="comment-pic">
                                            <img src="{{ asset('frontend/assets/images/team/1.jpg') }}" alt="" class="img-circle">
                                        </div>
                                        <div class="comment-text">
                                            <h5 class="upper">{{ $comment->user->name }}</h5><span class="comment-date">Posted on {{ date('d F, Y', strtotime($comment->created_at)) }} at {{ date('h:i a') }}</span>
                                            <p>{{ $comment->text }}</p>

                                            @guest

                                                <p>For replay please <a href="{{ route('admin.login') }}">login</a> first</p>

                                            @else

                                            <a href="#" c_id="{{ $comment->id }}" class="comment-reply reply-box-btn">Reply</a>

                                            <!--Reply form-->
                                            <form class="reply-box reply-box-{{ $comment->id }}" action="{{ route('blog.post.reply-comment') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="post_id" value="{{ $data->id }}">
                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                    <textarea placeholder="Comment" name="reply_comment" class="form-control"></textarea>
                                                </div>
                                                <div class="form-submit text-right">
                                                    <button type="submit" class="btn btn-color-out">Reply</button>
                                                </div>
                                            </form>
                                            <!--!Reply form-->
                                            @endguest


                                        </div>
                                    </div>

                                    <?php

                                        $comments = App\Models\Comment::where('comment_id', '!=', null)->where('comment_id', $comment->id)->get();

                                    ?>

                                    @foreach($comments as $rep_com)
                                    <ul class="children">
                                            <li>
                                                <div class="comment">
                                                    <div class="comment-pic">
                                                        <img src="images/team/2.jpg" alt="" class="img-circle">
                                                    </div>
                                                    <div class="comment-text">
                                                        <h5 class="upper">Arya Stark</h5><span class="comment-date">Posted on 29
                                                            September at 10:41</span>
                                                        <p>{{ $rep_com->text }}</p><a href="#" class="comment-reply">Reply</a>
                                                    </div>
                                                </div>
                                            </li>
                                    </ul>
                                    @endforeach


                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
                <!-- end of comments-->



                @guest

                <p>Please <a href="{{ route('admin.login') }}">login</a> first before place a comments</p>

                @else
                <div id="respond">
                    <h5 class="upper">Leave a comment</h5>
                    <div class="comment-respond">
                        <form class="comment-form" action="{{ route('blog.post.comment') }}" method="POST">
                            @csrf
                            {{-- <div class="form-double">
                                <div class="form-group">
                                    <input name="author" type="text" placeholder="Name" class="form-control">
                                </div>
                                <div class="form-group last">
                                    <input name="email" type="text" placeholder="Email" class="form-control">
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <input type="hidden" name="post_id" value="{{ $data->id }}">
                                <textarea placeholder="Comment" name="comment" class="form-control"></textarea>
                            </div>
                            <div class="form-submit text-right">
                                <button type="submit" class="btn btn-color-out">Post Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endguest
                <!-- end of comment form-->




            </div>
        </div>
    </div>
</section>
@endsection
