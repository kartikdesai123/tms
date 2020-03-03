var HolidayList = function () {

    var list = function () {

        var workerId = $('#name1').val();
        var month = $('#month').val();
        var year = $('#year').val();
        var dataArr = {workerId: workerId, month: month, year: year};
        var columnWidth = {"width": "10%", "targets": 0};
        var arrList = {
            'tableID': '#holidaydatatable',
            'ajaxURL': baseurl + "admin/holiday/ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0, 2, 3, 4, 5, 6],
            'noSortingApply': [0, 2, 3, 4, 5, 6],
            'defaultSortColumn': 1,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth,
            'stateSave': true,
        };
        getDataTable(arrList);

        $('body').on('click', '.paidBtn', function () {
            var id = $(this).val();
            if (this.checked) {
                var value = "paid";
            } else {
                var value = "unpaid"
            }
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/paidAction",
                data: {'id': id, 'value': value},
                success: function (data) {
                    handleAjaxResponse(data);
                    //                    var data = JSON.parse(data);
                }
            });
        });

        $('body').on('change', '.serchbtn', function () {
            var workerId = $('#name1').val();
            var month = $('#month').val();
            var year = $('#year').val();
            var querystring = (workerId == '' && typeof workerId === 'undefined') ? 'name=' : 'name=' + workerId;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
            querystring += (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;


            location.href = baseurl + 'admin/holiday-list-search?' + querystring;

        });

        $('body').on('click', '.delete', function () {
            var dataid = $(this).attr('data-id');
            $('.yes-sure').attr('data-id', dataid);
        });

        $('.yes-sure').click(function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/holiday/ajaxAction",
                data: {'action': 'deleteholiday', 'data': {'id': id}},
                success: function (data) {
                    handleAjaxResponse(data);
                }
            });
        });
        $("#selectall").click(function () {
            $('.deleteClass').not(this).prop('checked', this.checked);
        });

        var form = $('#addHolidays');
        var rules = {
            nameWorker: {required: true},
            start_date: {required: true},
            end_date: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });

        var form = $('#deleteHolidays');
        var rules = {
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
    }

    var edit = function () {
        var form = $('#editHolidays');
        var rules = {
            nameWorker: {required: true},
            start_date: {required: true},
            end_date: {required: true},
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });
    }

    return{
        listInit: function () {
            list();
        },
        listEdit: function () {
            edit();
        },
    };
}();