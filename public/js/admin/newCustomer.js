var NewCustomer = function () {
    var list = function () {

        var name = $('#name').val();
        var status = $('#status').val();
        var type = $('#type').val();
//        alert(name);alert(status);alert(type);
        var dataArr = {name: name, type: type, status:status};
        var columnWidth = {};

        var arrList = {
            'tableID': '#newcustomerdatatable',
            'ajaxURL': baseurl + "admin/newcustomer-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [10],
            'noSortingApply': [9, 10],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth,
            'stateSave': true,
        };
        getDataTable(arrList);

        $('body').on("click", ".delete", function () {
            var dataid = $(this).attr('data-id');
            $('.yes-sure').attr('data-id', dataid);
        });

        $('body').on("click", ".yes-sure", function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/newcustomer-ajaxAction",
                data: {'action': 'deleteCustomer', 'data': {'id': id}},
                success: function (data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });

        $('body').on('change', '.serchbtn', function () {
            var name = $('#name').val();
            var status = $('#status').val();
            var type = $('#type').val();
            var querystring = (name == '' && typeof name === 'undefined') ? '&name=' : '&name=' + name;
            querystring += (status == '' && typeof status === 'undefined') ? '&status=' : '&status=' + status;
            querystring += (type == '' && typeof type === 'undefined') ? '&type=' : '&type=' + type;


//            alert(querystring);exit;
            location.href = baseurl + 'admin/customer-list-search?' + querystring;

        });
    };

    var editCustomer = function () {
        $('body').on("click", ".removeContact", function () {
            $(this).closest('.remove').remove();
        });

        var submitFrom = true;
        var customValid = true;
        var validateTrip = true;
        $('#addCustomer').validate({
            debug: true,
            rules: {
                customerNumber: {required: true},
                customerType: {required: true},
                companyName: {required: true},
                address: {required: true},
                state: {required: true},
                telephone: {required: true},
                email: {required: true, email: true},
                web: {required: true},
                taxNumber: {required: true},
                registerDate: {required: true},
                timeline: {required: true},
                lastUpdate: {required: true},
            },
            invalidHandler: function (event, validator) {
                validateTrip = false;
                customValid = customerInfoValid();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.c-input, .form-control').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.c-input, .form-control').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                return false;
            },
            submitHandler: function (form) {
                customValid = customerInfoValid();

                if (submitFrom && customValid)
                {
                    ajaxcall($(form).attr('action'), $(form).serialize(), function (output) {
                        handleAjaxResponse(output);
                    });
//                    handleAjaxFormSubmit(form,true);
//                    form.submit();
                }
            }
        });

        function customerInfoValid() {
            var customValid = true;

            $('.contactEmail').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });



            $('.contactFirstName').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactSurName').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactTelephone').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactFax').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactMobile').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.contactEmail').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactGender').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            return customValid;
        }
        ;

        $('body').on("click", ".addContact", function () {

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/add-contract",
                data: {'action': 'addContract'},
                success: function (data) {
                    $(".appendContact").append(data);
                    $('body').on("click", ".removeContact", function () {
                        $(this).closest('.remove').remove();
                    });
                }
            });
        });
        $('body').on("click", ".edit_workplace", function () {
            var workplace_id = $(this).data('workplace_id');

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/edit-workplacecustomer",
                data: {'action': 'editworkplacecustomer', data: {'workplace_id': workplace_id}},
                success: function (data) {
                    console.log(data)
                    $(".editappendContact").append(data);
                    $('body').on("click", ".removeContact", function () {
                        $(this).closest('.remove').remove();
                    });
                }
            });
        });
        $('body').on("click", ".removeWorkplaceContact", function () {
            $(this).closest('.removeWorkplaceContactDiv').remove();
        });
    };

    var addCustomer = function () {

        /* view workplace details start*/
        $('body').on("click", ".view_workplace", function () {
            var id = $(this).data('id');

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/view-workplacecustomer",
                data: {'action': 'viewworkplacecustomer', data: {'id': id}},
                success: function (data) {
//                    console.log(data)
                    $(".viewappendContact").empty();
                    $(".viewappendContact").append(data);

                    $('body').on("click", ".removeContact", function () {
                        $(this).closest('.remove').remove();
                    });
                }
            });
        });
        /* view workplace details end*/

        var submitFrom = true;
        var customValid = true;
        var validateTrip = true;
        $('#addCustomer').validate({
            debug: true,
            rules: {
                registerDate: {required: true},
                timeline: {required: true},
                lastUpdate: {required: true},
            },
            invalidHandler: function (event, validator) {
                validateTrip = false;
                customValid = customerInfoValid();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.c-input, .form-control').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.c-input, .form-control').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                return true;
            },
            submitHandler: function (form) {
                customValid = customerInfoValid();

                if (submitFrom && customValid)
                {
                    ajaxcall($(form).attr('action'), $(form).serialize(), function (output) {
                        handleAjaxResponse(output);
                    });
//                    handleAjaxFormSubmit(form,true);
//                    form.submit();
                }
            }
        });

        function customerInfoValid() {
            var customValid = true;

            $('.customerNumber').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.companyName').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.address').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.state').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.telephone').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.fax').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.cust_email').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.web').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.taxNumber').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactFirstName').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });


            $('.contactSurName').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactTelephone').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactFax').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactMobile').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.contactEmail').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.contactGender').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.customerType').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            return customValid;
        }
        ;

        $('body').on("click", ".addContact", function () {
            var lastcus_no = $('.customerNumber').last().val();
            lastcus_no++;
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/add-contract",
                data: {'action': 'addContract', 'lastcus_no': lastcus_no},
                success: function (data) {
                    $(".addcustomer").append(data);
                    $('body').on("click", ".removeContact", function () {
                        $(this).closest('.removediv').remove();
                    });
                }
            });
        });
        $('body').on("click", ".edit_workplace", function () {
            var workplace_id = $(this).data('workplace_id');

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/edit-workplacecustomer",
                data: {'action': 'editworkplacecustomer', data: {'workplace_id': workplace_id}},
                success: function (data) {
//                    console.log(data)
                    $(".editappendContact").append(data);
                    $('body').on("click", ".removeContact", function () {
                        $(this).closest('.remove').remove();
                    });
                }
            });
        });

        $('body').on("click", ".removeWorkplaceContact", function () {
            $(this).closest('.removeWorkplaceContactDiv').remove();
        });

    };
    return{
        init: function () {
            list();
        },
        add: function () {
            addCustomer();
        },
        edit: function () {
            editCustomer();
        },
    };
}();