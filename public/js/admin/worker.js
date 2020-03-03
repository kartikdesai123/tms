var Worker = function () {
    var list = function () {
        
        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#worker_datatable_demo',
            'ajaxURL': baseurl + "admin/worker-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [0, 8],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth,
            'start': start,
            'length': length,
            'stateSave': true,
        };
        getDataTable(arrList);
        
        $('body').on("click",".delete",function(){
            var dataid = $(this).attr('data-id');
            var dataurl = $(this).attr('data-url');
            $('.yes-sure').attr('data-id', dataid);
            $('.yes-sure').attr('data-url', dataurl);
        });
        
        $('body').on("click",".yes-sure",function(){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/worker/ajaxAction",
                data: {'action': 'deleteWorker', 'data': {'id': id}},
                success: function (data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });

        $('body').on("click",".block",function(){
             var dataid = $(this).attr('data-id');
           
            $('.yes-sureBlock').attr('data-id', dataid);
        });
        
        $('body').on("click",".yes-sureBlock",function(){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/worker/ajaxAction",
                data: {'action': 'blockWorker', 'data': {'id': id}},
                success: function (data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });
        
        $('body').on("click",".unblock",function(){
            var dataid = $(this).attr('data-id');
           
            $('.yes-sureUnblock').attr('data-id', dataid);
        });
        
        $('body').on("click",".yes-sureUnblock",function(){
            var id = $(this).attr('data-id');
           
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/worker/ajaxAction",
                data: {'action': 'unblockWorker', 'data': {'id': id}},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });

    };

    var edit_worker = function () {

        var form = $('#editWorker');
        var rules = {
            staffnumber: {required: true},
            type: {required: true},
            workplaces: {required: true},
//            position: {required: true},
//            employment: {required: true},
            startContract: {required: true},
            endContract: {required: true},
//            weekHours: {required: true},
//            totalHolidays: {required: true},
            cancelDate: {required: true},
//            hourly: {required: {depends: function(e) {  
//                return ($('input[name="workType"]:checked').val() == 'hourly');
//            }}},
//    
//            fixed: {required: {depends: function(e) {  
//                return ($('input[name="workType"]:checked').val() == 'fixed');
//            }}},

//            gender: {required: true},
//            firstName: {required: true},
//            surname: {required: true},
//            dateofBirth: {required: true},
//            placeofBirth: {required: true},
//            nationality: {required: true},
//            workPermit: {required: true},
//            residencePermit: {required: true},
//            taxId: {required: true},
//            socialSecurityNumber: {required: true},
//            email: {required: true,email:true},
//            phoneNumber: {required: true},
//            mobile: {required: true},
//            adresses: {required: true},
//            postcodeCity: {required: true},
//            name: {required: true},
//            bankName: {required: true},
//            iban: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });

    };

    var add_worker = function () {

        var form = $('#addWorker');
        var rules = {
            staffnumber: {required: true},
            type: {required: true},
            workplaces: {required: true},
//            position: {required: true},
//            employment: {required: true},
            startContract: {required: true},
            endContract: {required: true},
//            weekHours: {required: true},
//            totalHolidays: {required: true},
            cancelDate: {required: true},
//            hourly: {required: {depends: function(e) {  
//                return ($('input[name="workType"]:checked').val() == 'hourly');
//            }}},

//            fixed: {required: {depends: function(e) {  
//                return ($('input[name="workType"]:checked').val() == 'fixed');
//            }}},

//            gender: {required: true},
//            firstName: {required: true},
//            surname: {required: true},
//            dateofBirth: {required: true},
//            placeofBirth: {required: true},
//            nationality: {required: true},
//            workPermit: {required: true},
//            residencePermit: {required: true},
//            taxId: {required: true},
            password: {required: true},
//            socialSecurityNumber: {required: true},
//            email: {required: true,email:true},
//            phoneNumber: {required: true},
//            mobile: {required: true},
//            adresses: {required: true},
//            postcodeCity: {required: true},
//            name: {required: true},
//            bankName: {required: true},
//            iban: {required: true},
//            note: {required: true},


        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });

    };


    return{
        listInit: function () {
            list();
        },
        addInit: function () {
            add_worker();
        },
        editInit: function () {
            edit_worker();
        },
    };
}();