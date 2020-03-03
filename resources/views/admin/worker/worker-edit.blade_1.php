@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="edit-worker" id="editWorker" action="{{ route('worker-edit',$workerDetail[0]['id']) }}" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.member') }}</label>
                                            <select class="c-input" id="type" name="type">
                                                    <option @if($workerDetail[0]['type'] == 'WORKER') selected="selected" @endif value="WORKER">{{ trans('words.wo-worker') }}</option>
                                                    <option @if($workerDetail[0]['type'] == 'ADMIN') selected="selected" @endif  value="ADMIN">{{ trans('words.administrator') }}</option>
                                                    <option @if($workerDetail[0]['type'] == 'SUPERVISOR') selected="selected" @endif value="SUPERVISOR">{{ trans('words.supervisior') }}</option>
                                            </select>
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                    <div class="c-field u-mb-medium">
                                        <label class="c-field__label" for="select3">{{ trans('words.Workplaces') }}</label>
                                         @php
                                        $count = 1;
                                        @endphp

                                        @php
                                        $array_workplaces = array();
                                        $array_workplaces = explode(',',$workerDetail[0]['workplaces']);
                                        //dd($array_workplaces);
                                        //dd($arrWorkplaces);
                                        @endphp

                                        <!-- Select2 jquery plugin is used -->

                                        <select class="c-select c-select--multiple" multiple="multiple" name="workplaces[]" id="places">
                                            @foreach($arrWorkplaces as $place)
                                                <option value="{{$place->company}}" @foreach($array_workplaces as $p) @if($place->company == $p)selected="selected"@endif @endforeach>{{$place->company}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('words.name') }}</label>   
                                        <input class="c-input" type="text" value="{{ $workerDetail[0]['name'] }}" name="name" id="name" placeholder="Enter Name"> 
                                  <input class="c-input" type="hidden" name="id" id="id" value="{{ $workerDetail[0]['id'] }}">
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productName">{{ trans('words.surname') }}</label> 
                                        <input class="c-input" type="text" value="{{ $workerDetail[0]['surname'] }}" name="surname" id="surname" placeholder="Enter Surname"> 
                                    </div>
                                
                                    <!-- <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="password">Password</label>   
                                        <input class="c-input" type="text" value="{{ $pass = $workerDetail[0]['password'] }}" name="password" id="password" placeholder="Enter Password">                                         
                                    </div> -->
                                     <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="staffnumber">{{ trans('words.staff-number') }}</label>   
                                    
                                    <td class="c-table__cell">
                                         <input class="c-input" type="text" name="staffnumber" id="staffnumber" value="{{ $workerDetail[0]['staffnumber'] }}" placeholder="Enter Staffnumber" > 
                                    </div>  
                                                                      
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
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
<style>
    input.has-error {
        border-color: red;
    }
</style>
@endsection
