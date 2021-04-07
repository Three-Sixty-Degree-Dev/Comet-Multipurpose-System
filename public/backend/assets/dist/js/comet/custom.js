(function ($){
    $(document).ready(function (){
        //admin logout features
        $(document).on('click', '#logout_btn', function (event){
            event.preventDefault();
            $('#logout_form').submit();
        });

        //CKEDITOR
        CKEDITOR.replace('content');

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

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

        //Post Status
        $(document).on('click', 'input.post_status', function (){
            let checked = $(this).attr('checked');
            let id = $(this).attr('post_id');

            if(checked == 'checked'){
                $.ajax({
                    url:'post/status-inactive/'+id,
                    success: function (data){
                        $.notify('Post inactive successfully!', {globalPosition: 'top right', className:'success'});
                    }
                });
            }else {
                $.ajax({
                    url:'post/status-active/'+id,
                    success: function (data){
                        $.notify('Post active successfully!', {globalPosition: 'top right', className:'success'});
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

        //post image script
        $('#post_image').change(function (e){
            let image_uld = URL.createObjectURL(e.target.files[0]);
            $('#post_image_load').attr('src', image_uld);
        });

        //post gallery image script
        $('#post_image_g').change(function (e){

            let post_gallery_url = '';
            for(let i=0; i<e.target.files.length; i++){
                let gallery_url = URL.createObjectURL(e.target.files[i])
                post_gallery_url += '<img class="shadow" src="'+gallery_url+'" />'
            }
            $('.post_gallery_image').html(post_gallery_url);

        });

        //select post format script
        $('#post_format').change(function (e){
            let format = $(this).val();

            if(format == "Image"){
                $('.post_image').show();
            }else {
                $('.post_image').hide();
            }

            if(format == "Gallery"){
                $('.post_image_g').show();
            }else {
                $('.post_image_g').hide();
            }

            if(format == "Audio"){
                $('.post_image_a').show();
            }else {
                $('.post_image_a').hide();
            }

            if(format == "Video"){
                $('.post_image_v').show();
            }else {
                $('.post_image_v').hide();
            }

        });

        //single post view
        $(document).on('click', '#Post_view', function (event){
            event.preventDefault();
            const id = $(this).attr('post_view');

            $.ajax({
                url: 'post/single-view/'+id,
                success: function (data){
                    $('#post_details_modal #post_title').html(data.title);
                    $('#post_details_modal #post_slug').html(data.slug);
                    $('#post_details_modal #post_status').html(data.status);
                    $('#post_details_modal #post_content').html(data.content);
                    $('#post_details_modal #post_image img').attr('src', '/media/posts/' +data.post_image);
                    for (const gallery of data.post_gallery) {
                        $('#post_details_modal #post_g_image').append('' +
                            '<span class="gallery_image"><img width="100" style="margin: 5px;" src="/media/posts/'+gallery+'" alt=""></span>');
                    }
                    $('#post_details_modal #post_audio').html(data.post_audio);
                    $('#post_details_modal #post_video').html(data.post_video);

                    $('#post_details_modal').modal('show');
                }
            });

        });

        // post gallery image problem solve
        $(document).on('click', '#remove_gallary_image', function (event){
            event.preventDefault();
            $('.gallery_image').remove();
        });

    });
})(jQuery);
