var CustomerWorkplace = function () {

    var list = function () {
        $('body').on("click", ".view_workplace", function () {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/workplacecustomer-ajaxcall",

                data: {'action': 'viewworkplacecustomer', data: {'id': id}},
                success: function (data) {
//                    console.log(data)
                    $(".viewappendContact").empty();
                    $(".viewappendContact").append(data);
                }
            });
        });
        
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
                    
                }
            });
        });
        
        $('body').on("click", ".removeContact", function () {
            $(this).closest('.remove').remove();
        });
        
        $('body').on("click", ".edit_workplace", function () {
             var workplace_id = $(this).data('workplace_id');

             $.ajax({
                 type: "POST",
                 headers: {
                     'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                 },
//                 url: baseurl + "admin/edit-workplacecustomer",
                 url: baseurl + "admin/workplacecustomer-ajaxcall",
                 data: {'action': 'editworkplacecustomer', data: {'workplace_id': workplace_id}},
                 success: function (data) {
                     $(".editappendContact").empty();
                     $(".editappendContact").html(data);
                     $('.c-select.c-select--multiple').select2({
                            width: "100%",
                            multiple: !0
                        });
                        var submitFrom = true;
                        var customValid = true;
                        var validateTrip = true;
                        $('#editCustomer').validate({
                            debug: true,
                            rules: {
                                customerNo: {required: true},
                                workplaceName: {required: true},
                                address: {required: true},
                                state: {required: true},
                                telephone: {required: true},
                                fax: {required: true},
                                email: {required: true},
                                web: {required: true},
                                responsibleWorker: {required: true}
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
                                }
                            }
                        });

                        function customerInfoValid() {
                            var customValid = true;

                            $('.wp_gender').each(function () {
                                if ($(this).is(':visible')) {
                                    if ($(this).val() == '') {
                                        $(this).addClass('has-error');
                                        customValid = false;
                                    } else {
                                        $(this).removeClass('has-error');
                                    }
                                }
                            });

                            $('.wp_firstname').each(function () {
                                if ($(this).is(':visible')) {
                                    if ($(this).val() == '') {
                                        $(this).addClass('has-error');
                                        customValid = false;
                                    } else {
                                        $(this).removeClass('has-error');
                                    }
                                }
                            });

                            $('.wp_surname').each(function () {
                                if ($(this).is(':visible')) {
                                    if ($(this).val() == '') {
                                        $(this).addClass('has-error');
                                        customValid = false;
                                    } else {
                                        $(this).removeClass('has-error');
                                    }
                                }
                            });

                            $('.wp_telephone').each(function () {
                                if ($(this).is(':visible')) {
                                    if ($(this).val() == '') {
                                        $(this).addClass('has-error');
                                        customValid = false;
                                    } else {
                                        $(this).removeClass('has-error');
                                    }
                                }
                            });

                            $('.wp_fax').each(function () {
                                if ($(this).is(':visible')) {
                                    if ($(this).val() == '') {
                                        $(this).addClass('has-error');
                                        customValid = false;
                                    } else {
                                        $(this).removeClass('has-error');
                                    }
                                }
                            });
                            $('.wp_mobile').each(function () {
                                if ($(this).is(':visible')) {
                                    if ($(this).val() == '') {
                                        $(this).addClass('has-error');
                                        customValid = false;
                                    } else {
                                        $(this).removeClass('has-error');
                                    }
                                }
                            });

                            $('.wp_email').each(function () {
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
                        };
                 }
             });
         });
         
        var submitFrom = true;
        var customValid = true;
        var validateTrip = true;
        $('#addCustomer').validate({
            debug: true,
            rules: {
                customerNo: {required: true},
                workplaceName: {required: true},
                address: {required: true},
                state: {required: true},
                telephone: {required: true},
                fax: {required: true},
                email: {required: true},
                web: {required: true},
                responsibleWorker: {required: true}
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
                }
            }
        });

        function customerInfoValid() {
            var customValid = true;

            $('.wp_gender').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.wp_firstname').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.wp_surname').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.wp_telephone').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.wp_fax').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });
            $('.wp_mobile').each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).val() == '') {
                        $(this).addClass('has-error');
                        customValid = false;
                    } else {
                        $(this).removeClass('has-error');
                    }
                }
            });

            $('.wp_email').each(function () {
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
        };
        
        $('body').on("click", ".delete", function (){
            var dataid = $(this).attr('data-id');
            var customerId = $(this).attr('data-customerid');
            $('.yes-sure').attr('data-id',dataid);
            $('.yes-sure').attr('data-customerId',customerId);
        });
        
        $('.yes-sure').click(function() {
            var id = $(this).attr('data-id');
            var customerId = $(this).attr('data-customerId');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/workplacecustomer-ajaxcall",
                data: {'action': 'workplacedelete', 'data': {'id': id,'customerId':customerId }},
                success: function(data) {
//                    console.log(data);
//                    exit();
                    handleAjaxResponse(data);
                }
            });
        });
    };
    
    
    return{
        init: function () {
            list();
        },
    };
}();