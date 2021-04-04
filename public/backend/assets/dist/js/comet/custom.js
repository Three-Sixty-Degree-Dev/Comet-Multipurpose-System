(function ($){
    $(document).ready(function (){
        //admin logout features
        $(document).on('click', '#logout_btn', function (event){
            event.preventDefault();
            $('#logout_form').submit();
        });

        //Customer Status
        $(document).on('click', 'input.cust_ststus', function (){
            let checked = $(this).attr('checked');
            let id = $(this).attr('customer_id');

            if(checked == 'checked'){
                $.ajax({
                    url:'category/status-inactive/'+id,
                    success: function (data){
                        $.notify('Category inactive successfully!', {globalPosition: 'top right', className:'success'});
                    }
                });
            }else {
                $.ajax({
                    url:'category/status-active/'+id,
                    success: function (data){
                        $.notify('Category active successfully!', {globalPosition: 'top right', className:'success'});
                    }
                });
            }
        });

        //sweetalert wise delete
        $(document).on('click', '.delete', function(){
            var actionTo = $(this).attr('href');
            var token = $(this).attr('data-token');
            var id = $(this).attr('data-id');

            swal({
                    title: "Are you sure?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if(isConfirm){
                        $.ajax({
                            url:actionTo,
                            type: 'post',
                            data: {id:id, _token:token},
                            success: function(data){
                                swal({
                                        title: "Deleted!",
                                        type: "success"
                                    },
                                    function(isConfirm){
                                        if(isConfirm){
                                            $('.' + id).fadeOut();
                                        }
                                    });
                            }
                        });
                    }else {
                        swal("Cancelled", "", "error");
                    }
                });
            return false;
        });
    });
})(jQuery);
