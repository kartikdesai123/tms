@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="addDisease" id="addDisease" action="{{ route('disease')}}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b>{{ trans('words.disease')}}</b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('words.name') }}</label>
                                        @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-select select2-hidden-accessible " id="name" name="nameWorker">
                                            <option value="" >{{ trans('words.all') }}</option>
                                            @for($i = 0 ;$i < count($arrUser);$i++,$count++)
                                            <option value="{{ $arrUser[$i]->id }}" >{{ $arrUser[$i]->name }} {{ $arrUser[$i]->surname }}</option>
                                            @endfor
                                        </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.of') }}</label>

                                        <input id="datepicker_1search" name="start_date" class="c-input" type="text"  placeholder="dd.mm.yyyy" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.upto') }}</label>
                                        <input id="datepicker_2search" name="end_date" class="c-input" type="text" placeholder="dd.mm.yyyy" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <label class="c-field__label" for="type">&nbsp;</label>
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
                        <form name="add-worker" id="addWorker" action="{{ route('timesheet-list-search') }}" method="post">
                            <div class="row">
                                <div class="col-lg-4" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('words.wo-worker') }}</label>
                                        @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input serchbtn" id="name1" name="name1">
                                            <option value="">{{ trans('words.all') }}</option>
                                            @for($i = 0 ;$i < count($arrUser);$i++,$count++)
                                            <option value="{{ $arrUser[$i]->id }}" {{ ($arrUser[$i]->id == $serchbardetails['0'] ? 'selected="selected"' : '') }}>{{ $arrUser[$i]->name }} {{ $arrUser[$i]->surname }}</option>
                                            @endfor
                                        </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                </div>

                                <div class="col-lg-4" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.mon')}}</label>
                                        @php
                                        $month=['January','February','March','April','May','June','July','August','September','October','November','December'];
                                        $Nomonth=['01','02','03','04','05','06','07','08','09','10','11','12'];
                                        @endphp
                                        <select class="c-input serchbtn" id="month" name="month">
                                            <option value="">{{ trans('words.month')}}</option>
                                            
                                            @for($i = 0 ;$i < count($month);$i++)
                                                <option value="{{ $Nomonth[$i] }}" {{ ($Nomonth[$i] == $serchbardetails['1'] ? 'selected="selected"' : '') }}>{{ trans('words.'.$month[$i]) }}</option>
                                            @endfor

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4" style="padding-left:0px">
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
                                            <option value="{{ $i }}" {{ ($i == $serchbardetails['2'] ? 'selected="selected"' : '') }}>{{ $i }}</option>
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
</div>

<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<form  id="deleteDisease" action="{{ route('disease-delete')}}" method="post">
    <div class="container-fluid">
        <div class="row u-mb-large">

            <div class="col-12">
                <div class="c-table-responsive">
                    <table class="c-table" id="deseasedatatable">
                        <caption class="c-table__title">{{ trans('words.denotification') }}

                        </caption>

                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head no-sort">
                                    <input  type="checkbox" id="selectall"/>
                                </th>

                                <th class="c-table__cell c-table__cell--head">{{ trans('words.name') }}&nbsp;&nbsp;</th>
                                <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.of') }}</th>
                                <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.upto') }}</th>
                                <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.total') }}</th>
                                <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.submitted') }}</th>
                                <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>

                </div><!-- // .col-12 -->
            </div>
            <div class="col-12">
                <button id="delete_checkboxd" type="submit" class="delete_checkboxd"> 
                    {{ trans('words.delete-selected') }}
                </button> 
            </div>

        </div>
    </div><!-- // .container -->
</form>
<style>

    .c-table-responsive .c-table {
        display: table !important;
        overflow-y: hidden;
    }
    .c-table__title .c-tooltip{
        position: absolute;
    }

    input.has-error {
        border-color: red;
    }
    .has-error .select2,.has-error .select2-selection{
        color: red !important;
        border-color: red !important;
    }

</style>

@endsection
