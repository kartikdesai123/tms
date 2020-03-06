@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-worker" id="addWorker" action="{{ route('information-list-search') }}" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h1><b></b></h1>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="name">{{ trans('customer.customerlist') }}</label>
                                        @php
                                        $count = 1;
                                        @endphp
                                        <select class="c-input serchbtn" id="name" name="name">
                                            <option value="">All</option>
                                            @for($i = 0 ;$i < count($arrCustomer);$i++,$count++)
                                            <option value="{{ $arrCustomer[$i]->id }}" {{ ($arrCustomer[$i]->id == $serchbardetails['0'] ? 'selected="selected"' : '') }}>{{ $arrCustomer[$i]->firstName }} {{ $arrCustomer[$i]->lastName }} </option>
                                            @endfor
                                        </select>
                                        <input class="c-input " type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                                    </div>
                                </div>
                                <div class="col-lg-4" style="padding-left:0px">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="type">{{ trans('type') }}</label>
                                        @php
                                        $count = 1;
                                        $status = '';
                                        @endphp
                                        <select class="c-input serchbtn" id="type" name="type">
                                            <option value="">All</option>
                                            <option value="corporate_customer" {{ ($serchbardetails['1'] == "corporate_customer" ? 'selected="selected"' : '') }}>Corporate Customer</option>
                                            <option value="private_customer" {{ ($serchbardetails['1'] == "private_customer" ? 'selected="selected"' : '') }}>Private Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 style="padding-left:0px">
                                     <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="status">{{ trans('status') }}</label>
                                        @php
                                        $count = 1;
                                        $type = '';
                                        @endphp
                                        <select class="c-input serchbtn" id="status" name="status">
                                            <option value="">{{ trans('words.all') }}</option>
                                            <option value="1" {{ ($serchbardetails['2'] == 1 ? 'selected="selected"' : '') }}>Already Customer</option>
                                            <option value="2" {{ ($serchbardetails['2'] == 2 ? 'selected="selected"' : '') }}>Retired Customer</option>
                                            <option value="3" {{ ($serchbardetails['2'] == 3 ? 'selected="selected"' : '') }}>Prospective Customer</option>
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
</div><!-- // .container -->
<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-table-responsive">
                <table class="c-table" id="newcustomerdatatable">
                    <caption class="c-table__title">
                        {{ trans('customer.customerlist') }}
                        <a class="c-table__title-action c-tooltip c-tooltip--left" href="{{ route('add-customer') }}" aria-label="{{ trans('customer.addcustomer') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">{{ trans('customer.customernumber') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.customertype') }}</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.companyname') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.telephone') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.address') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.email') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Status &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.web') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.registerdate') }}&nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.timeline') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">Updated At &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!--                        @foreach($arrCustomer as $value)
                                                    <tr class="c-table__row">
                                                        <td class="c-table__cell">{{ $value->customerNo }}</td>
                                                        <td class="c-table__cell">{{ $value->customerType }}</td>
                                                        <td class="c-table__cell">{{ $value->companyName }}</td>
                                                        <td class="c-table__cell">{{ $value->telephone }}</td>
                                                        <td class="c-table__cell">{{ $value->address }}</td>
                                                        <td class="c-table__cell">{{ $value->email }}</td>
                                                        <td class="c-table__cell">{{ $value->web }}</td>
                                                         <td class="c-table__cell">{{ $value->registerDate }}</td>
                                                        <td class="c-table__cell">{{ $value->timeLine }}</td>
                                                        <td class="c-table__cell">
                                                            <a href="{{ route('customer-details',$value->id)}}">
                                                                <span class="c-tooltip c-tooltip--top" aria-label="{{ trans('customer.view') }}">
                                                                            <i class="fa fa-eye"></i></span>
                                                                    </a>
                                                            <a href="{{ route('edit-customer',$value->id)}}">
                                                                <span class="c-tooltip c-tooltip--top" aria-label="{{ trans('customer.edit') }}">
                                                                            <i class="fa fa-edit"></i></span>
                                                            </a>
                                                            <a href="javascript:;" class="delete"  data-id="{{ $value->id }}"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="{{ trans('words.delete') }}">
                                                                <i class="fa fa-trash-o" ></i></span>
                                                            </a>    
                                                        </td>
                                                    </tr>
                                                @endforeach-->
                    </tbody>
                </table>
            </div><!-- // .col-12 -->
            <div class="row">
                <div class="col-md-6 pull-right"></div>
                <div class="col-md-6">
                    <i class="fa fa-circle" style="color:#34aa44;"></i>&nbsp;&nbsp;Already Customer&nbsp;&nbsp;
                    <i class="fa fa-circle" style="color:#fd9a18;"></i>&nbsp;&nbsp;Prospective Customer&nbsp;&nbsp;
                    <i class="fa fa-circle" style="color:#ed1c24;"></i>&nbsp;&nbsp;Retired Customer&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>

</div><!-- // .container -->
<style>
    .c-table-responsive .c-table {
        display: inline-table !important;
        overflow-y: hidden;
    }
    .c-table__title .c-tooltip{
        position: absolute;
    }
</style>

@endsection

