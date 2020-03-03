var Dashboard = function() {

    var handleGenral = function() {
        
        $('body').on('change', '#staffId_disease', function() {
             var staffId = $('#staffId_disease option:selected').val();
             var yearDisease = $('#yearDisease option:selected').val();
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        },
                        url: baseurl + "admin/dashboard/ajaxAction",
                        data: {'action': 'staffIdDiseaseList', 'data': {'staffId': staffId,'yearDisease':yearDisease}},
                        success: function(data) {
                            $('.appendDiv').html(data);
                        }
                    });
        });
        
        $('body').on('change', '#selectstautusworker', function() {
                var selectstautusworker = $('#selectstautusworker option:selected').val();
                
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        },
                        url: baseurl + "admin/dashboard/ajaxAction",
                        data: {'action': 'selectstautusworker', 'data': {'selectstautusworker': selectstautusworker}},
                        success: function(data) {
                            $('.appendstatusworkerDiv').html(data);
                        }
                    });
        });
        
        $('body').on('change', '#selectstatus', function() {
                var selectstatus = $('#selectstatus option:selected').val();
                
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        },
                        url: baseurl + "admin/dashboard/ajaxAction",
                        data: {'action': 'selectstatus', 'data': {'selectstatus': selectstatus}},
                        success: function(data) {
                            $('.appendstatusworkerDiv').html(data);
                        }
                    });
        });
        
        
        $('body').on('change', '#staffId_holiday', function() {
             var staffId = $('#staffId_holiday option:selected').val();
             var yearHoliday = $('#yearHoliday option:selected').val();
            
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        },
                        url: baseurl + "admin/dashboard/ajaxAction",
                        data: {'action': 'staffIdHolidayList', 'data': {'staffId': staffId,'yearHoliday':yearHoliday}},
                        success: function(data) {
                            $('.appendHolidayDiv').html(data);
                        }
                    });
        });
        
        
         $('body').on('change', '#yearHoliday', function() {
              var staffId = $('#staffId_holiday option:selected').val();
             var yearHoliday = $('#yearHoliday option:selected').val();
             $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'staffIdHolidayList', 'data': {'staffId': staffId,'yearHoliday':yearHoliday}},
                success: function(data) {
                     $('.appendHolidayDiv').html(data);
                }
            });
        });
        
        
        $('body').on('change', '#yearDisease', function() {
             var staffId = $('#staffId_disease option:selected').val();
             var yearDisease = $('#yearDisease option:selected').val();
             $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'staffIdDiseaseList', 'data': {'staffId': staffId,'yearDisease':yearDisease}},
                success: function(data) {
                    $('.appendDiv').html(data);
                }
            });
        });
        
        
        $('body').on('click', '.findBestStaff', function() {
            var month = $('.staffMonths option:selected').val();
            var year = $('.staffYears option:selected').val();
        });

        $('body').on('click', '.findBestOfice', function() {
            var month = $('.staffMonths option:selected').val();
            var year = $('.staffYears option:selected').val();
        });

        $('.findBestStaff').click(function() {
            var months = $('.staffMonths').val();
            var year = $('.staffYears').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getBestStaffData', 'data': {'months': months, 'year': year}},
                success: function(data) {
                    var data = JSON.parse(data);
                    var Name = (data == '' || data == null ? 'N/A' : data.name)
                    var staffnumber = (data == '' || data == null ? 'N/A' : data.staffnumber)
                    var totalTime = (data == '' || data == null ? 'N/A' : data.totalTime)
                    $('.staffName').text(Name);
                    $('.staffnumber').text(staffnumber);
                    $('.totalHours').text(totalTime);
                }
            });
        });
        $('.findinfo').click(function() {
            var months = $('.findinfoMonths').val();
            var year = $('.findinfoYears').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getNewInfoData', 'data': {'months': months, 'year': year}},
                success: function(data) {
                     $('.c-modal__body').html(data);
                }
            });
        });
        
        
        $('body').on('click', '.findBestOfice', function() {
            restWorkplace();
        });
        
        
        $('body').on('click','.findinfobydate',function(){
            
            var table = $('#newInformation-datatable').DataTable();
            table.destroy();
            var month = $('#month_info').val();            
            var year = $('#year_info').val();            
            var workplace = $('#informationWorkplace').val();
            
            var dataArr = {"month":month,"year":year,"workplace":workplace};
            
            var columnWidth = {};

            var arrList = {
                'tableID': '#newInformation-datatable',
                'ajaxURL':  baseurl + "admin/dashboard-ajaxAction",
                'ajaxAction': 'newInformation',
                'postData': dataArr,
                'hideColumnList': [],
                'noSearchApply': [0],
                'noSortingApply': [],
                'defaultSortColumn': 4,
                'defaultSortOrder': 'ASC',
                'setColumnWidth': columnWidth
            };
            getDataTable(arrList);
        });
        
        $('body').on('click', '.getWorkPlaceData', function() {
            var table = $('#testdatatable').DataTable();
             table.destroy();
            var name = $('#workplaceName').val();
            var months = $('#workplaceMonth').val();
            var year = $('#workplaceYear').val();
            var dataArr = {"name":name,"months":months,"year":year};
            
            var columnWidth = {};

            var arrList = {
                'tableID': '#testdatatable',
                'ajaxURL':  baseurl + "admin/dashboard-ajaxAction",
                'ajaxAction': 'workplacedatatable',
                'postData': dataArr,
                'hideColumnList': [],
                'noSearchApply': [0],
                'noSortingApply': [],
                'defaultSortColumn': 0,
                'defaultSortOrder': 'ASC',
                'setColumnWidth': columnWidth
            };
            getDataTable(arrList);
            $('.wpname').text(name);
            
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getWorkplaceListData', 'data': {'months': months, 'name': name, 'year': year}},
                success: function(data) {
                    $('.totaltime').text('');
                    $('.totaltime').text(data);
                }
            });
        });
        $('body').on('click', '.workplacePDF', function() {
            var name = $('#workplaceName').val();
            var months = $('#workplaceMonth').val();
            var year = $('#workplaceYear').val();
            $('.wpname').text(name);
            var url = baseurl + "admin/workplacepdf?months="+months+"&year="+year+"&name="+name;
           window.open(url, "_blank");
        });
        $('body').on('click', '.staffworkPDF', function() {
            var staffId = $('#staffId option:selected').val();
            var months = $('#staffMonth').val();
            var year = $('#staffYear').val();
            var shortBy = $("input[name='shortBy']:checked").val();
            
            var querystring = (staffId == '' && typeof staffId === 'undefined') ? 'staffId=' : 'staffId=' + staffId;
            querystring += (year == '' && typeof year === 'undefined') ? '&year=' : '&year=' + year;
            querystring += (months == '' && typeof months === 'undefined') ? '&months=' : '&months=' + months;
            querystring += (shortBy == '' && typeof shortBy === 'undefined') ? '&shortBy=' : '&shortBy=' + shortBy;
            $('.wpname').text(name);
            var url = baseurl + "admin/staffworkpdf?" + querystring;
            window.open(url, "_blank");
        });
        $('body').on('click', '.infoBydatePDF', function() {
            var month = $('#month_info').val();
            var year = $('#year_info').val();
            var workplace = $('#informationWorkplace').val();
            $('.wpname').text(name);
            var url = baseurl + "admin/infoBydatePDF?year="+year+"&month="+month+"&workplace="+workplace;
            window.open(url, "_blank");
        });

        function restWorkplace() {
            var months = $('.restMonths').val();
            var year = $('.restYears').val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getRestWorkPlace', 'data': {'months': months, 'year': year}},
                success: function(data) {
                    var data = JSON.parse(data);
                    var workplaces = (data == '' || data == null ? 'N/A' : data.workplaces)
                    var address = (data == '' || data == null ? 'N/A' : data.adresses)
                    var totalTime = (data == '' || data == null ? 'N/A' : data.totalTime)
                    $('.workplaces').text(workplaces);
                    $('.address').text(address);
                    $('.workplaceHours').text(totalTime);
                }
            });
        }

        $('body').on('click', '.getStaffData', function() {
            var table = $('#staffListAppend-datatable').DataTable();
            table.destroy();
             
            var staffId = $('#staffId option:selected').val();
            var months = $('#staffMonth').val();
            var year = $('#staffYear').val();
            var shortBy = $("input[name='shortBy']:checked").val();
            if( shortBy == "c_date"){
                var shortcoloum = 1;
            }else{
                var shortcoloum = 0;
            }
            var dataArr = {"staffId":staffId,"months":months,"year":year,"shortBy":shortBy};
//           $('.staffName').text($('#staffId option:selected').text());
           
            var columnWidth = {};

            var arrList = {
                'tableID': '#staffListAppend-datatable',
                'ajaxURL':  baseurl + "admin/dashboard-ajaxAction",
                'ajaxAction': 'getStaffData',
                'postData': dataArr,
                'hideColumnList': [],
                'noSearchApply': [0],
                'noSortingApply': [],
                'defaultSortColumn': shortcoloum ,
                'defaultSortOrder': 'desc',
                'setColumnWidth': columnWidth
            };
            getDataTable(arrList);
            
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val(), },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getStaffListData', 'data': {'shortBy':shortBy,'months': months, 'staffId': staffId, 'year': year}},
                success: function(data) {
                    var output = JSON.parse(data) ;
                    $(".total_time").text(output.totaltime);
                    $(".disease").text(output.disease);
                    $(".holiday").text(output.holidays);
                    console.log(output.totaltime);
//                    $('.staffListAppend').html(data);
                }
            });
        });

        $('body').on('click', '.printDiv', function() {
            var name = $('#workplaceName').val();
            var months = $('#workplaceMonth').val();
            var year = $('#workplaceYear').val();
            $('.wpname').text(name);
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getWorkplaceListData', 'data': {'months': months, 'name': name, 'year': year}},
                success: function(data) {
                    $('.c-modal__body').append(data);
                    var divToPrint = document.getElementById('DivIdToPrint');
                    var newWin = window.open('', 'Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                    newWin.document.close();
                    setTimeout(function() {
                        newWin.close();
                    }, 10);
                }
            });
        });

        $('body').on('click', '.printStaff', function() {
            var staffId = $('#staffId option:selected').val();
            var months = $('#staffMonth').val();
            var year = $('#staffYear').val();
            $('.staffName').text($('#staffId option:selected').text());
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val(), },
                url: baseurl + "admin/dashboard/ajaxAction",
                data: {'action': 'getStaffListData', 'data': {'months': months, 'staffId': staffId, 'year': year}},
                success: function(data) {
                    $('.staffListAppendPrint').append(data);
                    var divToPrint = document.getElementById('staffToPrint');
                    var newWin = window.open('', 'Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                    newWin.document.close();
                    setTimeout(function() {
                        newWin.close();
                    }, 10);
                }
            });
        });

    }
    return {
        init: function() {
            handleGenral();
            $('.findBestOfice').trigger('click');
            $('.findBestStaff').trigger('click');
        }
    }
}();
