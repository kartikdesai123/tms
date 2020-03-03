@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('timesheet-list-search') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b>{{ trans('words.timesheet')}}</b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('words.wo-worker') }}</label>
                                        @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input serchbtn" id="name" name="name">
                                            <option value="">{{ trans('words.all') }}</option>
                                            @for($i = 0 ;$i < count($arrUser);$i++,$count++)
                                            <option value="{{ $arrUser[$i]->id }}" {{ ($arrUser[$i]->id == $serchbardetails['0'] ? 'selected="selected"' : '') }}>{{ $arrUser[$i]->name }} {{ $arrUser[$i]->surname }}</option>
                                            @endfor
                                        </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                </div>
                                <div class="col-lg-3" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.workerplace') }}</label>
                                        @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input serchbtn" id="workplaces" name="workplaces">
                                            <option value="">{{ trans('words.all') }}</option>
                                            @for($i = 0 ;$i < count($arrWorkplaces);$i++,$count++)
                                            <option value="{{ $arrWorkplaces[$i]->company }}" {{ ($arrWorkplaces[$i]->company == $serchbardetails['1'] ? 'selected="selected"' : '') }}>{{ $arrWorkplaces[$i]->company }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.mon')}}</label>
                                        @php
                                        $month=['January','February','March','April','May','June','July','August','September','October','November','December'];
                                        $Nomonth=['01','02','03','04','05','06','07','08','09','10','11','12'];
                                        @endphp
                                        <select class="c-input serchbtn" id="month" name="month">

                                            <option value="">{{ trans('words.month')}}</option>

                                            @for($i = 0 ;$i < count($month);$i++)
                                            <option value="{{ $Nomonth[$i] }}" {{ ($Nomonth[$i] == $serchbardetails['2'] ? 'selected="selected"' : '') }}>{{ trans('words.'.$month[$i]) }}</option>
                                            @endfor

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label " for="type">{{ trans('words.ye')}}</label>
                                        @php
                                        $year =date("Y");
                                        $startyear=$year - 5 ;
                                        $endyear=$year + 2 ;
                                        @endphp
                                        <select class="c-input serchbtn" id="year" name="year">
                                            <option value="">{{ trans('words.year')}}</option>
                                            @for($i = $startyear ;$i <= $endyear;$i++)
                                            <option value="{{ $i }}" {{ ($i == $serchbardetails['3'] ? 'selected="selected"' : '') }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <!--                                <div class="col-lg-2" style="padding:0px">
                                                                    <div class="col ">
                                                                        <label class="c-field__label" for="type">&nbsp;</label>
                                                                        <input type="submit" class="col-lg-12 c-btn c-btn--info " value="{{ trans('words.search') }}">
                                                                    </div>
                                                                </div>-->
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
                <table class="c-table" id="timesheetdatatable">
                    <caption class="c-table__title">
                        <span>{{ trans('words.timesheet-list') }}</span>
                        <span class="pull-right c-badge u-h5 c-badge--success"><i class="fa fa-clock-o"></i>{{ trans('words.total_time') }}: {{ $total_time }}</span>
                    </caption>

                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.id') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.date') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.staff-number') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.name') }} {{ trans('words.surname') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.workerplace') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.start-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.end-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.pause-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.total') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.reason') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.action') }}&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--                        @php
                                                $count = 1;
                                                @endphp
                                                @for($i = 0 ;$i < count($arrTimesheet);$i++,$count++)
                                                <tr class="c-table__row">
                                                    <td class="c-table__cell">{{ $count }}</td>
                                                    <td class="c-table__cell">
                                                        @php
                                                        $newDate = date("d.m.Y", strtotime($arrTimesheet[$i]->c_date));
                                                        @endphp{{ $newDate }}</td>
                                                    <td class="c-table__cell">{{ $arrTimesheet[$i]->staffnumber }}</td>
                                                    <td class="c-table__cell">{{ $arrTimesheet[$i]->name }} {{ $arrTimesheet[$i]->surname}}</td>
                                                    <td class="c-table__cell">{{ $arrTimesheet[$i]->workplaces }}</td>
                                                    <td class="c-table__cell">{{ $arrTimesheet[$i]->start_time }}</td>
                                                    <td class="c-table__cell">{{ $arrTimesheet[$i]->end_time }}</td>
                                                    <td class="c-table__cell">{{ $arrTimesheet[$i]->pause_time }}</td>
                                                    <td class="c-table__cell">{{ $arrTimesheet[$i]->total_time }}</td>
                                                    <td class="c-table__cell">{{ $arrTimesheet[$i]->reason }}</td>
                        
                                                    <td class="c-table__cell">
                                                        <a href=" {{ route('timesheet-edit',[$arrTimesheet[$i]->id])}} "><span class="c-tooltip c-tooltip--top"  aria-label="{{ trans('words.edit') }}">
                                                                <i class="fa fa-edit" ></i></span>
                                                        </a>
                                                        <a href="javascript:;" class="delete"  data-id="{{ $arrTimesheet[$i]->id }}"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="{{ trans('words.delete') }}">
                                                                <i class="fa fa-trash-o" ></i></span>
                                                        </a>
                                                    </td>
                        
                        
                                                </tr>
                                                @endfor-->
                    </tbody>
                </table>

            </div><!-- // .col-12 -->
        </div>
    </div>

</div><!-- // .container -->
<style>
    /*    a.c-board__btn.c-tooltip.c-tooltip--top {
            position: absolute;
            margin-left: 743px;
            margin-bottom: 41px;
        }*/
    .c-table-responsive .c-table {
        display: inline-table !important;
        overflow-y: hidden;
    }
    .c-table__title .c-tooltip{
        position: absolute;
    }
</style>

@endsection
