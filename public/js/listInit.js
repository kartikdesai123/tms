var Timesheet = function() {

    var list = function() {

        $('.delete').click(function() {
            var dataid = $(this).attr('data-id');
            
            $('.yes-sure').attr('data-id', dataid);
            
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
            
            
            location.href = baseurl + 'admin/timesheet-list-search?' + querystring ;
             
        });
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