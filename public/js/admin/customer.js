var Customer = function() {

    var list = function() {

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
    var add_customer = function() {

        var form = $('#addUser');
        var rules = {
            first_name: {required: true},
            email: {required: true, email: true},
            password: {required: true},
            cpassword: {required: true, equalTo: "#password"}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });

    };

    var edit_customer = function() {

        var form = $('#editUser');
        var rules = {
            first_name: {required: true},
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });

    };


    return{
        listInit: function() {
            list();
        },
        addInit: function() {
            add_customer();
        },
        editInit: function() {
            edit_customer();
        },
    };
}();