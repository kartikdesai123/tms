var Information = function () {

    var list = function () {

        var workerId = $('#name').val();
        var workplaces = $('#workplaces').val();
        var month = $('#month').val();
        var year = $('#year').val();
        var dataArr = {workerId: workerId, workplaces: workplaces, month:month, year:year};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#informationdatatable',
            'ajaxURL': baseurl + "admin/information/ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0, 1, 3, 7],
            'noSortingApply': [0, 1, 3, 7],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth,
            'stateSave': true,
        };
        getDataTable(arrList);

        $('body').on('click', '.delete', function () {
            var dataid = $(this).attr('data-id');
            var dataurl = $(this).attr('data-url');
            $('.yes-sure').attr('data-id', dataid);
            $('.yes-sure').attr('data-url', dataurl);
        });

        $('.yes-sure').click(function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/timesheet/ajaxAction",
                data: {'action': 'infodeleteTimesheet', 'data': {'id': id}},
                success: function (data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });


        $('body').on('change', '.serchbtn', function () {
            var workerId = $('#name').val();
            var workplaces = $('#workplaces').val();
            var month = $('#month').val();
            var year = $('#year').val();
            var querystring = (workerId == '' && typeof workerId === 'undefined') ? 'name=' : 'name=' + workerId;
            querystring += (workplaces == '' && typeof workplaces === 'undefined') ? '&workplaces=' : '&workplaces=' + workplaces;
            querystring += (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;


//            alert(querystring);
            location.href = baseurl + 'admin/informatiion-list-search?' + querystring;

        });
    };

    var add_information = function () {

        var form = $('#addTimesheet');
        var rules = {
            c_date: {required: true},
            workplaces: {required: true},
            password: {required: true},
            start_time: {required: true},
            end_time: {required: true},
            pause_time: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });

    };


    var edit_information = function () {

        var form = $('#editInformation');
        var rules = {
            reason: {required: false}
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
            add_information();
        },
        editInit: function () {
            edit_information();
        },
    };
}();