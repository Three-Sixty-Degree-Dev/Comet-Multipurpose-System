(function($) {
    $(document).ready(function() {
        //admin logout features
        $(document).on("click", "#logout_btn", function(event) {
            event.preventDefault();
            $("#logout_form").submit();
        });

        //CKEDITOR
        CKEDITOR.replace("content");

        //Initialize Select2 Elements
        $(".select2").select2();

        //Initialize Select2 Elements
        $(".select2bs4").select2({
            theme: "bootstrap4"
        });

        //Category Status
        $(document).on("click", "input.cust_ststus", function() {
            let checked = $(this).attr("checked");
            let id = $(this).attr("category_id");

            if (checked == "checked") {
                $.ajax({
                    url: "category/status-inactive/" + id,
                    success: function(data) {
                        $.notify("Category inactive successfully!", {
                            globalPosition: "top right",
                            className: "success"
                        });
                    }
                });
            } else {
                $.ajax({
                    url: "category/status-active/" + id,
                    success: function(data) {
                        $.notify("Category active successfully!", {
                            globalPosition: "top right",
                            className: "success"
                        });
                    }
                });
            }
        });

        //Tag Status
        $(document).on("click", "input.tag_status", function() {
            let checked = $(this).attr("checked");
            let id = $(this).attr("tag_id");

            if (checked == "checked") {
                $.ajax({
                    url: "tag/status-inactive/" + id,
                    success: function(data) {
                        $.notify("Tag inactive successfully!", {
                            globalPosition: "top right",
                            className: "success"
                        });
                    }
                });
            } else {
                $.ajax({
                    url: "tag/status-active/" + id,
                    success: function(data) {
                        $.notify("Tag active successfully!", {
                            globalPosition: "top right",
                            className: "success"
                        });
                    }
                });
            }
        });

        //Post Status
        $(document).on("click", "input.post_status", function() {
            let checked = $(this).attr("checked");
            let id = $(this).attr("post_id");

            if (checked == "checked") {
                $.ajax({
                    url: "post/status-inactive/" + id,
                    success: function(data) {
                        $.notify("Post inactive successfully!", {
                            globalPosition: "top right",
                            className: "success"
                        });
                    }
                });
            } else {
                $.ajax({
                    url: "post/status-active/" + id,
                    success: function(data) {
                        $.notify("Post active successfully!", {
                            globalPosition: "top right",
                            className: "success"
                        });
                    }
                });
            }
        });

        //sweetalert wise delete
        $(document).on("click", ".delete", function() {
            var actionTo = $(this).attr("href");
            var token = $(this).attr("data-token");
            var id = $(this).attr("data-id");

            swal(
                {
                    title: "Are you sure?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: actionTo,
                            type: "post",
                            data: { id: id, _token: token },
                            success: function(data) {
                                swal(
                                    {
                                        title: "Deleted!",
                                        type: "success"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            $("." + id).fadeOut();
                                        }
                                    }
                                );
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                }
            );
            return false;
        });

        //Category edit
        $(".edit_cats").click(function(e) {
            e.preventDefault();
            let id = $(this).attr("edit_id");

            $.ajax({
                url: "category/" + id + "/edit",
                success: function(data) {
                    $('#edit_category_modal form input[name="id"]').val(
                        data.id
                    );
                    $('#edit_category_modal form input[name="name"]').val(
                        data.name
                    );
                    $("#edit_category_modal").modal("show");
                }
            });
        });

        //Tag edit
        $(".edit_tag").click(function(e) {
            e.preventDefault();
            let id = $(this).attr("edit_id");

            $.ajax({
                url: "tag/" + id + "/edit",
                success: function(data) {
                    $('#edit_tag_modal form input[name="id"]').val(data.id);
                    $('#edit_tag_modal form input[name="name"]').val(data.name);
                    $("#edit_tag_modal").modal("show");
                }
            });
        });

        //post image script
        $("#post_image").change(function(e) {
            let image_uld = URL.createObjectURL(e.target.files[0]);
            $("#post_image_load").attr("src", image_uld);
        });

        //post gallery image script
        // $('#post_image_g').change(function (e){
        //
        //     let post_gallery_url = '';
        //     for(let i=0; i<e.target.files.length; i++){
        //         let gallery_url = URL.createObjectURL(e.target.files[i])
        //         post_gallery_url += '<img class="shadow" src="'+gallery_url+'" />'
        //     }
        //     $('.post_gallery_image').html(post_gallery_url);
        //
        // });

        $("#post_image_g").change(function(e) {
            const image_length = e.target.files.length;
            for (var i = 0; i < image_length; i++) {
                const image_url = URL.createObjectURL(e.target.files[i]);
                const image_tag = $(
                    $.parseHTML('<img class="appendedImg">')
                ).attr("src", image_url);
                const image_surrent_div = $(
                    $.parseHTML('<div class="shadow imgHolder"></div>')
                ).html(image_tag);
                image_surrent_div.append(
                    '<span class="closeIT_removeImg">x</span>'
                );
                $(".post_gallery_image").append(image_surrent_div);

                setTimeout(function() {
                    const closeIT_removeImg = document.getElementsByClassName(
                        "closeIT_removeImg"
                    );
                    arrayFromCloseBtn = [...closeIT_removeImg];
                    arrayFromCloseBtn.forEach(onebyone => {
                        onebyone.addEventListener("click", function(e) {
                            if (e.target.classList[0] == "closeIT_removeImg") {
                                const closeIT_removeImg = e.target;
                                closeIT_removeImg.parentElement.remove();
                            }
                        });
                    });
                }, 500);
            }
        });

        //Edit gallery image
        $(".closeIT_removeImg").click(function() {
            const closeIT_removeImg = document.getElementsByClassName(
                "closeIT_removeImg"
            );
            arrayFromCloseBtn = [...closeIT_removeImg];
            arrayFromCloseBtn.forEach(onebyone => {
                onebyone.addEventListener("click", function(e) {
                    if (e.target.classList[0] == "closeIT_removeImg") {
                        const closeIT_removeImg = e.target;
                        closeIT_removeImg.parentElement.remove();
                    }
                });
            });
        });

        //select post format script
        $("#post_format").change(function(e) {
            let format = $(this).val();

            if (format == "Image") {
                $(".post_image").show();
            } else {
                $(".post_image").hide();
            }

            if (format == "Gallery") {
                $(".post_image_g").show();
            } else {
                $(".post_image_g").hide();
            }

            if (format == "Audio") {
                $(".post_image_a").show();
            } else {
                $(".post_image_a").hide();
            }

            if (format == "Video") {
                $(".post_image_v").show();
            } else {
                $(".post_image_v").hide();
            }
        });

        //Edit featured post script /select post format script
        let format = $("#post_format")
            .children("option:selected")
            .val();
        if (format == "Image") {
            $(".post_image").show();
        } else {
            $(".post_image").hide();
        }
        if (format == "Gallery") {
            $(".post_image_g").show();
        } else {
            $(".post_image_g").hide();
        }

        if (format == "Audio") {
            $(".post_image_a").show();
        } else {
            $(".post_image_a").hide();
        }

        if (format == "Video") {
            $(".post_image_v").show();
        } else {
            $(".post_image_v").hide();
        }

        //single post view
        $(document).on("click", "#Post_view", function(event) {
            event.preventDefault();
            const id = $(this).attr("post_view");

            $.ajax({
                url: "post/single-view/" + id,
                success: function(data) {
                    if (data.post_type != "") {
                        $("#p_type").show();
                        $("#post_details_modal #post_type").html(
                            data.post_type
                        );
                    } else {
                        $("#p_type").hide();
                    }

                    if (data.title != "") {
                        $("#p_t").show();
                        $("#post_details_modal #post_title").html(data.title);
                    } else {
                        $("#p_t").hide();
                    }

                    if (data.slug != "") {
                        $("#p_s").show();
                        $("#post_details_modal #post_slug").html(data.slug);
                    } else {
                        $("#p_s").hide();
                    }

                    if (data.categories != "") {
                        $("#p_c").show();
                        for (const category of data.categories) {
                            $("#post_details_modal #post_category").append(
                                "" +
                                    '<span class="select_category">' +
                                    category["name"] +
                                    "," +
                                    " " +
                                    "</span>"
                            );
                        }
                    } else {
                        $("#p_c").hide();
                    }

                    if (data.tags != "") {
                        $("#p_tag").show();
                        for (const tag of data.tags) {
                            $("#post_details_modal #post_tag").append(
                                "" +
                                    '<span class="select_tag">' +
                                    tag["name"] +
                                    "," +
                                    " " +
                                    "</span>"
                            );
                        }
                    } else {
                        $("#p_tag").hide();
                    }

                    if (data.status != "") {
                        $("#p_sta").show();
                        $("#post_details_modal #post_status").html(data.status);
                    } else {
                        $("#p_sta").hide();
                    }

                    if (data.content != "") {
                        $("#p_con").show();
                        $("#post_details_modal #post_content").html(
                            data.content
                        );
                    } else {
                        $("#p_con").hide();
                    }

                    if (data.post_image != "") {
                        $("#p_i").show();
                        $("#post_details_modal #post_image img").attr(
                            "src",
                            "/media/posts/" + data.post_image
                        );
                    } else {
                        $("#p_i").hide();
                    }

                    if (data.post_gallery != "") {
                        $("#p_g").show();
                        for (const gallery of data.post_gallery) {
                            $("#post_details_modal #post_g_image").append(
                                "" +
                                    '<span class="gallery_image"><img width="150" style="margin: 5px;" src="/media/posts/' +
                                    gallery +
                                    '" alt=""></span>'
                            );
                        }
                    } else {
                        $("#p_g").hide();
                    }

                    if (data.post_audio != null && data.post_audio != "") {
                        $("#p_a").show();
                        $("#post_details_modal #post_audio").append(
                            "" +
                                '<span class="p_audio"><iframe width="400" height="250" src="' +
                                data.post_audio +
                                '" frameborder="0"></iframe></span>'
                        );
                    } else {
                        $("#p_a").hide();
                    }

                    if (data.post_video != null && data.post_video != "") {
                        $("#p_v").show();
                        $("#post_details_modal #post_video").append(
                            "" +
                                '<span class="p_video"><iframe width="400" height="250" src="' +
                                data.post_video +
                                '" frameborder="0"></iframe></span>'
                        );
                    } else {
                        $("#p_v").hide();
                    }

                    $("#post_details_modal").modal("show");
                }
            });
        });

        // post gallery image problem solve
        $(document).on("click", "#remove_gallary_image", function(event) {
            event.preventDefault();
            $(".gallery_image").remove();
            $(".p_video").remove();
            $(".p_audio").remove();
            $(".select_category").remove();
            $(".select_tag").remove();
        });



        //================== Product ===================//


                //========== Brand ==========//

        //Brand Table load by yijra datatable
        $('#brand_table').DataTable({
            processing : true,
            serverSide : true,
            drawCallback: function(settings) {
                var api = this.api();
                $('.brand_publish').html('('+api.rows().data().length+')');
                // $('.brand_trash').html('('+api.rows().data().length+')');
            },
            ajax : {
                url: '/products/brand'
            },
            columns : [
                {
                    data : 'id',
                    name : 'id',
                },
                {
                    data : 'name',
                    name : 'name'
                },
                {
                    data : 'slug',
                    name : 'slug'
                },
                {
                    data : 'logo',
                    name : 'logo',
                    render: function(data, type, full, meta){
                        return `<img style="height: 62px;" src="/media/products/brands/${data}" />`;
                    }
                },
                {
                    data : 'status',
                    name : 'status',
                    render: function(data, type, full, meta){
                        return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" brand_id="${full.id}" class="custom-control-input brand_ststus" ${full.status == true ? 'checked="checked"' : ''} id="customSwitch_${full.id}" value="${data}">
                                <label class="custom-control-label" style="cursor:pointer;" for="customSwitch_${full.id}"></label>
                            </div>`;
                    }
                },
                {
                    data : 'trash',
                    name : 'trash',
                    render: function(data, type, full, meta){
                        return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" brand_id="${full.id}" class="custom-control-input brand_trash" ${full.trash == true ? 'checked="checked"' : ''} id="customTrashSwitch_${full.id}" value="${data}">
                                <label class="custom-control-label" style="cursor:pointer;" for="customTrashSwitch_${full.id}"></label>
                            </div>`;
                    }
                },
                {
                    data : 'action',
                    name : 'action'
                }
            ]
        });


        // Brand trash table load by yijra table
        $('#brand_trash_table').DataTable({
            processing: true,
            serverSide: true,
            drawCallback: function(settings) {
                var api = this.api();
                $('.brand_trash').html('('+api.rows().data().length+')');
            },
            ajax: {
                url : '/products/brand-trash'
            },
            columns : [
                {
                    data : 'id',
                    name : 'id'
                },
                {
                    data : 'name',
                    name : 'name'
                },
                {
                    data : 'slug',
                    name : 'slug'
                },
                {
                    data : 'logo',
                    name : 'logo',
                    render: function(data, type, full, meta){
                        return `<img style="height: 62px;" src="/media/products/brands/${data}" />`;
                    }
                },
                {
                    data : 'trash',
                    name : 'trash',
                    render: function(data, type, full, meta){
                        return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" brand_id="${full.id}" class="custom-control-input brand_trash" ${full.trash == true ? 'checked="checked"' : ''} id="customTrashSwitch_${full.id}" value="${data}">
                                <label class="custom-control-label" style="cursor:pointer;" for="customTrashSwitch_${full.id}"></label>
                            </div>`;
                    }

                },
                {
                    data : 'action',
                    name : 'action'
                }
            ]
        });


        // Brand add by ajax
        $(document).on('submit', '#brand_form', function (e){
            e.preventDefault();

            $.ajax({
                url: '/products/brand',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response){
                    $('#brand_form')[0].reset();
                    $('#add_brand_modal').modal('hide');
                    $('#brand_table').DataTable().ajax.reload();
                }
            });
        });


        // Brand edit by ajax
        $(document).on('click', '.edit_brand', function(e){
            e.preventDefault();
            let edit_id = $(this).attr('edit_id');

            $.ajax({
                url: '/products/brand/'+edit_id+'/edit',
                type:"GET",
                success: function(data){
                    $('.brand_id').val(data.id);
                    $('.brand_name').val(data.name);
                    $('img.brand_photo_edit').attr('src', '/media/products/brands/'+data.logo);

                    $('#edit_brand_modal').modal('show');
                }
            });

        });


        // Brand update by ajax
        $(document).on('submit', '#edit_brand_form', function(e){
            e.preventDefault();
            let id   = $('.brand_id').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url: '/products/brand-update',
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    $.notify(data, {
                        globalPosition: 'top right',
                        className: 'success'
                    });

                    $('#brand_table').DataTable().ajax.reload();
                    $('#edit_brand_modal').modal('hide');
                },

            });

        });


        //  Add Brand logo load
        $(document).on('change', '.brand_logo_add', function(e){
            let logo_url = URL.createObjectURL(e.target.files[0]);
            $('.brand_photo_add').attr('src', logo_url);
        });


        // Edit Brand logo load
        $(document).on('change', '.brand_logo_edit', function(e){
            let logo_url = URL.createObjectURL(e.target.files[0]);
            $('.brand_photo_edit').attr('src', logo_url);
        });


        //Brand Status update
        $(document).on("change", "input.brand_ststus", function() {
            let id = $(this).attr("brand_id");
            let value = $(this).val();

            $.ajax({
                url: "brand/status-update/" + id +'/'+ value,
                success: function(data) {
                    $.notify(data, {
                        globalPosition: "top right",
                        className: "success"
                    });

                    $('#brand_table').DataTable().ajax.reload();

                }
            });
        });


        //Brand trash update
        $(document).on("change", "input.brand_trash", function() {
            let id = $(this).attr("brand_id");
            let value = $(this).val();

            $.ajax({
                url: "brand/trash-update/" + id +'/'+ value,
                success: function(data) {
                    $.notify(data, {
                        globalPosition: "top right",
                        className: "success"
                    });

                    $('#brand_table').DataTable().ajax.reload();
                    $('#brand_trash_table').DataTable().ajax.reload();

                }
            });
        });


        // Brand Delete
        $(document).on('submit', '#brand_delete_form', function(e){
            e.preventDefault();
            let id = $('#delete_brand').val();


            swal(
                {
                    title: "Are you sure?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'brand/delete',
                            method: 'POST',
                            data: {id: id},
                            success: function(data){
                                swal(
                                    {
                                        title: "Deleted!",
                                        type: "success"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            $.notify(data, {
                                                globalPosition: "top right",
                                                className: 'error'
                                            });

                                            $('#brand_table').DataTable().ajax.reload();
                                            $('#brand_trash_table').DataTable().ajax.reload();
                                        }
                                    }
                                );
                            }
                        });

                    } else {
                        swal("Cancelled", "", "error");
                    }
                }
            );





        });

        //================ Image uploaed global function =================//
        function loadImage(source, destination){

            $(document).on('change', source, function(e){
                let image_url = URL.createObjectURL(e.target.files[0]);
                $(destination).attr('src', image_url);
            });

        }



        //==================== Category =======================//

        //categroy all data fetch by yajra datatable
        $('#product_category_table').DataTable({
            processing: true,
            serverSide: true,
            drawCallback: function(settings) {
                var api = this.api();
                $('.p_category_publish').html('('+api.rows().data().length+')');
                // $('.brand_trash').html('('+api.rows().data().length+')');
            },
            ajax: {
                url: '/products/categories'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta){
                        return `<img style="height:62px; width: 62px;" src="/media/products/category/${data}" />`;
                    }
                },
                {
                    data: 'icon',
                    name: 'icon',
                    render: (data, type, full, meta) => {
                        return `<i class="${data}"></i>`;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: (data, type, full, meta) => {
                        return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" pcategory_id="${full.id}" class="custom-control-input pcategory_ststus" ${full.status == true ? 'checked="checked"' : ''} id="customSwitch_${full.id}" value="${data}">
                                    <label class="custom-control-label" style="cursor:pointer;" for="customSwitch_${full.id}"></label>
                                </div>`;
                    }
                },
                {
                    data: 'trash',
                    name: 'trash',
                    render: (data, type, full, meta) => {
                        return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" pcategoryt_id="${full.id}" class="custom-control-input pcategory_trash" ${full.trash == false ? 'checked="checked"' : ''} id="customTrashSwitch_${full.id}" value="${data}">
                                    <label class="custom-control-label" style="cursor:pointer;" for="customTrashSwitch_${full.id}"></label>
                                </div>`;
                    }
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ]
        });

        //categroy all trash data fetch by yajra datatable
        $('#p_category_trash_table').DataTable({
            processing: true,
            serverSide: true,
            drawCallback: function(settings) {
                var api = this.api();
                $('.p_category_trash').html('('+api.rows().data().length+')');
                // $('.brand_trash').html('('+api.rows().data().length+')');
            },
            ajax: {
                url: '/products/categories-trash'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta){
                        return `<img style="height:62px; width: 62px;" src="/media/products/category/${data}" />`;
                    }
                },
                {
                    data: 'icon',
                    name: 'icon',
                    render: (data, type, full, meta) => {
                        return `<i class="${data}"></i>`;
                    }
                },
                {
                    data: 'trash',
                    name: 'trash',
                    render: (data, type, full, meta) => {
                        return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" pcategoryt_id="${full.id}" class="custom-control-input pcategory_trash_page" ${full.trash == true ? 'checked="checked"' : ''} id="customTrashSwitch_${full.id}" value="${data}">
                                    <label class="custom-control-label" style="cursor:pointer;" for="customTrashSwitch_${full.id}"></label>
                                </div>`;
                    }
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ]
        });

        // categoyr fetch by normal function with ajax request
        function allProductCategory(){

            $.ajax({
                url: '/products/category/list',
                success: function(data){
                    $('#category_structure').empty();
                    $('#parent_category').empty();
                    // console.log(data);
                    // all category show by select option
                    let select_option = '<option value="">-Select-</option>';
                    for(item of data.level1){
                                   select_option += `
                                                        <option value="${item.id}">&check;&nbsp;${item.name}`;

                                                        if(data.level2.length > 0){
                                                            for(cat2 of data.level2){
                                                                if(cat2.parent == item.id){
                                                                    select_option += `<option value="${cat2.id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x26AC;&nbsp;${cat2.name}`;

                                                                        if(data.level3.length > 0){
                                                                            for(cat3 of data.level3){
                                                                                if(cat3.parent == cat2.id){
                                                                                    select_option += `<option value="${cat3.id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x25FE;&nbsp;${cat3.name}`;

                                                                                        if(data.level4.length > 0){
                                                                                            for(cat4 of data.level4){
                                                                                                if(cat4.parent == cat3.id){
                                                                                                    select_option += `<option value="${cat4.id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x25FE;&nbsp;${cat4.name}`;

                                                                                                        if(data.level5.length > 0){
                                                                                                            for(cat5 of data.level5){
                                                                                                                if(cat5.parent == cat4.id){
                                                                                                                    select_option += `<option value="${cat5.id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x25FE;&nbsp;${cat5.name}</option>`;
                                                                                                                }
                                                                                                            }
                                                                                                        }

                                                                                                    select_option += `</option>`;
                                                                                                }
                                                                                            }
                                                                                        }

                                                                                    select_option += `</option>`;
                                                                                }
                                                                            }
                                                                        }

                                                                    select_option += `</option>`;
                                                                }
                                                            }
                                                        }

                                    select_option += `</option>
                                                    `;
                    }
                    $('#parent_category').append(select_option);// end all category show by select option


                    // all category show by display user
                    let container = '';
                    for(item of data.level1){
                        // console.log(data.level2.length);
                                        //level 1
                                        container   +=  `<ul>
                                                            <li>${item.name}
                                                                <div  class="edit_del">
                                                                    <a href="#" edit_cat="${item.id}" class="btn btn-sm btn-outline-info mr-1 p_edit_cat"><i class="fas fa-edit"></i></a>
                                                                    <a href="#" delete_cat="${item.id}" class="btn btn-sm btn-outline-danger p_delete_cat"><i class="fas fa-trash"></i></a>
                                                                </div>
                                                            `;
                                                            // level 2
                                                            if(data.level2.length > 0){
                                                                // console.log(data.level2);
                                                                container += `<ul>`;
                                                                    for(cat2 of data.level2){
                                                                        if(cat2.parent == item.id){
                                                                            container  += `<li>${cat2.name}
                                                                                <div class="edit_del">
                                                                                    <a href="#" edit_cat="${cat2.id}" class="btn btn-sm btn-outline-info mr-1 p_edit_cat"><i class="fas fa-edit"></i></a>
                                                                                    <a href="#" delete_cat="${cat2.id}" class="btn btn-sm btn-outline-danger p_delete_cat"><i class="fas fa-trash"></i></a>
                                                                                </div>
                                                                            `;
                                                                            // level 3
                                                                            if(data.level3.length > 0){
                                                                                // console.log(data.level3);
                                                                                container += `<ul>`;
                                                                                    for(cat3 of data.level3){
                                                                                        if(cat3.parent == cat2.id){
                                                                                            container  += `<li>${cat3.name}
                                                                                                <div class="edit_del">
                                                                                                    <a href="#" edit_cat="${cat3.id}" class="btn btn-sm btn-outline-info mr-1 p_edit_cat"><i class="fas fa-edit"></i></a>
                                                                                                    <a href="#" delete_cat="${cat3.id}" class="btn btn-sm btn-outline-danger p_delete_cat"><i class="fas fa-trash"></i></a>
                                                                                                </div>
                                                                                            `;
                                                                                                //level 4
                                                                                                if(data.level4.length > 0){
                                                                                                    // console.log(data.level4);
                                                                                                    container += `<ul>`;
                                                                                                        for(cat4 of data.level4){
                                                                                                            if(cat4.parent == cat3.id){
                                                                                                                container  += `<li>${cat4.name}
                                                                                                                    <div class="edit_del">
                                                                                                                        <a href="#" edit_cat="${cat4.id}" class="btn btn-sm btn-outline-info mr-1 p_edit_cat"><i class="fas fa-edit"></i></a>
                                                                                                                        <a href="#" delete_cat="${cat4.id}" class="btn btn-sm btn-outline-danger p_delete_cat"><i class="fas fa-trash"></i></a>
                                                                                                                    </div>
                                                                                                                `;
                                                                                                                    // level 5
                                                                                                                    if(data.level5.length > 0){
                                                                                                                        // console.log(data.level5);
                                                                                                                        container += `<ul>`;
                                                                                                                            for(cat5 of data.level5){
                                                                                                                                if(cat5.parent == cat4.id){
                                                                                                                                    container  += `<li>${cat5.name}
                                                                                                                                        <div class="edit_del">
                                                                                                                                            <a href="#" edit_cat="${cat5.id}" class="btn btn-sm btn-outline-info mr-1 p_edit_cat"><i class="fas fa-edit"></i></a>
                                                                                                                                            <a href="#" delete_cat="${cat5.id}" class="btn btn-sm btn-outline-danger p_delete_cat"><i class="fas fa-trash"></i></a>
                                                                                                                                        </div>
                                                                                                                                    </li>`;
                                                                                                                                }
                                                                                                                            }
                                                                                                                        container += `</ul>`;
                                                                                                                    }

                                                                                                                container  += `</li>`;
                                                                                                            }
                                                                                                        }
                                                                                                    container += `</ul>`;
                                                                                                }

                                                                                            container  += `</li>`;
                                                                                        }
                                                                                    }
                                                                                container += `</ul>`;
                                                                            }

                                                                            container += `</li>`;
                                                                                }
                                                                            }
                                                                        container += `</ul>`;
                                                                    }
                                        container   +=        `</li>
                                                         </ul>
                                                        `;
                    }
                    $('#category_structure').append(container);// End all category show by display user
                }
            });

        }
        allProductCategory();

        // hover current ul li for category edit or delete
        $(document).on('mouseover', 'li', function(e){
            e.stopPropagation();
            $(this).addClass('currentLI');
        });
        // hover out ul li for category edit or delete
        $(document).on('mouseout', 'li', function(){
            $(this).removeClass('currentLI');
        });


        //icon name get and set input field
        $(document).on('change', '#category_icon', function(e){
            let icon = $(this).children();

            $('#icon_name').val(icon[0].className);
            $('#edit_category_icon_name').val(icon[0].className);

        });

        //icon name get and set input field edit category
        $(document).on('change', '#update_category_icon', function(e){
            let icon = $(this).children();

            $('#edit_category_icon_name').val(icon[0].className);

        });



        //add category
        $(document).on('submit', '#product_categroy_form', function (e){
            e.preventDefault();

            $.ajax({
                url: '/products/categories',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){

                    $.notify(data, {
                        globalPosition: 'top right',
                        className: 'success'
                    });

                    $('#product_categroy_form')[0].reset();
                    $('.category_photo_show').attr('src', '');
                    allProductCategory();
                    // $('#add_product_category_modal').modal('hide');
                    // // $('#brand_table').DataTable().ajax.reload();
                }
            });
        });



        //Category add picture show function
        loadImage('#p_image_l', '.category_photo_show');


        // category delete by wp structure
        $(document).on('click', '.p_delete_cat', function(e){
            e.preventDefault();
            let delete_id = $(this).attr('delete_cat');


            swal(
                {
                    title: "Are you sure?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/products/category/delete/'+delete_id,
                            success: function(data){
                                // alert(data);
                                // console.log(data);
                                swal(
                                    {
                                        title: "Deleted!",
                                        type: "success"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            $.notify(data, {
                                                globalPosition: "top right",
                                                className: 'success'
                                            });

                                            allProductCategory();
                                            // $('#brand_table').DataTable().ajax.reload();
                                            // $('#brand_trash_table').DataTable().ajax.reload();
                                        }
                                    }
                                );
                            }
                        });

                    } else {
                        swal("Cancelled", "", "error");
                    }
                }
            );

        });


        // category edit by wp struectrue
        $(document).on('click', '.p_edit_cat', function(e){
            e.preventDefault();
            let edit_id = $(this).attr('edit_cat');

            $.ajax({
                url: '/products/category/edit/'+edit_id,
                success: function(data){
                    // alert(data);
                    // console.log(data);
                    // console.log(data.catego.parent);

                    $('#edit_parent_category_name').empty();
                    // console.log(data);
                    // all category show by select option
                    let select_option = '<option value="">Parent</option>';
                    for(item of data.level1){
                                   select_option += `
                                                        <option `; if(item.id == data.catego.parent){ select_option += `selected` } select_option += ` value="${item.id}">&check;&nbsp;${item.name}`;

                                                        if(data.level2.length > 0){
                                                            for(cat2 of data.level2){
                                                                if(cat2.parent == item.id){
                                                                    select_option += `<option `; if(cat2.id == data.catego.parent){ select_option += `selected` } select_option += ` value="${cat2.id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x26AC;&nbsp;${cat2.name}`;

                                                                        if(data.level3.length > 0){
                                                                            for(cat3 of data.level3){
                                                                                if(cat3.parent == cat2.id){
                                                                                    select_option += `<option `; if(cat3.id == data.catego.parent){ select_option += `selected` } select_option += ` value="${cat3.id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x25FE;&nbsp;${cat3.name}`;

                                                                                        if(data.level4.length > 0){
                                                                                            for(cat4 of data.level4){
                                                                                                if(cat4.parent == cat3.id){
                                                                                                    select_option += `<option `; if(cat4.id == data.catego.parent){ select_option += `selected` } select_option += ` value="${cat4.id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x25FE;&nbsp;${cat4.name}`;

                                                                                                        if(data.level5.length > 0){
                                                                                                            for(cat5 of data.level5){
                                                                                                                if(cat5.parent == cat4.id){
                                                                                                                    select_option += `<option `; if(cat5.id == data.catego.parent){ select_option += `selected` } select_option += ` value="${cat5.id}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x25FE;&nbsp;${cat5.name}</option>`;
                                                                                                                }
                                                                                                            }
                                                                                                        }

                                                                                                    select_option += `</option>`;
                                                                                                }
                                                                                            }
                                                                                        }

                                                                                    select_option += `</option>`;
                                                                                }
                                                                            }
                                                                        }

                                                                    select_option += `</option>`;
                                                                }
                                                            }
                                                        }

                                    select_option += `</option>
                                                    `;
                    }
                    $('#edit_parent_category_name').append(select_option);// end all category show by select option

                    $("#edit_category_name").val(data.catego.name);
                    $("#edit_category_id").val(data.catego.id);
                    $('#edit_category_icon_name').val(data.catego.icon);
                    $('.edit_category_photo_show').attr('src', '/media/products/category/'+data.catego.image);


                    $("#product_category_edit_modal").modal('show');
                }
            });

        });

        //Category edit picture show function
        loadImage('#edit_p_image_l', '.edit_category_photo_show');


        //update category by wp struectur
        $(document).on('submit', '#edit_product_categroy_form', function (e){
            e.preventDefault();

            $.ajax({
                url: '/products/category/update',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    console.log(data);
                    $.notify(data, {
                        globalPosition: 'top right',
                        className: 'success'
                    });

                    allProductCategory();
                    $("#product_category_edit_modal").modal('hide');
                    // $('#add_product_category_modal').modal('hide');
                    // // $('#brand_table').DataTable().ajax.reload();
                }
            });
        });


        //Status update
        $(document).on('change', '.pcategory_ststus', function(e){
            let id        = $(this).attr('pcategory_id');
            let value     = $(this).val();

            $.ajax({
                // url: 'categories/status-update/'+id+'/'+cat_val,
                url: '/products/categories/status-update/'+id+'/'+value,
                success: function(data){
                    $.notify(data, {
                        globalPosition: 'top right',
                        className: 'success'
                    });

                    $('#product_category_table').DataTable().ajax.reload();
                }
            });

        });


        //Trash update by category Publish page
        $(document).on('change', '.pcategory_trash', function(e){
            let id        = $(this).attr('pcategoryt_id');
            let value     = $(this).val();

            $.ajax({
                // url: 'categories/status-update/'+id+'/'+cat_val,
                url: '/products/categories/trash-update/'+id+'/'+value,
                success: function(data){
                    $.notify(data, {
                        globalPosition: 'top right',
                        className: 'success'
                    });

                    $('#product_category_table').DataTable().ajax.reload();
                }
            });

        });


        //Trash update by category Trash page
        $(document).on('change', '.pcategory_trash_page', function(e){
            let id        = $(this).attr('pcategoryt_id');
            let value     = $(this).val();

            $.ajax({
                // url: 'categories/status-update/'+id+'/'+cat_val,
                url: '/products/categories/trash-update/'+id+'/'+value,
                success: function(data){
                    $.notify(data, {
                        globalPosition: 'top right',
                        className: 'success'
                    });

                    $('#p_category_trash_table').DataTable().ajax.reload();
                }
            });

        });


        // Category Delete
        $(document).on('submit', '#category_delete_form', function(e){
            e.preventDefault();
            let id = $('#delete_product_category').val();


            swal(
                {
                    title: "Are you sure?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/products/category/delete',
                            method: 'POST',
                            data: {id: id},
                            success: function(data){
                                swal(
                                    {
                                        title: "Deleted!",
                                        type: "success"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            $.notify(data, {
                                                globalPosition: "top right",
                                                className: 'success'
                                            });

                                            $('#p_category_trash_table').DataTable().ajax.reload();
                                        }
                                    }
                                );
                            }
                        });

                    } else {
                        swal("Cancelled", "", "error");
                    }
                }
            );





        });


        //======================== Product Tag =======================//

        // get all product tag
        $("#product_tag_table").DataTable({
            processing: true,
            serverSide: true,
            ajax : {
                url: '/products/tag/list'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, full, meta){
                        return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" p_tag_id="${full.id}" class="custom-control-input p_tag_status" ${full.status == true ? 'checked="checked"' : ''} id="customStatusSwitch_${full.id}" value="${data}">
                                    <label class="custom-control-label" style="cursor:pointer;" for="customStatusSwitch_${full.id}"></label>
                                </div>`;
                    }
                },
                {
                    data: 'trash',
                    name: 'trash',
                    render: function(data, type, full, meta){
                        return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" p_tag_id="${full.id}" class="custom-control-input p_tag_trash_page" ${full.trash == true ? 'checked="checked"' : ''} id="customTrashSwitch_${full.id}" value="${data}">
                                    <label class="custom-control-label" style="cursor:pointer;" for="customTrashSwitch_${full.id}"></label>
                                </div>`;
                    }
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        // add new tag
        $(document).on('submit', '#product_tag_form', function(e){
            e.preventDefault();
            let name = $('#add_product_tag_modal input[name=name]').val();
            if(name == '' || name == null){
                $.notify('Please enter tag name',{
                    globalPosition: "top right",
                    className: 'warning'
                });
            }

            $.ajax({
                url: '/products/tag/add',
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    $.notify(data, {
                        globalPosition: 'top right',
                        className: 'success'
                    });

                    $("#product_tag_table").DataTable().ajax.reload();
                    $('#add_product_tag_modal').modal('hide');
                }
            });

        });


    });
})(jQuery);



// multilevel category structure

/* <ul>
    <li>Man
        <ul>
            <li>Panjabi
                <ul>
                    <li>Seroayni</li>
                    <li>Kabli</li>
                </ul>
            </li>
        </ul>
    </li>
    <li>Women</li>
    <li>Electronic</li>
</ul> */
