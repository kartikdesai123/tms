@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-xl-12">
            <article class="c-stage" id="stages">
                <a class="c-stage__header u-flex u-justify-between collapsed" data-toggle="collapse" href="#stage-panel1" aria-expanded="false" aria-controls="stage-panel1">
                    <div class="o-media">
                        <!--                                    <div class="c-stage__header-img o-media__img">
                                                                <img src="img/recent1.jpg" alt="About the image">
                                                            </div>-->
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">{{ trans('customer.customerdetails') }}</h6>
                            <!--<p class="u-text-xsmall u-text-mute">Posted 2 days ago  |  Expert ($$$)  |  Est. Time: Less than 1 week</p>-->
                        </div>
                    </div>

                    <i class="fa fa-angle-down u-text-mute"></i>
                </a>

                <div class="c-stage__panel c-stage__panel--mute collapse" id="stage-panel1" style="">
                    <div class="u-p-medium">
                        <!--<p class="u-text-mute u-text-uppercase u-text-small u-mb-xsmall">Description</p>-->
                        <!--<p class="u-mb-medium">What we have done so far is brighten the colour palette, created new “easy to understand” icons, overall organization of the page and also worked on the copy! After first user tesing  we got some great results - users that went through the page could navigate easily and explain Tapdaq’s services right after.</p>-->
                        @if(count($customer))
                        @foreach($customer as $value)
                        <p class="u-text-mute u-text-uppercase u-text-small u-mb-xsmall">{{ trans('customer.customerdetails') }}</p>
                        <div class="row">
                            <div class="col-md-7">
                                <ul>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.customernumber') }} :- {{$value->customerNo}}  
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.customertype') }} :-  {{$value->customerType}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.companyname') }} :-  {{$value->companyName}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.address') }}:-  {{$value->address}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.plzstate') }} :-  {{$value->state}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.telephone') }} :-  {{$value->telephone}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.fax') }} :-  {{$value->fax}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.email') }} :-  {{$value->email}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.web') }} :-  {{$value->web}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.taxnumber') }}:-  {{$value->taxNumber}} 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.note') }} :-  {{$value->note}} 
                                    </li>

                                </ul>
                            </div>

                            <div class="col-md-5">
                                <p class="u-text-mute u-text-uppercase u-text-small u-mb-xsmall">Privacy Details</p>

                                <ul>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.registerdate') }} :- @php echo date('d.m.Y', strtotime($value->registerDate)) @endphp
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.howlongdosethesystemneedtosave') }}	 :-  @if($value->timeLine == 1) {{$value->timeLine}} Month @else {{$value->timeLine}} Year @endif  
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.lastupdate') }} :- @php echo date('d.m.Y', strtotime($value->updatedDate)) @endphp 
                                    </li>
                                    <li class="u-mb-xsmall u-text-small u-color-primary">
                                        <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.memoryforpurpose') }} :-  {{$value->purpose}} 
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- // .c-stage__panel -->
                @endforeach
                @endif

                @if(count($customercontactedit))
                @php $i=1; @endphp
                @foreach($customercontactedit as $value)

                <a class="c-stage__header u-flex u-justify-between" data-toggle="collapse" href="#stage-pane-{{ $i }}" aria-expanded="false" aria-controls="stage-panel2">
                    <h6 class="u-text-mute u-text-uppercase u-text-small u-mb-zero">{{ trans('customer.customerlist') }}  @php echo $i;  @endphp</h6>

                    <i class="fa fa-angle-down u-text-mute"></i>
                </a>

                <div class="c-stage__panel c-stage__panel--mute collapse" id="stage-pane-{{ $i }}">
                    <div class="u-p-medium">
                        <div class="col-md-7">
                            <ul>
                                <li class="u-mb-xsmall u-text-small u-color-primary">
                                    <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.customername') }} :- {{$value->firstName}}  {{$value->lastName}} 
                                </li>
                                <li class="u-mb-xsmall u-text-small u-color-primary">
                                    <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.gender') }}:-  {{$value->gender}} 
                                </li>
                                <li class="u-mb-xsmall u-text-small u-color-primary">
                                    <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.telephone') }} :-  {{$value->telephone}} 
                                </li>

                                <li class="u-mb-xsmall u-text-small u-color-primary">
                                    <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.mobile') }} :-  {{$value->mobile}} 
                                </li>

                                <li class="u-mb-xsmall u-text-small u-color-primary">
                                    <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.fax') }} :-  {{$value->fax}} 
                                </li>
                                <li class="u-mb-xsmall u-text-small u-color-primary">
                                    <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.email') }} :-  {{$value->email}} 
                                </li>


                                <li class="u-mb-xsmall u-text-small u-color-primary">
                                    <i class="fa fa-check u-color-info u-text-mute u-mr-xsmall"></i>{{ trans('customer.note') }} :-  {{$value->note}} 
                                </li>

                            </ul>
                        </div>
                    </div>   
                </div><!-- // .c-stage__panel -->
                @php $i++; @endphp
                @endforeach
                @endif

            </article><!-- // .c-stage -->


        </div>
        <div class="col-12">
            <div class="c-table-responsive">
                <table class="c-table" id="datatable">
                    <caption class="c-table__title">
                        {{ trans('customer.workplacedetail') }}
                        <a class="c-table__title-action c-tooltip c-tooltip--left" href="javascript:;" data-toggle="modal" data-target="#myModal1" aria-label="add-workplace">
                            <i class="fa fa-plus "></i>
                        </a>
                    </caption>
                    <thead class="c-table__head c-table__head--slim">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head" style="margin-left: 5px;">Workplace Name</th>

                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.telephone') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.address') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.email') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.web') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head">{{ trans('customer.responsibleworker') }} &nbsp;&nbsp;</th>
                            <th class="c-table__cell c-table__cell--head no-sort">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($arrCustomer))
                        @foreach($arrCustomer as $value)
                        <tr>
                            <td class="c-table__cell">{{ $value->workplaceName }}</td>

                            <td class="c-table__cell">{{ $value->telephone }}</td>
                            <td class="c-table__cell">{{ $value->address }}</td>
                            <td class="c-table__cell">{{ $value->email }}</td>
                            <td class="c-table__cell">{{ $value->web }}</td>
                            <td class="c-table__cell">{{ $value->responsibleWorker }}</td>

                            <td class="c-table__cell">

                                <a href="javascript:;" data-toggle="modal" data-target="#myModal1_view" class="view_workplace" data-id="{{ $value->id }}">

                                    <span class="c-tooltip c-tooltip--top" aria-label="{{ trans('customer.view') }}">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </a>
                                
                                <a href="javascript:;" data-toggle="modal" data-target="#myModal1_edit" class="unblock edit_workplace" data-workplace_id="{{ $value->id }}">

                                    <span class="c-tooltip c-tooltip--top" aria-label="{{ trans('customer.edit') }}">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                </a>

                                <a href="javascript:;"  data-customerid ="{{ $customerId }}" data-id="{{ $value->id }}" class="delete">
                                    <span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="{{ trans('customer.delete') }}">
                                        <i class="fa fa-trash-o"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

            </div><!-- // .col-12 -->
        </div>
    </div>

