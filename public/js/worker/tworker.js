var TWorker = function() {
    
    var add_timesheet = function() {
        $('body').on('change','.serchbtn',function(){
            var workplace= $('#workplacesserch').val();
            var month= $('#month').val();
            var year= $('#year').val();
            
//            var querystring = (workerId == '' && typeof workerId === 'undefined') ? 'name=' : 'name=' + workerId;
            var querystring = (workplace == '' && typeof workplace === 'undefined') ? '&workplaces=' : '&workplaces=' + workplace;
            querystring += (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
            
            location.href = baseurl + 'worker/workerdash-search-list?' + querystring ;
             
        })
        var form = $('#addTimesheet');
        var rules = {
            select_date: {required: true},
            workplaces: {required: true},
            start_time: {required: true},
            end_time: {required: true},
            pause_time: {required: true}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });

    };
    
    var add_timesheet_superviser = function() {
        
        $('body').on('change','.serchbtn',function(){
            
            var workplace= $('#workplacesserch').val();
            var month= $('#month').val();
            var year= $('#year').val();
            
//            var querystring = (workerId == '' && typeof workerId === 'undefined') ? 'name=' : 'name=' + workerId;
            var querystring = (workplace == '' && typeof workplace === 'undefined') ? '&workplaces=' : '&workplaces=' + workplace;
            querystring += (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
            
            location.href = baseurl + 'supervisor/dash-search-list?' + querystring ;
             
        });
        
        var form = $('#addTimesheet');
        var rules = {
            select_date: {required: true},
            workplaces: {required: true},
            start_time: {required: true},
            end_time: {required: true},
            pause_time: {required: true}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });

    };
    var edit_timesheet = function() {
       
        var form = $('#editInformation');
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
    };
    
    return{
        addInit: function() {
            add_timesheet();
        },
        editInit: function(){
            edit_timesheet();
        },
        addInitSuper:function(){
            add_timesheet_superviser();
        },
    };
}();