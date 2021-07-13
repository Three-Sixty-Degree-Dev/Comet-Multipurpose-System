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
    });
})(jQuery);
