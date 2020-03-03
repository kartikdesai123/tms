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
                                        <h1><b></b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('words.wo-worker') }}</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-select select2-hidden-accessible" id="name" name="nameWorker">
                                            <option value="" >{{ trans('words.all') }}</option>
                                            
                                        </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.start-date') }}</label>
                                        
                                        <input id="datepicker_1search" name="start_date" class="c-input" type="text"  placeholder="dd.mm.yyyy" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.end-date') }}</label>
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


<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<form  id="deleteDisease" action="{{ route('disease-delete')}}" method="post">
<div class="container-fluid">
    <div class="row u-mb-large">
        
        <div class="col-12">
            <div class="c-table-responsive">
                <table class="c-table" id="datatable">
                    <caption class="c-table__title">Disease Notification
    
                    </caption>
                    
                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head no-sort">
                                <input  type="checkbox" id="selectall"/>
                            </th>
                            
                            <th class="c-table__cell c-table__cell--head">{{ trans('words.name') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort">Of</th>
                            <th class="c-table__cell c-table__cell--head no-sort">Up to and including</th>
                            <th class="c-table__cell c-table__cell--head no-sort">submitted</th>
                            <th class="c-table__cell c-table__cell--head no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($diseaseList) > 0)
                            @foreach($diseaseList as $key => $value)
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">
                                        <input value="{{ $value->id }}"  name="delete[]"  type="checkbox" class="multiCheckBox"/>
                                    </th>
                                    <th class="c-table__cell c-table__cell--head">{{ $value['name']." ".$value['surname'] }}&nbsp;&nbsp;</th>
                                    <th class="c-table__cell c-table__cell--head">{{ date("d.m.Y",strtotime($value['start_date']))}}&nbsp;&nbsp;</th>
                                    <th class="c-table__cell c-table__cell--head">{{ date("d.m.Y",strtotime($value['end_date']))}}&nbsp;&nbsp;</th>
                                    <th class="c-table__cell c-table__cell--head">
                                        <input value="{{ $value->id }}" type="checkbox" class="submitBtn" {{ ($value->submited == 'submited' ? 'checked="checked"' : '') }}/>
                                    </th>

                                    <td class="c-table__cell">
                                        <a href="{{ route('edit-disease',[$value['id']])}} "><span class="c-tooltip c-tooltip--top"  aria-label="Edit">
                                                <i class="fa fa-edit" ></i></span>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head" colspan="6" style="text-align: center;color: red">No Records Founds.</th>
                            </tr>
                        @endif
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
/*    a.c-board__btn.c-tooltip.c-tooltip--top {
        position: absolute;
        margin-left: 743px;
        margin-bottom: 41px;
    }*/
.c-table__title .c-tooltip{
    position: absolute;
}
.c-table-responsive .c-table {
    display: inline-table !important;
    overflow-y: hidden;
}
</style>
@endsection
