(function ($){
    $(document).ready(function (){
        //admin logout features
        $(document).on('click', '#logout_btn', function (event){
            event.preventDefault();
            $('#logout_form').submit();
        });

        //Category Status
        $(document).on('click', 'input.cust_ststus', function (){
            let checked = $(this).attr('checked');
            let id = $(this).attr('category_id');

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

        //Tag Status
        $(document).on('click', 'input.tag_status', function (){
            let checked = $(this).attr('checked');
            let id = $(this).attr('tag_id');

            if(checked == 'checked'){
                $.ajax({
                    url:'tag/status-inactive/'+id,
                    success: function (data){
                        $.notify('Tag inactive successfully!', {globalPosition: 'top right', className:'success'});
                    }
                });
            }else {
                $.ajax({
                    url:'tag/status-active/'+id,
                    success: function (data){
                        $.notify('Tag active successfully!', {globalPosition: 'top right', className:'success'});
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

        //Category edit
        $('.edit_cats').click(function(e){
            e.preventDefault();
            let id = $(this).attr('edit_id');

            $.ajax({
                url: 'category/' +id+ '/edit',
                success: function(data){
                    $('#edit_category_modal form input[name="id"]').val(data.id);
                    $('#edit_category_modal form input[name="name"]').val(data.name);
                    $('#edit_category_modal').modal('show');
                }
            });
        });

        //Tag edit
        $('.edit_tag').click(function(e){
            e.preventDefault();
            let id = $(this).attr('edit_id');

            $.ajax({
                url: 'tag/' +id+ '/edit',
                success: function(data){
                    $('#edit_tag_modal form input[name="id"]').val(data.id);
                    $('#edit_tag_modal form input[name="name"]').val(data.name);
                    $('#edit_tag_modal').modal('show');
                }
            });
        });

    });
})(jQuery);
