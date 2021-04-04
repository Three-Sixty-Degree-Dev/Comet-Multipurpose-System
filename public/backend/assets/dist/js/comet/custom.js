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
    });
})(jQuery);
