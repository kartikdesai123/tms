@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('customer-add') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b>Timesheet</b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Worker</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input" id="type" name="type">
                                        @for($i = 0 ;$i < count($arrUser);$i++,$count++)
                                        <option value="{{ $arrUser[$i]->name }}">{{ $arrUser[$i]->name }}</option>
                                        @endfor
                                        </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Workplaces</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input" id="type" name="type">
                                        @for($i = 0 ;$i < count($arrWorkplaces);$i++,$count++)
                                        <option value="{{ $arrWorkplaces[$i]->company }}">{{ $arrWorkplaces[$i]->company }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Date</label>
                                           <input id="datepicker_search" class="date c-input"type="date" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                         <label class="c-field__label" for="type">Action</label>
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Save">
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

<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="timesheet-list" id="addTimesheet" action="{{ route('timesheet-list') }}" method="post">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Select Date</label>
                                           <input id="datepicker" name="c_date" class="date c-input"type="date" />

                                           <input class="c-input" type="hidden" name="worker_id" id="worker_id" value="{{ $detail['id'] }}"> 


                                           <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Workplaces</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input" id="workplaces" name="workplaces">
                                        @for($i = 0 ;$i < count($arrWorkplaces);$i++,$count++)
                                        <option value="{{ $arrWorkplaces[$i]->company }}">{{ $arrWorkplaces[$i]->company }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Start Time</label>
                                        <input id="timepicker1" name="start_time" class="c-input" type="time" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">End Time</label>
                                        <input id="start_timepicker" name="end_time" class="c-input"type="time" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">Pause Time</label>
                                        <input id="start_timepicker" name="pause_time" class="c-input"type="time" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="Add">
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

@endsection
