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
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="reason">{{ trans('words.Information') }} {{ trans('words.supervisior') }} </label>   
                                        <input id="reason" name="sup_reason" class="c-input" type="text" value="{{ $objinformationreason[0]['supervisior_reson'] }}"/>
                                    </div>
                                </div>
                                <input class="c-input" type="hidden" name="informationid" id="id" value="{{ $id }}" /> 
                                <div class="col-lg-3">
                                     
                                    <div class="col u-mb-medium">
                                        <label class="c-field__label" for="adresses">&nbsp;</label>   
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
    input.has-error {
        border-color: red;
    }
</style>
  <script type="text/javascript">
        /* time picker javascript*/
            $('#start_time').timepicker('hh:mm:ss');
            $('#end_time').timepicker('hh:mm:ss');
            $('#pausetime').timepicker('hh:mm:ss');
    </script>
@endsection
