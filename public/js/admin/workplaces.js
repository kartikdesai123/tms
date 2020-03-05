var Workplaces = function () {
    var list = function () {
        /*$('#delete_checkbox').click(function() {
         
         var delid = new Array();
         $("input:checked").each(function() {
         delid.push($(this).val());
         });
         });*/

        var dataArr = {};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#workplacedatatable',
            'ajaxURL': baseurl + "admin/workplaces/ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0, 1, 4],
            'noSortingApply': [0, 1, 4],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth,
            'stateSave': true,
        };
        getDataTable(arrList);

        $('#delete_checkboxd').click(function () {
            var delid = new Array();
            var cname = new Array();
            $("input:checked").each(function () {
                delid.push($(this).val());
                cname.push($(this).attr('data-name'));
            });

            if (delid == '')
            {
                alert('Please Select checkbox');
                return false;
            } else
            {
                // alert(delid);
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "admin/workplaces/ajaxActions",
                    data: {'action': 'delWorkplaces', 'data': {'id': delid, name: cname}},
                    success: function (data) {
                        handleAjaxResponse(data);
                        //                    var data = JSON.parse(data);
                    }
                });
                return false;
            }

        });

        $("#selectall").click(function () {
            $('.case').not(this).prop('checked', this.checked);
        });



        $('body').on("click", ".delete", function () {
            var dataid = $(this).attr('data-id');
            var dataurl = $(this).attr('data-url');
            $('.yes-sure').attr('data-id', dataid);
            $('.yes-sure').attr('data-url', dataurl);


            $('body').on("click", ".yes-sure", function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "admin/workplaces/ajaxAction",
                    data: {'action': 'deleteWorkplaces', 'data': {'id': id}},
                    success: function (data) {
                        handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                    }
                });
            });
        });

        $('#checkbox_delete').click(function () {
            var dataid = $(this).attr('data-id');
            var dataurl = $(this).attr('data-url');
            $('.yes-sure').attr('data-id', dataid);
            $('.yes-sure').attr('data-url', dataurl);


            $('.yes-sure').click(function () {

                var id = $(this).attr('data-id');
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                    },
                    url: baseurl + "admin/workplaces/ajaxActions",
                    data: {'action': 'delWorkplaces', 'data': {'id': id}},
                    success: function (data) {
                        handleAjaxResponse(data);
                        var data = JSON.parse(data);
                    }
                });
            });

        });

    };


    var add_workplacest = function () {

        var form = $('#addWorkplaces');
        var rules = {
            company: {required: true},
            adresses: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form);
        });

    };

    var edit_workplacest = function () {

        var form = $('#editWorkplaces');
        var rules = {
            first_name: {required: true},
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
            add_workplacest();
        },
        editInit: function () {
            edit_workplacest();
        },
    };
}();