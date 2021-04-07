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
                    <article class="post-single">
                        <div class="post-info">
                            <h2><a href="#">Checklists for Startups</a></h2>
                            <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Startups</a></h6>
                        </div>
                        <div class="post-media">
                            <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
                                <ul class="slides">
                                    <li>
                                        <img src="{{ asset('frontend/assets/images/') }}/blog/1.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="{{ asset('frontend/assets/images/') }}/blog/2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="{{ asset('frontend/assets/images/') }}/blog/3.jpg" alt="">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="post-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae
                                possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>
                            <p><a href="#" class="btn btn-color btn-sm">Read More</a>
                            </p>
                        </div>
                    </article>
                    <!-- end of article-->
                    <article class="post-single">
                        <div class="post-info">
                            <h2><a href="#">Never Tell People What You Do</a></h2>
                            <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Entrepreneurship</a></h6>
                        </div>
                        <div class="post-media">
                            <div class="media-video">
                                <iframe src="https://www.youtube.com/embed/rrT6v5sOwJg" frameborder="0"></iframe>
                            </div>
                        </div>
                        <div class="post-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae
                                possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>
                            <p><a href="#" class="btn btn-color btn-sm">Read More</a>
                            </p>
                        </div>
                    </article>
                    <!-- end of article-->
                    <article class="post-single">
                        <div class="post-info">
                            <h2><a href="#">Give It Five Minutes</a></h2>
                            <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Startups</a></h6>
                        </div>
                        <div class="post-body">
                            <blockquote class="italic">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et quam neque facilis similique laborum, nihil id ratione, error illum. Porro quas maxime accusamus numquam consequatur consequuntur eveniet quis, fuga repellendus.</p>
                            </blockquote>
                        </div>
                    </article>
                    <!-- end of article-->
                    <article class="post-single">
                        <div class="post-info">
                            <h2><a href="#">Uber Launches in Las Vegas</a></h2>
                            <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Startups</a></h6>
                        </div>
                        <div class="post-media">
                            <a href="#">
                                <img src="{{ asset('frontend/assets/images/') }}/blog/4.jpg" alt="">
                            </a>
                        </div>
                        <div class="post-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae
                                possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>
                            <p><a href="#" class="btn btn-color btn-sm">Read More</a>
                            </p>
                        </div>
                    </article>
                    <!-- end of article-->
                    <article class="post-single">
                        <div class="post-info">
                            <h2><a href="#">Fun With Product Hunt</a></h2>
                            <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Tech</a></h6>
                        </div>
                        <div class="post-media">
                            <div class="media-audio">
                                <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/51057943&amp;amp;color=ff5500&amp;amp;auto_play=false&amp;amp;hide_related=false&amp;amp;show_comments=true&amp;amp;show_user=true&amp;amp;show_reposts=false"
                                        frameborder="0"></iframe>
                            </div>
                        </div>
                        <div class="post-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae
                                possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>
                            <p><a href="#" class="btn btn-color btn-sm">Read More</a>
                            </p>
                        </div>
                    </article>
                    <!-- end of article-->
                </div>
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
