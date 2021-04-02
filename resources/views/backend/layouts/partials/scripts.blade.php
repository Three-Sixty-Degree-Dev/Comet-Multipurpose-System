<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/assets/plugins/') }}/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/assets/plugins/') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/assets/plugins/') }}/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/assets/plugins/') }}/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('backend/assets/plugins/') }}/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/assets/plugins/') }}/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/assets/plugins/') }}/moment/moment.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/assets/plugins/') }}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('backend/assets/plugins/') }}/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/assets/plugins/') }}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/assets/dist/') }}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/assets/dist/') }}/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/assets/dist/') }}/js/pages/dashboard.js"></script>
<!-- Comet Custom JS -->
<script src="{{ asset('backend/assets/dist/') }}/js/comet/custom.js"></script>

<!-- notify -->
@if(session()->has('success'))
    <script text="text/javascript">
        $(function(){
            $.notify("{{session()->get('success')}}", {globalPosition: 'top right', className:'success'});
        });
    </script>
@endif
@if(session()->has('error'))
    <script text="text/javascript">
        $(function(){
            $.notify("{{session()->get('error')}}", {globalPosition: 'top right', className:'error'});
        });
    </script>
@endif

{{--Toster Notification--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
