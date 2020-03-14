var Timesheet = function() {

    var list = function() {
        
//        if(sessionStorage.getItem("year") == null){ var year = $('#year').val(); }else{ var year =  sessionStorage.getItem("year");}
//        if(sessionStorage.getItem("name") == null){ var workerId = $('#name').val(); }else{ var workerId =  sessionStorage.getItem("name");}
//        if(sessionStorage.getItem("workplaces") == null){ var workplaces = $('#workplaces').val(); }else{ var workplaces =  sessionStorage.getItem("workplaces");}
//        if(sessionStorage.getItem("month") == null){ var month = $('#month').val(); }else{ var month =  sessionStorage.getItem("month");}
        
//        sessionStorage.clear();
        var workerId = $('#name').val();
        var workplaces = $('#workplaces').val();
        var month = $('#month').val();
        var year = $('#year').val();
        
        var dataArr = {workerId: workerId, workplaces: workplaces, month:month, year:year};
        var columnWidth = {"width": "10%", "targets": 0};

        var arrList = {
            'tableID': '#timesheetdatatable',
            'ajaxURL': baseurl + "admin/timesheet/ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0,1],
            'noSortingApply': [0],
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
                url: baseurl + "admin/timesheet/ajaxAction",
                data: {'action': 'deleteTimesheet', 'data': {'id': id }},
                success: function(data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });
        
        $('body').on('change','.serchbtn',function(){
            var workerId =$('#name').val();
            var workplaces =$('#workplaces').val();
            var month =$('#month').val();
            var year =$('#year').val();
            var querystring = (workerId == '' && typeof workerId === 'undefined') ? 'name=' : 'name=' + workerId;
            querystring += (workplaces == '' && typeof workplaces === 'undefined') ? '&workplaces=' : '&workplaces=' + workplaces;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
            querystring += (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;
            
            
            location.href = baseurl + 'admin/timesheet-list-search?' + querystring ;
             
        });
        
//        $('body').on('click','.edittimesheet',function(){
//            var workerId =$('#name').val();
//            var workplaces =$('#workplaces').val();
//            var month =$('#month').val();
//            var year =$('#year').val();
//            sessionStorage.setItem("name", workerId);
//            sessionStorage.setItem("workplaces", workplaces);
//            sessionStorage.setItem("month", month);
//            sessionStorage.setItem("year", year);
//        });
    };
    var listSuper = function(){
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
                url: baseurl + "admin/timesheet/ajaxAction",
                data: {'action': 'deleteTimesheet', 'data': {'id': id }},
                success: function(data) {
                    handleAjaxResponse(data);
//                    var data = JSON.parse(data);
                }
            });
        });
        
        $('body').on('change','.serchbtn',function(){
            var workerId =$('#name').val();
            var workplaces =$('#workplaces').val();
            var month =$('#month').val();
            var year =$('#year').val();
            var querystring = (workerId == '' && typeof workerId === 'undefined') ? 'name=' : 'name=' + workerId;
            querystring += (workplaces == '' && typeof workplaces === 'undefined') ? '&workplaces=' : '&workplaces=' + workplaces;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
            querystring += (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;
            
            
            location.href = baseurl + 'supervisor/timesheet-search?' + querystring ;
             
        });
    };
    var add_timesheet = function() {

        var form = $('#addTimesheet');
        var rules = {

            c_date: {required: true},
            workplaces: {required: true},
            password: {required: true},
            start_time: {required: true},
            end_time: {required: true},
            pause_time: {required: true}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });

    };

    var handleEditTimeSheet = function(){
        var form = $('#editTimeSheet');
        var rules = {

            start_date: {required: true},
            workplaces: {required: true},
            start_time: {required: true},
            end_time: {required: true},
            pause_time: {required: true},
            reason: {required: false}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    }
    
    
    return{
        listInit: function() {
            list();
        },
        addInit: function() {
            add_timesheet();
        },
        editInit : function(){
            handleEditTimeSheet();
        },
        listInitSuper : function(){
            listSuper();
        },
    };
}();