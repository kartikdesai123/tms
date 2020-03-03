var Updateprofile = function () {

    var handleEditUser = function () {

        $('#Update').click(function() {

        var form = $('#editUserd');
        var rules = {
            name: {required: true},
            surname: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });


        });

          $('#ChangePassword').click(function() {

            var form = $('#editUser');
            var rules = {
                currentpassword: {required: true},
                newpassword: {required: true},
                confirmpassword: {required: true, equalTo: "#newpassword"}
            };
            handleFormValidate(form, rules, function (form) {
                handleAjaxFormSubmit(form);
            });


        });
    };

    var handleDivision = function () {
        $('.c-tabs__link').click(function () {
            var status = $(this).attr('data-id');
            if (status == '1') {
                $(".userdetaildiv").show();
                $(".changepassworddiv").hide();
                $(".isDiv").val("userdetaildiv");
            } else {
                $(".userdetaildiv").hide();
                $(".changepassworddiv").show();
                $(".isDiv").val("changepassworddiv");

            }
        });
    };


    return{

        edit_init: function () {
            handleEditUser();
            handleDivision();
        }
    };
}();