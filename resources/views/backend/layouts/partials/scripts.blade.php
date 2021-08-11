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
<!-- Select2 -->
<script src="{{ asset('backend/assets/plugins/') }}/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/assets/plugins/') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/jszip/jszip.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- CKEDITOR -->
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('backend/assets/plugins/') }}/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- jquery-validation -->
<script src="{{ asset('backend/assets/plugins/') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('backend/assets/plugins/') }}/jquery-validation/additional-methods.min.js"></script>

<!-- Icon Picker -->
<script src="{{ asset('backend/assets/dist/') }}/js/bootstrap-iconpicker.bundle.min.js"></script>
<script src="{{ asset('backend/assets/dist/') }}/js/bootstrap-iconpicker.js"></script>
<script src="{{ asset('backend/assets/dist/') }}/js/bootstrap-iconpicker.min.js"></script>
<script src="{{ asset('backend/assets/dist/') }}/js/bootstrap-iconpicker-iconset-all.js"></script>
<script src="{{ asset('backend/assets/dist/') }}/js/bootstrap-iconpicker-iconset-all.min.js"></script>

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
@if(session()->has('warning'))
    <script text="text/javascript">
        $(function(){
            $.notify("{{session()->get('warning')}}", {globalPosition: 'top right', className:'warning'});
        });
    </script>
@endif

<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>




