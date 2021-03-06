@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="editInformation" id="editInformation" action="" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" /> 
                                    <input id="start_time" name="timesheet_edit_date" class="c-input" type="hidden" value="{{ $objinformationreason[0]['c_date'] }}"/>
                                    <input id="start_time" name="worker_id" class="c-input" type="hidden" value="{{ $objinformationreason[0]['worker_id'] }}"/>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.Workplaces') }}</label>
                                         @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input" id="workplaces" name="workplaces">
                                        <!--<option value="other">Other</option>-->
                                        @for($i = 0 ;$i < count($workplacesList);$i++,$count++)
                                        <option value="{{ $workplacesList[$i]->company }}" {{ ($workplacesList[$i]->company == $objinformationreason[0]['workplaces'] ? 'selected="selected"' : '') }}>{{ $workplacesList[$i]->company }}</option>
                                        @endfor
                                        </select>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('words.start-date') }}</label>

                                        <input id="datepicker_1search" name="start_date" class="c-input" type="text"  placeholder="dd.mm.yyyy" value='{{ date("d.m.Y",strtotime($objinformationreason[0]['c_date'])) }}' autocomplete="off">
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="adresses">{{ trans('words.start-time') }}</label>   
                                        
                                        <input id="edit_start_time" name="start_time" class="c-input" type="text" value="{{ substr($objinformationreason[0]['start_time'],0,5) }}"/>
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="adresses">{{ trans('words.end-time') }}</label>   
                                        <input id="end_time" name="end_time" class="c-input" type="text" value="{{ substr($objinformationreason[0]['end_time'],0,5) }}"/>
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="adresses">{{ trans('words.pause-time') }}</label>   
                                        <input id="pausetime" name="pause_time" class="c-input" type="text" value="{{ substr($objinformationreason[0]['pause_time'],0,5) }}"/>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="adresses">{{ trans('words.reason') }}</label>   
                                        <input id="inforamtion" name="reason" class="c-input" type="text" value="{{ $objinformationreason[0]['reason'] }}"/>
                                    </div>

                                </div>
								
                            </div>


                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="col u-mb-medium">
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
</div><!-- // .container -->
<style>
    .c-table__title .c-tooltip{
    position: absolute;
    }
    .c-table-responsive .c-table {
        display: inline-table !important;
        overflow-y: hidden;
    }
    input.has-error {
        border-color: red;
    }
</style>
  <script type="text/javascript">
        /* time picker javascript*/
            $('#edit_start_time').timepicker('hh:mm:ss');
            $('#end_time').timepicker('hh:mm:ss');
            $('#pausetime').timepicker('hh:mm:ss');
    </script>
@endsection
