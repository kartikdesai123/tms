@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')


<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('worker-list-search') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b></b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.start-date') }}</label>
                                        
                                        @if(isset($dates))
                                            <input id="datepicker_1search" name="start_date" class="date c-input" type="text" value="{{ $dates['0'] }}" >
                                        
                                        @else
                                        <input id="datepicker_search1" name="start_date" class="date c-input" type="text"  placeholder="dd.mm.yyyy">
                                        
                                        @endif
                                        
                                           
                                           <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.end-date') }}</label>
                                        @if(isset($dates))
                                            <input id="datepicker_2search" name="end_date" class="date c-input" type="text" value="{{ $dates['1'] }}" >
                                        @else
                                            <input id="datepicker_search2" name="end_date" class="date c-input" type="text" placeholder="dd.mm.yyyy" >
                                        
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                         <label class="c-field__label" for="type">&nbsp;</label>
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.save') }}">
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
<div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-table-responsive">
                <table class="c-table" id="datatable">
                    <caption class="c-table__title">
                       {{ trans('words.worker-list') }}

                        <a class="c-table__title-action c-tooltip c-tooltip--left" href="{{ route('worker-add') }}" aria-label="{{ trans('words.add-worker') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('words.id') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.staff-number') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.name') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.surname') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.work-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.pause-time') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.last-login') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.total') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @for($i = 0 ;$i < count($arrWorker);$i++,$count++)

                        <tr class="c-table__row">
                            <td class="c-table__cell">{{ $count }}</td>
                            
                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">{{ $arrWorker[$i]->staffnumber }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->staffnumber }}</td>
                                @php
                                    }
                                @endphp

                                 @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">{{ $arrWorker[$i]->name }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->name }}</td>
                                @php
                                    }
                                @endphp


                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">{{ $arrWorker[$i]->surname }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->surname }}</td>
                                @php
                                    }
                                @endphp

                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">
                                {{ $arrWorker[$i]->total_houres +  $arrWorker[$i]->pause_houres }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->total_time }}</td>
                                @php
                                    }
                                @endphp


                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                     <td class="c-table__cell">{{ $arrWorker[$i]->pause_houres }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->pause_time }}</td>
                                @php
                                    }
                                @endphp

                                
                                @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                     <td class="c-table__cell">{{ $arrWorker[$i]->last_login }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->last_login }}</td>
                                @php
                                    }
                                @endphp

                                 @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                     <td class="c-table__cell">{{ $arrWorker[$i]->total_houres }}</td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">{{ $arrWorker[$i]->total_time }}</td>
                                @php
                                    }
                                @endphp

                                 @php 
                                    if($arrWorker[$i]->worker_id == null ) 
                                    {
                                @endphp
                                    <td class="c-table__cell">
                                <a href=" {{ route('worker-edit',[$arrWorker[$i]->id])}} "><span class="c-tooltip c-tooltip--top"  aria-label="{{ trans('words.edit') }}">
                                    <i class="fa fa-edit" ></i></span>
                                </a>
                                <a href="javascript:;" class="delete"  data-id="{{ $arrWorker[$i]->id }}"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="{{ trans('words.delete') }}">
                                        <i class="fa fa-trash-o" ></i></span>
                                </a>
                            </td>
                                @php
                                    }
                                    else
                                    {
                                @endphp 
                                    <td class="c-table__cell">--</td>
                                @php
                                    }
                                @endphp
                        </tr>
                        @endfor
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