</div><!-- // .container -->
<div class="c-modal c-modal--huge fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModal1" data-backdrop="static">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="modal-content">
            <header class="c-modal__header">
                <h1 class="c-modal__title">Add New Workplaces</h1>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </header>
            <div class="c-modal__body u-text-center u-pb-small">
                <form name="add-customer" id="addCustomer" action="{{ route('add_workplacedetails') }}" method="post">
                    <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                    <div class="row">
                        <div class="col-lg-6"> 
                            <input class="c-input" type="hidden" name="customerID" id="_token" value="{{ $customerId }}"> 
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="companyName">Workplace Name</label>   
                                <input class="c-input" type="text" name="workplaceName" id="workplaceName"> 
                                @if(count($arrCustomer))
                                @foreach($arrCustomer as $value)
                                    <input class="c-input" type="hidden" name="customerNo" id="workplaceName" value="{{ $value->customerNo }}">
                                @endforeach
                                @endif
                            </div>

                            <div class="c-field u-mb-small">
                                <div class="row">
                                    <div class="col-lg-6"> 
                                        <label class="c-field__label" for="address">{{ trans('customer.address') }}</label>   
                                        <input class="c-input" type="text" name="address" id="address"> 
                                    </div>
                                    <div class="col-lg-6"> 
                                        <label class="c-field__label" for="state">{{ trans('customer.plzstate') }}</label>   
                                        <input class="c-input" type="text" name="state" id="state"> 
                                    </div>
                                </div>
                            </div>

                            <div class="c-field u-mb-small">
                                <div class="row">
                                    <div class="col-lg-6"> 
                                        <label class="c-field__label" for="telephone">{{ trans('customer.telephone') }}</label>   
                                        <input class="c-input" type="text" name="telephone" id="telephone"> 
                                    </div>
                                    <div class="col-lg-6"> 
                                        <label class="c-field__label" for="fax">{{ trans('customer.fax') }}</label>   
                                        <input class="c-input" type="text" name="fax" id="fax"> 
                                    </div>
                                </div>
                            </div>

                            <div class="c-field u-mb-small">
                                <div class="row">
                                    <div class="col-lg-6"> 
                                        <label class="c-field__label" for="email">{{ trans('customer.email') }}</label>   
                                        <input class="c-input" type="text" name="email" id="email"> 
                                    </div>
                                    <div class="col-lg-6"> 
                                        <label class="c-field__label" for="web">{{ trans('customer.web') }}</label>   
                                        <input class="c-input" type="text" name="web" id="web"> 
                                    </div>
                                </div>
                            </div>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="taxNumber">{{ trans('customer.responsibleworker') }}</label>   

                                <select class="c-select c-select--multiple responsibleWorker" id="select3" name="responsibleWorker[]">
                                    <option value="Worker1">Worker1</option>
                                    <option value="Worker2">Worker2</option>
                                    <option value="Worker3">Worker3</option>
                                    <option value="Worker4">Worker4</option>
                                    <option value="Worker5">Worker5</option>
                                </select>
                            </div>  

                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="note">{{ trans('customer.note') }}</label>   
                                <textarea class="c-input" name="note" id="note"></textarea>
                            </div> 

                            <br> 
                        </div>
                        <div class="col-lg-6">
                            <div class="appendContact">
                                
                                <div class="c-field u-mb-small">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4>{{ trans('customer.contact') }} </h4>
                                        </div>
                                        <div class="col-lg-6">  
                                            <i class="fa fa-plus-circle pull-right addContact" style="margin-top:10px;margin-right: 15px"></i>
                                        </div>
                                    </div>
                                    <hr>
                                </div> 

                                <div class="c-field u-mb-small">
                                    <label class="c-field__label" for="gender">{{ trans('words.gender') }}</label>
                                    <select class="c-input wp_gender" id="type" name="gender[]">
                                        <option value="">{{ trans('words.pleaseSelect') }}</option>
                                        <option value="Male">{{ trans('customer.male') }}</option>
                                        <option value="Female">{{ trans('customer.female') }}</option>
                                    </select>
                                </div>

                                <div class="c-field u-mb-small">
                                    <div class="row">
                                        <div class="col-lg-6"> 
                                            <label class="c-field__label" for="firstName">{{ trans('customer.firstname') }}</label>   
                                            <input class="c-input wp_firstname" type="text" name="firstName[]" id="firstName"> 
                                        </div>
                                        <div class="col-lg-6"> 
                                            <label class="c-field__label" for="surName">{{ trans('customer.surname') }}</label>   
                                            <input class="c-input wp_surname" type="text" name="surName[]" id="surName"> 
                                        </div>
                                    </div>
                                </div>

                                <div class="c-field u-mb-small">
                                    <div class="row">
                                        <div class="col-lg-6"> 
                                            <label class="c-field__label" for="contacttelephone">{{ trans('customer.telephone') }}</label>   
                                            <input class="c-input wp_telephone" type="text" name="contacttelephone[]" id="contacttelephone"> 
                                        </div>
                                        <div class="col-lg-6"> 
                                            <label class="c-field__label" for="contactfax">{{ trans('customer.fax') }}</label>   
                                            <input class="c-input wp_fax" type="text" name="contactfax[]" id="contactfax"> 
                                        </div>
                                    </div>
                                </div>

                                <div class="c-field u-mb-small">
                                    <div class="row">
                                        <div class="col-lg-6"> 
                                            <label class="c-field__label" for="mobile">{{ trans('customer.mobile') }}</label>   
                                            <input class="c-input wp_mobile" type="text" name="mobile[]" id="mobile"> 
                                        </div>
                                        <div class="col-lg-6"> 
                                            <label class="c-field__label" for="contactEmail">{{ trans('customer.email') }}</label>   
                                            <input class="c-input wp_email" type="text" name="contactEmail[]" id="contactEmail"> 
                                        </div>
                                    </div>
                                </div>

                                <div class="c-field u-mb-small">
                                    <label class="c-field__label" for="contactnote">{{ trans('customer.note') }}</label>   
                                    <textarea class="c-input" name="contactnote[]" id="contactnote"></textarea>
                                </div> 
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col u-mb-medium">
                            <label class="c-field__label" for="type">&nbsp;</label>
                            <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.save') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="c-modal c-modal--huge fade" id="myModal1_edit" tabindex="-1" role="dialog" aria-labelledby="myModal1" data-backdrop="static">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="modal-content">
            <header class="c-modal__header">
                <h1 class="c-modal__title">Edit Workplaces</h1>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </header>
            <div class="c-modal__body u-text-center u-pb-small editappendContact">
                
            </div>
        </div>
    </div>
</div>
<div class="c-modal c-modal--huge fade" id="myModal1_view" tabindex="-1" role="dialog" aria-labelledby="myModal1" data-backdrop="static">
    <div class="c-modal__dialog modal-dialog" role="document">
        <div class="modal-content">
            <header class="c-modal__header">
                <h1 class="c-modal__title">View Workplaces</h1>
                <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </span>
            </header>
            <div class="c-modal__body u-pb-small">

                <div class="viewappendContact">
                  
                </div>
                
            </div>
        </div>
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
    
    select.has-error {
        border-color: red;
    }

    .c-field__label {
        text-align: left;
    }
    h1, h2, h3, h4, h5, h6 {
    text-align: left;
    }
    
</style>
@endsection

