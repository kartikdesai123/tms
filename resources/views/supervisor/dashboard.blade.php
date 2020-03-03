

@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<div class="container-fluid">
        @if ( Session::has('flash_message') )
            <div class="c-alert c-alert--success alert fade show">
                <i class="c-alert__icon fa fa-times-circle"></i> {{ Session::get('flash_message') }}
                <button class="c-close" data-dismiss="alert" type="button">×</button>
            </div>
        @endif
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="timesheet-add" id="addTimesheet" action="{{ route('customer-dashboard') }}" method="post">
                            <div class="row"><input class="c-input" type="hidden" name="worker_id" id="worker_id" value="{{ $detail['id'] }}"> 
                                           <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" /> 
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                           <label class="c-field__label" for="type">{{ trans('words.select-date') }}</label>
                                           <input id="datepicker" name="select_date" class=" c-input" type="text" />
                                           
                                    </div>
                                </div>
                                @php
                                    $count = 1;
                                    $workplaces_array = array();
                                    $workplaces_array = explode(',',$arrWorkplaces);
                                @endphp
                                 <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.workerplace') }}</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input" id="workplaces" name="workplaces">
                                        <option value="other">Other</option>
                                        @for($i = 0 ;$i < count($workplaces_array);$i++,$count++)
                                        <option value="{{ $workplaces_array[$i] }}">{{ $workplaces_array[$i] }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.start-time') }}</label>
                                        <input id="start_time" name="start_time" class="c-input" type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.end-time') }}</label>
                                        <input id="end_time" name="end_time" class="c-input" type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.pause-time') }}</label>
                                       <input id="pause_time" name="pause_time" value="01:00" class="c-input" type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.wo-reason') }}</label>
                                        <input name="reason" class="c-input" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.add') }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- // .col-12 -->
    </div>
</div><!-- // .container -->

<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('dash-search-list') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b></b></h1>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.workerplace') }}</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input serchbtn" id="workplacesserch" name="workplaces">
                                        <option value="" >All</option>
                                        <option value="other" {{ ($serchbardetails['workplaces'] == 'other' ? 'selected="selected"' : '') }}>Other</option>
                                        @for($i = 0 ;$i < count($workplaces_array);$i++,$count++)
                                         <option value="{{ $workplaces_array[$i] }}" {{ ($workplaces_array[$i] == $serchbardetails['workplaces'] ? 'selected="selected"' : '') }} >{{ $workplaces_array[$i] }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div> 
                                
                                <div class="col-lg-4">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.mon')}}</label>
                                         @php
                                        $month=['January','February','March','April','May','June','July','August','September','October','November','December'];
                                        $Nomonth=['01','02','03','04','05','06','07','08','09','10','11','12'];
                                        @endphp
                                        <select class="c-input serchbtn" id="month" name="month">
                                        <option value="">{{ trans('words.month')}}</option>
                                        @for($i = 0 ;$i < count($month);$i++)
                                        <option value="{{ $Nomonth[$i] }}" {{ ($Nomonth[$i] == $serchbardetails['month'] ? 'selected="selected"' : '') }}>{{ trans('words.'.$month[$i]) }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.ye')}}</label>
                                        @php
                                        $year =date("Y");
                                        $startyear=$year - 5 ;
                                        $endyear=$year + 2 ;
                                        @endphp
                                        <select class="c-input serchbtn" id="year" name="year">
                                        <option value="">{{ trans('words.year')}}</option>
                                        @for($i = $startyear ;$i <= $endyear;$i++)
                                        <option value="{{ $i }}" {{ ($i == $serchbardetails['year'] ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- // .col-12 -->
    </div>
</div><!-- // .container -->


<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-table-responsive">
                <table class="c-table" id="datatable">
                    <caption class="c-table__title">
                         <span>{{ trans('words.timesheet-list') }}</span>
                        <span class="pull-right c-badge u-h5 c-badge--success"><i class="fa fa-clock-o"></i>{{ trans('words.total_time') }} : {{ $totaltime}} </span>
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.id') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.date') }}  </th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.workerplace') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.start-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.end-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.pause-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.total') }}&nbsp;&nbsp;</th>
                            
                            <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.wo-reason') }}</th>
							<th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                         @php
                        $count = 1;
                        @endphp
                        @if(count($arrTimesheet) > 0)
                            @for($i = 0 ;$i < count($arrTimesheet);$i++,$count++)   
                                <tr class="c-table__row">
                                <td class="c-table__cell">{{ $count }}</td>
                                <td class="c-table__cell"><?php                                     
                                         $newDate = date("d.m.Y", strtotime($arrTimesheet[$i]->c_date));
                                         ?>{{ $newDate }}</td>
                                <td class="c-table__cell">{{ $arrTimesheet[$i]->workplaces }}</td>
                                <td class="c-table__cell">{{ $arrTimesheet[$i]->start_time }}</td>
                                <td class="c-table__cell">{{ $arrTimesheet[$i]->end_time }}</td>
                                <td class="c-table__cell">{{ $arrTimesheet[$i]->pause_time }}</td>
                                <td class="c-table__cell">{{ $arrTimesheet[$i]->total_time }}</td>

                                <td class="c-table__cell">{{ $arrTimesheet[$i]->reason }}</td>
                                                            <td class="c-table__cell"><span class="c-tooltip c-tooltip--top"  aria-label="{{ trans('words.edit') }}">
                                            <a href=" {{ route('information-supervisor-edit',[$arrTimesheet[$i]->id])}} "><span class="c-tooltip c-tooltip--top"  aria-label="{{ trans('words.edit') }}">
                                        <i class="fa fa-edit" ></i></span>
                                    </a></td>
                            </tr>
                            @endfor
                        @else
                            <tr class="c-table__row">
                                <td class="c-table__cell" colspan="9" style="text-align: center;color:red"> No records found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div><!-- // .col-12 -->
        </div>
    </div>

</div><!-- // .container -->



    <script type="text/javascript">
        /* time picker javascript*/
            $('#start_time').timepicker();
            $('#end_time').timepicker();
            $('#pause_time').timepicker();
    </script>
<style type="text/css">
    .success {
    opacity: 1;
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #ebccd1;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
.closebtn {
    padding-left: 15px;
    color: #000;
    font-weight: bold;
    float: right;
    font-size: 20px;
    line-height: 18px;
    cursor: pointer;
    transition: 0.3s;
}
.c-table-responsive .c-table {
    display: inline-table !important;
    overflow-y: hidden;
}
</style>
<script>
$(document).ready(function(){
    $(".closebtn").click(function(){
        $(".success").hide();
    });
});
</script>
@endsection
