@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
@php $startyear = (date('Y')-2);
$count = 1;
@endphp 

<div class="container-fluid">
    @if ( Session::has('flash_message') )
    <div class="c-alert c-alert--success alert fade show">
        <i class="c-alert__icon fa fa-times-circle"></i> {{ Session::get('flash_message') }}
        <button class="c-close" data-dismiss="alert" type="button">×</button>
    </div>
    @endif
    <form name="timesheet-add" id="addTimesheet" action="{{ route('admin-dashboard') }}" method="post">
        <div class="row">
            <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
            <div class="col-xl-6">
                <div class="c-progress-card" data-mh="graph-cards">
                    <h3 class="c-progress-card__title">{{ trans('words.disease') }}</h3>
                    <br/>
                    <div class="row">
                        <div class="col-8">
                            <select class="c-select" name="staffId" id="staffId_disease">
                                @if(count($getStaff) > 0)
                                <option value="">{{ trans('words.allWorkers') }}</option>
                                @for($i = 0 ;$i < count($getStaff);$i++,$count++)
                                <option class="has-error" value="{{ $getStaff[$i]->id }}"> {{ $getStaff[$i]->name }} {{ $getStaff[$i]->surname }}</option>
                                @endfor
                                @else
                                <option value="">No any Worker</option>
                                @endif

                            </select>
                        </div>
                        <div class="col-4">
                            <select class="c-select" id="yearDisease" name="year">
                                @for($i=$startyear; $i<=($startyear+10); $i++)
                                <option value="{{ $i }}" {{ ($year == $i ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="appendDiv">
                        <div style="height:200px;overflow:scroll">
                            <div class="row">
                                <div class="col-12" style="background-color: #eff3f6">
                                    <div class="col-8 pull-left">
                                        <span style="color: red">{{ trans('words.dash_name') }}</span>
                                    </div>

                                    <div class="col-4 pull-right">
                                        <span style="color: red">{{ trans('words.dash_total_day') }}</span>
                                    </div>
                                </div>
                                @foreach($countDisease as $key => $value)
                                <div class="col-12">
                                    <div class="col-8 pull-left">
                                        <span>{{ $value['name']." ".$value['surname']}}</span>
                                    </div>

                                    <div class="col-4 pull-right">
                                        <span>{{ $value['total']}}</span>
                                    </div>
                                    <hr>  
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @php
                        $total = 0;
                        foreach($countDisease as $key => $value){
                        $total = $total + $value['total'];
                        }
                        @endphp
                        <div class="row">
                            <div class="col-12"><br>
                                <div class="pull-right">
                                    <span><b>{{ trans('words.totalDays') }} : {{ $total }}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="c-progress-card" data-mh="graph-cards">
                    <h3 class="c-progress-card__title">{{ trans('words.holiday') }}</h3>
                    <br/>
                    <div class="row">

                        <div class="col-8">
                            <select class="c-select" name="staffId" id="staffId_holiday">
                                @if(count($getStaff) > 0)
                                <option value="">{{ trans('words.allWorkers') }}</option>
                                @for($i = 0 ;$i < count($getStaff);$i++,$count++)
                                <option value="{{ $getStaff[$i]->id }}">{{ $getStaff[$i]->name }} {{ $getStaff[$i]->surname }}</option>
                                @endfor
                                @else
                                <option value="">No any worker</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-4">
                            <select class="c-select" id="yearHoliday" name="year">
                                @for($i=$startyear; $i<=($startyear+10); $i++)
                                <option value="{{ $i }}" {{ ($year == $i ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="appendHolidayDiv">
                        <div style="height:200px;overflow:scroll">
                            <div class="row">
                                <div class="col-12" style="background-color: #eff3f6">
                                    <div class="col-6 pull-left">
                                        <span style="color: red">{{ trans('words.dash_name') }}</span>
                                    </div>

                                    <div class="col-2 pull-right">
                                        <span style="color: red">{{ trans('words.dash_total_day') }}</span>
                                    </div>

                                    <div class="col-2 pull-right">
                                        <span style="color: red">{{ trans('words.dash_remained') }}</span>
                                    </div>

                                    <div class="col-2 pull-right">
                                        <span style="color: red">{{ trans('words.dash_taken') }}</span>
                                    </div>

                                </div> 
                                @foreach($countHolidays as $key => $value)
                                <div class="col-12">
                                    <div class="col-6 pull-left">
                                        <span>{{ $value['name']." ".$value['surname']}}</span>
                                    </div>

                                    <div class="col-2 pull-right">
                                        @if($value['totalHolidays'] == NULL || $value['totalHolidays'] == '')
                                        <span>0</span>
                                        @else
                                        <span>{{ $value['totalHolidays'] }}</span>
                                        @endif
                                    </div>

                                    <div class="col-2 pull-right">
                                        <span>{{ $value['totalHolidays'] - $value['total']}}</span>
                                    </div>

                                    <div class="col-2 pull-right">

                                        <span>{{ $value['total']}}</span>
                                    </div>
                                    <hr>  
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="c-progress-card" data-mh="graph-cards">
                    <h3 class="c-progress-card__title">Status</h3>
                    <br/>
                    <div class="row">
                        <div class="col-8">
                            <select class="c-select" name="staffId" id="selectstautusworker">
                                @if(count($getStaff) > 0)
                                <option value="all">{{ trans('words.allWorkers') }}</option>
                                @for($i = 0 ;$i < count($getStaff);$i++,$count++)
                                <option value="{{ $getStaff[$i]->id }}">{{ $getStaff[$i]->name }} {{ $getStaff[$i]->surname }}</option>
                                @endfor
                                @else
                                <option value="">No any Worker</option>
                                @endif

                            </select>
                        </div>
                        <div class="col-4">
                            <select class="c-select" id="selectstatus" name="year">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="appendstatusworkerDiv">
                        <div style="height:200px;overflow:scroll">
                            <div class="row">
                                <div class="col-12" style="background-color: #eff3f6">
                                    <div class="col-8 pull-left">
                                        <span style="color: red">{{ trans('words.dash_name') }}</span>
                                    </div>

                                    <div class="col-4 pull-right" style="padding-left: 35px;">
                                        <span style="color: red"> Status</span>
                                    </div>
                                </div>
                                @php    
                                $active = 0;
                                $inactive = 0;
                                @endphp
                                @foreach($getStaff as $key => $value)
                                <div class="col-12">
                                    <div class="col-8 pull-left">
                                        <span>{{ $value['name']." ".$value['surname']}}</span>
                                    </div>
                                    @php    

                                    $endcontratDate = date('Y-m-d',strtotime($value['endContract']));
                                    $alertData = date('Y-m-d', strtotime('-56 days', strtotime($value['endContract'])));
                                    $currentDate = date("Y-m-d");

                                    if($currentDate < $endcontratDate){
                                    $active ++;
                                    @endphp
                                    <div class="col-4 pull-right" style="padding-left: 35px;">
                                        <span><i class="fa fa-circle" style="color:#34aa44;"></i></span>
                                    </div>
                                    @php}
                                    else{
                                    $inactive ++;
                                    @endphp
                                    <div class="col-4 pull-right" style="padding-left: 35px;"> 
                                        <span><i class="fa fa-circle" style="color:#ed1c24;"></i></span>
                                    </div>

                                    @php}
                                    @endphp

                                    <hr>  
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12"><br>
                                <div class="pull-right">
                                    <span><b>Active Worker : {{ $active }}/ Inactive Worker : {{ $inactive }}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4">
                <div class="c-graph-card" data-mh="graph-cards" style="height: 415px !important;">
                    <div class="c-graph-card__content">
                        <h3 class="c-graph-card__title">{{ trans('words.Information') }}</h3>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select" name="informationWorkplace" id="informationWorkplace">
                                    @if(count($getStaff) <= 0)
                                    <option value="">No Workplaces</option>
                                    @else
                                    <option value="">All Workplaces</option>
                                    @foreach($getWorkPlace as $val => $row)
                                    <option value="{{ $row->company }}">{{ $row->company }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select" id="month_info" name="month">
                                    <option value="">{{ trans('words.month') }}</option>
                                    <option value="01" {{ ($months == "01" ? 'selected="selected"' : '') }}>01</option>
                                    <option value="02" {{ ($months == "02" ? 'selected="selected"' : '') }}>02</option>
                                    <option value="03" {{ ($months == "03" ? 'selected="selected"' : '') }}>03</option>
                                    <option value="04" {{ ($months == "04" ? 'selected="selected"' : '') }}>04</option>
                                    <option value="05" {{ ($months == "05" ? 'selected="selected"' : '') }}>05</option>
                                    <option value="06" {{ ($months == "06" ? 'selected="selected"' : '') }}>06</option>
                                    <option value="07" {{ ($months == "07" ? 'selected="selected"' : '') }}>07</option>
                                    <option value="08" {{ ($months == "08" ? 'selected="selected"' : '') }}>08</option>
                                    <option value="09" {{ ($months == "09" ? 'selected="selected"' : '') }}>09</option>
                                    <option value="10" {{ ($months == "10" ? 'selected="selected"' : '') }}>10</option>
                                    <option value="11" {{ ($months == "11" ? 'selected="selected"' : '') }}>11</option>
                                    <option value="12" {{ ($months == "12" ? 'selected="selected"' : '') }}>12</option>
                                </select>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select" id="year_info" name="year">
                                    <option value="">{{ trans('words.year') }}</option>
                                    @for($i=$startyear; $i<=($startyear+10); $i++)
                                    <option value="{{ $i }}" {{ ($year == $i ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <div class="c-btn-group">
                                    <div class="col-4">
                                        <a data-toggle="modal" data-target="#newInformation" class="c-btn c-btn--success findinfobydate" href="javascript:;">
                                            <i class="fa fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="c-btn c-btn--success infoBydatePDF" href="javascript:;">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </div>


                                    <div class="col-4">
                                        <a class="c-btn c-btn--success infoBydatePDF" href="javascript:;">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="c-graph-card" data-mh="graph-cards">
                    <div class="c-graph-card__content">
                        <h3 class="c-graph-card__title">{{ trans('words.Workplaces') }}</h3>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select" name="workplaceName" id="workplaceName">
                                    @if(count($getWorkPlace) <= 0)
                                    <option value="">No any Workplaces</option>
                                    @else
                                    @foreach($getWorkPlace as $val => $row)
                                    <option value="{{ $row->company }}">{{ $row->company }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select" id="workplaceMonth" name="workplaceMonth">
                                    <option value="">{{ trans('words.month') }}</option>
                                    <option value="01" {{ ($months == "01" ? 'selected="selected"' : '') }}>01</option>
                                    <option value="02" {{ ($months == "02" ? 'selected="selected"' : '') }}>02</option>
                                    <option value="03" {{ ($months == "03" ? 'selected="selected"' : '') }}>03</option>
                                    <option value="04" {{ ($months == "04" ? 'selected="selected"' : '') }}>04</option>
                                    <option value="05" {{ ($months == "05" ? 'selected="selected"' : '') }}>05</option>
                                    <option value="06" {{ ($months == "06" ? 'selected="selected"' : '') }}>06</option>
                                    <option value="07" {{ ($months == "07" ? 'selected="selected"' : '') }}>07</option>
                                    <option value="08" {{ ($months == "08" ? 'selected="selected"' : '') }}>08</option>
                                    <option value="09" {{ ($months == "09" ? 'selected="selected"' : '') }}>09</option>
                                    <option value="10" {{ ($months == "10" ? 'selected="selected"' : '') }}>10</option>
                                    <option value="11" {{ ($months == "11" ? 'selected="selected"' : '') }}>11</option>
                                    <option value="12" {{ ($months == "12" ? 'selected="selected"' : '') }}>12</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select filter workplaceYear" id="workplaceYear" name="workplaceYear">
                                    <option value="">{{ trans('words.year') }}</option>
                                    @for($i=$startyear; $i<=($startyear+10); $i++)
                                    <option value="{{ $i }}" {{ ($year == $i ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <div class="c-btn-group">
                                    <div class="col-4">
                                        <a data-toggle="modal" data-target="#workPlaceList" class="c-btn c-btn--success getWorkPlaceData" href="javascript:;">
                                            <i class="fa fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="c-btn c-btn--success printDiv workplacePDF" href="javascript:;">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="c-btn c-btn--success workplacePDF" href="javascript:;">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="c-graph-card" data-mh="graph-cards">
                    <div class="c-graph-card__content">
                        <h3 class="c-graph-card__title">{{ trans('words.WORKER') }}</h3>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select" name="staffId" id="staffId">
                                    @if(count($getStaff) <= 0)
                                    <option value="">No any Worker</option>
                                    @else
                                    @for($i = 0 ;$i < count($getStaff);$i++,$count++)
                                    <option value="{{ $getStaff[$i]->id }}">{{ $getStaff[$i]->name }} {{ $getStaff[$i]->surname }}</option>
                                    @endfor
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select" id="staffMonth" name="staffMonth">
                                    <option value="">{{ trans('words.month') }}</option>
                                    <option value="01" {{ ($months == "01" ? 'selected="selected"' : '') }}>01</option>
                                    <option value="02" {{ ($months == "02" ? 'selected="selected"' : '') }}>02</option>
                                    <option value="03" {{ ($months == "03" ? 'selected="selected"' : '') }}>03</option>
                                    <option value="04" {{ ($months == "04" ? 'selected="selected"' : '') }}>04</option>
                                    <option value="05" {{ ($months == "05" ? 'selected="selected"' : '') }}>05</option>
                                    <option value="06" {{ ($months == "06" ? 'selected="selected"' : '') }}>06</option>
                                    <option value="07" {{ ($months == "07" ? 'selected="selected"' : '') }}>07</option>
                                    <option value="08" {{ ($months == "08" ? 'selected="selected"' : '') }}>08</option>
                                    <option value="09" {{ ($months == "09" ? 'selected="selected"' : '') }}>09</option>
                                    <option value="10" {{ ($months == "10" ? 'selected="selected"' : '') }}>10</option>
                                    <option value="11" {{ ($months == "11" ? 'selected="selected"' : '') }}>11</option>
                                    <option value="12" {{ ($months == "12" ? 'selected="selected"' : '') }}>12</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <select class="c-select filter staffYear" id="staffYear" name="staffYear">
                                    <option value="">{{ trans('words.year') }}</option>
                                    @for($i=$startyear; $i<=($startyear+10); $i++)
                                    <option value="{{ $i }}" {{ ($year == $i ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col u-mb-medium">
                                <div>
                                    <input type="radio" name='shortBy' value="c_date" checked="checked"> {{ trans('words.shortByDate')}}
                                </div>
                                <div>
                                    <input type="radio" name='shortBy' value="workplaces"> {{ trans('words.shortByWorkplace')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col u-mb-medium">
                                <div class="c-btn-group">
                                    <div class="col-4">
                                        <a data-toggle="modal" data-target="#staffPlaceList" class="c-btn c-btn--success getStaffData" href="javascript:;">
                                            <i class="fa fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="c-btn c-btn--success printStaff staffworkPDF" href="javascript:;">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="c-btn c-btn--success staffworkPDF" href="javascript:;">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-4">
                <div class="c-graph-card" data-mh="graph-cards">
                    <div class="c-graph-card__content">
                        <h3 class="c-graph-card__title">{{ trans('words.best-worker') }}</h3>
                        <div class="row">
                            <div class="col-4">
                                <select class="c-select staffMonths" id="month" name="month">
                                    <option value="01" {{ ($months == "01" ? 'selected="selected"' : '') }}>01</option>
                                    <option value="02" {{ ($months == "02" ? 'selected="selected"' : '') }}>02</option>
                                    <option value="03" {{ ($months == "03" ? 'selected="selected"' : '') }}>03</option>
                                    <option value="04" {{ ($months == "04" ? 'selected="selected"' : '') }}>04</option>
                                    <option value="05" {{ ($months == "05" ? 'selected="selected"' : '') }}>05</option>
                                    <option value="06" {{ ($months == "06" ? 'selected="selected"' : '') }}>06</option>
                                    <option value="07" {{ ($months == "07" ? 'selected="selected"' : '') }}>07</option>
                                    <option value="08" {{ ($months == "08" ? 'selected="selected"' : '') }}>08</option>
                                    <option value="09" {{ ($months == "09" ? 'selected="selected"' : '') }}>09</option>
                                    <option value="10" {{ ($months == "10" ? 'selected="selected"' : '') }}>10</option>
                                    <option value="11" {{ ($months == "11" ? 'selected="selected"' : '') }}>11</option>
                                    <option value="12" {{ ($months == "12" ? 'selected="selected"' : '') }}>12</option>
                                </select>
                            </div>

                            <div class="col-4">

                                <select class="c-select filter staffYears" id="year" name="year">
                                    @for($i=$startyear; $i<=($startyear+10); $i++)
                                    <option value="{{ $i }}" {{ ($year == $i ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-4">
                                <button type="button" class="c-btn c-btn--info findBestStaff"><i class="fa fa-search" aria-hidden="true"></i></button>     
                            </div>
                        </div>
                        <h4 class="c-graph-card__number center staffName" ></h4>
                        <h4 class="center" ><b>{{ trans('words.staff-number') }}</b>:<label class="staffnumber">@if(count($arrInformation) > 0) {{ $arrBeststaff[0]->staffnumber }} @endif</label></h4>
                        <h4  class="center"><b class="totalHours">@if(count($arrInformation) > 0) {{ $arrBeststaff[0]->total_houres }} @endif</b>: hours</h4>    
                    </div>
                </div> 
            </div>	
            <div class="col-xl-4">
                <div class="c-graph-card" data-mh="graph-cards">
                    <div class="c-graph-card__content">
                        <h3 class="c-graph-card__title"> {{ trans('words.best-workplaces') }}</h3>
                        <div class="row">
                            <div class="col-4">
                                <select class="c-select restMonths" id="month1" name="month1">
                                    <option value="01" {{ ($months == "01" ? 'selected="selected"' : '') }}>01</option>
                                    <option value="02" {{ ($months == "02" ? 'selected="selected"' : '') }}>02</option>
                                    <option value="03" {{ ($months == "03" ? 'selected="selected"' : '') }}>03</option>
                                    <option value="04" {{ ($months == "04" ? 'selected="selected"' : '') }}>04</option>
                                    <option value="05" {{ ($months == "05" ? 'selected="selected"' : '') }}>05</option>
                                    <option value="06" {{ ($months == "06" ? 'selected="selected"' : '') }}>06</option>
                                    <option value="07" {{ ($months == "07" ? 'selected="selected"' : '') }}>07</option>
                                    <option value="08" {{ ($months == "08" ? 'selected="selected"' : '') }}>08</option>
                                    <option value="09" {{ ($months == "09" ? 'selected="selected"' : '') }}>09</option>
                                    <option value="10" {{ ($months == "10" ? 'selected="selected"' : '') }}>10</option>
                                    <option value="11" {{ ($months == "11" ? 'selected="selected"' : '') }}>11</option>
                                    <option value="12" {{ ($months == "12" ? 'selected="selected"' : '') }}>12</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="c-select filter restYears" id="year1" name="year1">
                                    @for($i=$startyear; $i<=($startyear+10); $i++)
                                    <option value="{{ $i }}" {{ ($year == $i ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-4">
                                <button type="button" class="c-btn c-btn--info findBestOfice"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>

                        </div>

                        <h5 class="c-graph-card__number center workplaces" ></h5>
                        <p class="c-graph-card__date center address"></p>
                        <h4 class="center"><b class="workplaceHours center">0</b>: hours</h4>

                    </div>
                    <div class="c-graph-card__chart">
    <!--                     <canvas id="js-chart-earnings" width="300" height="74"></canvas> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="c-modal c-modal--huge modal fade" id="workPlaceList" tabindex="-1" role="dialog" aria-labelledby="workPlaceList">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content modal-content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title">Objektliste ( <b class="wpname"></b>)</h3>
                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </span>
                </div>
                <div class="c-modal__body">
                    <table class="c-table" id="testdatatable">
                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.Worker') }}</th>
                                <th class="c-table__cell c-table__cell--head">{{ trans('words.date') }}</th>
                                <th class="c-table__cell c-table__cell--head">{{ trans('words.total_time') }}&nbsp;&nbsp;</th>
                                <th class="c-table__cell c-table__cell--head" style="max-width: 10%;">{{ trans('words.reason') }}&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <p class="c-btn c-btn--green pull-right" >Total Time : <span class="totaltime"></span></p>
                </div>
                <footer class="c-modal__footer"  >

                </footer>
            </div>
        </div>
    </div>
    <div class="c-modal c-modal--huge modal fade" id="staffPlaceList" tabindex="-1" role="dialog" aria-labelledby="workPlaceList">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content modal-content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title">Mitarbeiterliste ( <b class="staffName"></b>)</h3>
                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </span>
                </div>
                <div class="c-modal__body staffListAppend">

                    <table class="c-table" id="staffListAppend-datatable" width="100%">
                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.Workplaces') }}</th>
                                <th class="c-table__cell c-table__cell--head">{{ trans('words.date') }}</th>
                                <th class="c-table__cell c-table__cell--head">{{ trans('words.start-time') }}&nbsp;&nbsp;</th>
                                <th class="c-table__cell c-table__cell--head">{{ trans('words.end-time') }}&nbsp;&nbsp;</th>
                                <th class="c-table__cell c-table__cell--head">{{ trans('words.pause-time') }}&nbsp;&nbsp;</th>
                                <th class="c-table__cell c-table__cell--head">{{ trans('words.total_time') }}&nbsp;&nbsp;</th>
                                <th class="c-table__cell c-table__cell--head" style="max-width: 10%;">{{ trans('words.reason') }}&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <p class="c-btn c-btn--green pull-right" style="margin-right: 10px">{{ trans('words.total_time') }} :<span class="total_time"></span></p>
                    <p class="c-btn c-btn--green pull-right" style="margin-right: 10px">{{ trans('words.disease') }} :<span class="disease"></span></p>
                    <p class="c-btn c-btn--green pull-right" style="margin-right: 10px">{{ trans('words.holiday') }} :<span class="holiday"></span></p>
                </div>
                <footer class="c-modal__footer">                    
                </footer>
            </div>

        </div>
    </div>
</div>
<div id='DivIdToPrint' style="display: none;">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="c-modal__content modal-content">
            <div class="c-modal__header">
                <h3 class="c-modal__title">Workplaces List ( <b class="wpname"></b>)</h3>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </div>
            <div class="c-modal__body">
            </div>
        </div>
    </div>
</div>
<div id='staffToPrint' style="display: none;">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="c-modal__content modal-content">
            <div class="c-modal__header">
                <h3 class="c-modal__title">Staff List ( <b class="staffName"></b>)</h3>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </div>
            <div class="c-modal__body staffListAppendPrint">
            </div>
        </div>
    </div>
</div>

<div class="c-modal c-modal--huge modal fade" id='newInformation' style="display: none;" tabindex="-1" role="dialog" aria-labelledby="workPlaceList">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="c-modal__content modal-content">
            <div class="c-modal__header">
                <h3 class="c-modal__title">Neue Information</h3>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </div>
            <div class="c-modal__body staffListAppendPrint">
                <table class="c-table" id="newInformation-datatable">
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">ID</th>
                            <th class="c-table__cell c-table__cell--head">Date&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Worker&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Staffnumber&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Workplace</th>
                            <th class="c-table__cell c-table__cell--head">Missing Time</th>
                            <th class="c-table__cell c-table__cell--head no-sort">Supervisior Reason</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>

            </div>
            <footer class="c-modal__footer"  >

            </footer>

        </div>
    </div>
</div>
</div><!-- // .container -->
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
    .c-graph-card__number {
        font-size: 1.6rem !important;
    }
    .center {
        text-align: center !important;
    }
</style>

@endsection
