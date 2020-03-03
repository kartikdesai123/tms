
var Superviseor = function() {
    
    var add_timesheet = function() {
        
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
            reason: {required: false}
        };
        handleFormValidate(form, rules, function(form) {
            handleAjaxFormSubmit(form);
        });
    };
    
    var edit_information=function(){
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
    var list = function(){
        $('body').on('change','.serchbtn',function(){
            var workerId =$('#name').val();
            var workplaces =$('#workplaces').val();
            var month =$('#month').val();
            var year =$('#year').val();
            var querystring = (workerId == '' && typeof workerId === 'undefined') ? 'name=' : 'name=' + workerId;
            querystring += (workplaces == '' && typeof workplaces === 'undefined') ? '&workplaces=' : '&workplaces=' + workplaces;
            querystring += (month == '' && typeof month === 'undefined') ? '&month=' : '&month=' + month;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
//            alert(querystring);
            location.href = baseurl + 'supervisor/information-search-list?' + querystring ;
             
        });
    };
    return{
      
        editInit: function(){
            edit_timesheet();
        },
        informationInit:function(){
            edit_information();
        },
        informationListInit:function(){
            list();
        },
    };
}();