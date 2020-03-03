var CustomerDetails = function() {

    var list = function() {
        $('.editDetails').click(function() {
             var dataid = $(this).attr('data-id');
             alert(dataid);
             exit;
        });
        
        $('.delete').click(function() {
            var dataid = $(this).attr('data-id');
            var dataurl = $(this).attr('data-url');
            $('.yes-sure').attr('data-id', dataid);
            $('.yes-sure').attr('data-url', dataurl);
        });

        $('.yes-sure').click(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user/ajaxAction",
                data: {'action': 'deleteUser', 'data': {'id': id }},
                success: function(data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });
    };
    return{
        detalis: function() {
            list();
        },
    };
}();