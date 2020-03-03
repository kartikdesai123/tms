@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-workplaces" id="addWorkplaces" action="{{ route('workplaces-add') }}" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productName">{{ trans('words.company-name') }}</label> 
                                        <input class="c-input" type="text" name="company" id="company" placeholder="Enter Company Name"> 
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" required> 
                                    </div>
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="adresses">{{ trans('words.enter-address') }}</label>   
                                        <textarea class="c-input" name="adresses" id="adresses" placeholder="Enter Address"></textarea>
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
<style>
    input.has-error {
        border-color: red;
    }
</style>
@endsection
