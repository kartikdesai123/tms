@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="editDisease" id="editDisease" action="{{ route('edit-disease',[ $diseaseList[0]->id ])}}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b></b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('words.name') }}</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-select select2-hidden-accessible" id="name" name="nameWorker">
                                            <option value="" >{{ trans('words.all') }}</option>
                                            @for($i = 0 ;$i < count($arrUser); $i++, $count++)
                                               <option value="{{ $arrUser[$i]->id }}" {{ ($diseaseList[0]->userId == $arrUser[$i]->id ? 'selected="selected"' : '') }}>{{ $arrUser[$i]->name }}</option>
                                            @endfor
                                        </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                        <input class="c-input" type="hidden" name="editId" id="editId" value="{{ $diseaseList[0]->id }}"> 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.of') }}</label>
                                        
                                        <input id="datepicker_1search" name="start_date" class="c-input" type="text"  placeholder="dd.mm.yyyy" autocomplete="off" value="{{ date("d.m.Y",strtotime($diseaseList[0]->start_date)) }}">
                                    </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.upto') }}</label>
                                        <input id="datepicker_2search" name="end_date" class="c-input" type="text" placeholder="dd.mm.yyyy" autocomplete="off" value="{{ date("d.m.Y",strtotime($diseaseList[0]->end_date)) }}">
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
                                        <label class="c-field__label" for="type">&nbsp;</label>
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.edit') }}">
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
<style>
    .c-table-responsive .c-table {
        display: inline-table !important;
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
