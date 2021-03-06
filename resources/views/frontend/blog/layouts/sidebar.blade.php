<div class="col-md-3 col-md-offset-1">
    <div class="sidebar hidden-sm hidden-xs">
        <div class="widget">
            <h6 class="upper">Search blog</h6>
            <form action="{{ route('blog.search') }}" method="POST">
                @csrf
                <input type="text" name="search" placeholder="Search.." class="form-control" autocomplete="off">
            </form>
        </div>
        <!-- end of widget        -->
        <div class="widget">
            <h6 class="upper">Categories</h6>
            <ul class="nav">
                @php
                    $categories = App\Models\Category::withCount('posts')->where('status', true)->where('trash', false)->take(7)->latest()->get();
                @endphp
                @foreach($categories as $category)
                   @if($category->posts_count > 0)
                     <li>
                         <a href="{{ route('blog.category.wise.search', $category->slug) }}">{{ $category->name }}{{ " " }}{{ "( " }}{{ $category->posts_count }}{{ " )" }}</a>
                     </li>
                    @endif
                @endforeach


            </ul>
        </div>
        <!-- end of widget        -->
        <div class="widget">
            <h6 class="upper">Popular Tags</h6>
            <div class="tags clearfix">
                @php
                    $tags = App\Models\Tag::withCount('posts')->where('status', true)->where('trash', false)->take(7)->latest()->get();
                @endphp
                @foreach($tags as $tag)
                    @if($tag->posts_count > 0)
                        <a href="{{ route('blog.tag.wise.search', $tag->slug) }}">{{ $tag->name }}{{ " " }}{{ "( " }}{{ $tag->posts_count }}{{ " )" }}</a>
                    @endif
                @endforeach

            </div>
        </div>
        <!-- end of widget      -->
        <div class="widget">
            <h6 class="upper">Popular Posts</h6>
            <ul class="nav">
                @php
                    $posts = App\Models\Post::where('status', true)->where('trash', false)->orderBy('views', 'desc')->take(5)->latest()->get();
                @endphp
                @foreach($posts as $post)
                <li><a href="{{ route('single.blog.page', $post->slug) }}">{{ $post->title }}<i class="ti-arrow-right"></i><span>{{ date('d M, Y', strtotime($post->created_at)) }}</span></a>
                </li>
                @endforeach

            </ul>
        </div>
        <!-- end of widget          -->
    </div>
    <!-- end of sidebar-->
</div>
