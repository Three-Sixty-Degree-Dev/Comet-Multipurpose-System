(function($) {
    $(document).ready(function() {
        $(".reply-box-btn").click(function(e) {
            e.preventDefault();
            let c_id = $(this).attr("c_id");
            $(".reply-box-" + c_id).toggle();
        });
    });
})(jQuery);
