<!DOCTYPE html>
<html lang="en">
@include('frontend.blog.layouts.head')
<body>
<!-- Preloader-->
{{--<div id="loader">--}}
{{--    <div class="centrize">--}}
{{--        <div class="v-center">--}}
{{--            <div id="mask">--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--                <span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- End Preloader-->
<!-- Navigation Bar-->
@include('frontend.blog.layouts.header')
<!-- End Navigation Bar-->
@section('main-content')
@show
<!-- Footer-->
@include('frontend.blog.layouts.footer')
<!-- end of footer-->
@include('frontend.blog.layouts.partials.scripts')
</body>
</html>
