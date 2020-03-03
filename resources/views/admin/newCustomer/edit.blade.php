@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form name="add-customer" id="addCustomer" action="" method="post">
                            <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
                            <input class="c-input" type="hidden" name="editId" id="id" value="{{ $customerviewList[0]->id }}"> 
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <h4> {{ trans('customer.editcustomer') }} / {{ trans('customer.interested') }}</h4>
                                        <hr>
                                    </div> 
                                </div>

                                <div class="col-lg-6"> 
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="customerNumber">{{ trans('customer.customernumber') }}</label>   
                                        <input class="c-input" type="text" name="customerNumber" id="customerNumber"  value="{{ $customerviewList[0]->customerNo }}" readonly> 
                                        <input class="c-input" type="hidden" name="cid" id="customerNumber"  value="{{ $customerviewList[0]->id }}"> 
                                    </div>  
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="timeline">Customer Type</label>   
                                        <select class="c-input customerType" id="timeline" name="customerType">
                                            <option value="">Select Customer type</option>
                                            <option value="corporate_customer" {{ ($customerviewList[0]->customerType == 'corporate_customer' ? 'selected="selected"' : '') }}> Corporate Customer</option>
                                            <option value="private_customer" {{ ($customerviewList[0]->customerType == 'private_customer' ? 'selected="selected"' : '') }}>Private Customer</option>
                                        </select>
                                    </div> 
                                    
<!--                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-lg-6"> 
                                                <input type="radio" name='customerType' value="customer" {{ ($customerviewList[0]->customerType == 'customer' ? 'checked="checked"' : '') }}>Corporate Customer
                                            </div>
                                            <div class="col-lg-6"> 
                                                <input type="radio" name='customerType' value="interested" {{ ($customerviewList[0]->customerType == 'interested' ? 'checked="checked"' : '') }}>Private Customer
                                            </div>
                                        </div>
                                    </div>-->



                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="companyName">{{ trans('customer.companyname') }}</label>   
                                        <input class="c-input" type="text" name="companyName" id="companyName" value="{{ $customerviewList[0]->companyName }}"> 
                                    </div>

                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-lg-6"> 
                                                <label class="c-field__label" for="address">{{ trans('customer.address') }}</label>   
                                                <input class="c-input" type="text" name="address" id="address" value="{{ $customerviewList[0]->address }}"> 
                                            </div>
                                            <div class="col-lg-6"> 
                                                <label class="c-field__label" for="state">{{ trans('customer.plzstate') }}</label>   
                                                <input class="c-input" type="text" name="state" id="state" value="{{ $customerviewList[0]->state }}"> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-lg-6"> 
                                                <label class="c-field__label" for="telephone">{{ trans('customer.telephone') }}</label>   
                                                <input class="c-input" type="text" name="telephone" id="telephone" value="{{ $customerviewList[0]->telephone }}"> 
                                            </div>
                                            <div class="col-lg-6"> 
                                                <label class="c-field__label" for="fax">{{ trans('customer.fax') }}</label>   
                                                <input class="c-input" type="text" name="fax" id="fax" value="{{ $customerviewList[0]->fax }}"> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                            <div class="col-lg-6"> 
                                                <label class="c-field__label" for="email">{{ trans('customer.email') }}</label>   
                                                <input class="c-input" type="text" name="email" id="email" value="{{ $customerviewList[0]->email }}"> 
                                            </div>
                                            <div class="col-lg-6"> 
                                                <label class="c-field__label" for="web">{{ trans('customer.web') }}</label>   
                                                <input class="c-input" type="text" name="web" id="web" value="{{ $customerviewList[0]->web }}"> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="taxNumber">{{ trans('customer.taxnumber') }}</label>   
                                        <input class="c-input" type="text" name="taxNumber" id="taxNumber" value="{{ $customerviewList[0]->taxNumber }}"> 
                                    </div>  

                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="note">{{ trans('customer.note') }}</label>   
                                        <textarea class="c-input" name="note" id="note">{{ $customerviewList[0]->note }}</textarea>
                                    </div> 

                                    <br> 
                                </div>

                                <div class="col-lg-6">
                                    @for($i = 0 ;$i < count($customercontactedit);$i++)
                                    @if($i == 0)
                                    <div class="appendContact">
                                        @else
                                        <div class="remove">
                                            @endif

                                            <div class="c-field u-mb-small">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h4>{{ trans('customer.contact') }}</h4>
                                                    </div>
<!--                                                    @if($i == 0)
                                                    <div class="col-lg-6">  
                                                        <i class="fa fa-plus-circle pull-right addContact" style="margin-top:10px;margin-right: 15px"></i>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-6">  
                                                        <i class="fa fa-minus-circle pull-right removeContact" style="margin-top:10px;margin-right: 15px"></i>
                                                    </div>
                                                    @endif-->
                                                </div>
                                                <hr>
                                            </div> 

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="gender">{{ trans('customer.gender') }}</label>
                                                <select class="c-input " id="type" name="gender[]">
                                                    <option value="">{{ trans('customer.pleaseselect') }}</option>
                                                    <option value="Male" {{ ($customercontactedit[$i]->gender == 'Male' ? 'selected="selected"' : '') }}>{{ trans('customer.male') }}</option>
                                                    <option value="Female" {{ ($customercontactedit[$i]->gender == 'Female' ? 'selected="selected"' : '') }}>{{ trans('customer.female') }}</option>
                                                </select>
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        <label class="c-field__label" for="firstName">{{ trans('customer.firstname') }}</label>   
                                                        <input class="c-input" type="text" name="firstName[]" id="firstName" value="{{ $customercontactedit[$i]->firstName}}"> 
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        <label class="c-field__label" for="surName">{{ trans('customer.surname') }}</label>   
                                                        <input class="c-input" type="text" name="surName[]" id="surName" value="{{ $customercontactedit[$i]->lastName }}"> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        <label class="c-field__label" for="contacttelephone">{{ trans('customer.telephone') }}</label>   
                                                        <input class="c-input" type="text" name="contacttelephone[]" id="contacttelephone" value="{{ $customercontactedit[$i]->telephone }}"> 
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        <label class="c-field__label" for="contactfax">{{ trans('customer.fax') }}</label>   
                                                        <input class="c-input" type="text" name="contactfax[]" id="contactfax" value="{{ $customercontactedit[$i]->fax }}"> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        <label class="c-field__label" for="mobile">{{ trans('customer.mobile') }}</label>   
                                                        <input class="c-input" type="text" name="mobile[]" id="mobile" value="{{ $customercontactedit[$i]->mobile }}"> 
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        <label class="c-field__label" for="contactEmail">{{ trans('customer.email') }}</label>   
                                                        <input class="c-input" type="text" name="contactEmail[]" id="contactEmail" value="{{ $customercontactedit[$i]->email }}"> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="contactnote">{{ trans('customer.note') }}</label>   
                                                <textarea class="c-input" name="contactnote[]" id="contactnote">{{ $customercontactedit[$i]->note }}</textarea>
                                            </div> 
                                            <br>

                                        </div>
                                        @endfor
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="c-field u-mb-small">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h4>{{ trans('customer.privacy') }}</h4>
                                                </div>
                                            </div>
                                            <hr>
                                        </div> 
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="registerDate">{{ trans('customer.registerdate') }}</label>   
                                                    <input class="c-input" type="text" name="registerDate" id="registerDate"  value="{{ date("d.m.Y",strtotime($customerviewList[0]->registerDate))}}"> 
                                                </div> 

                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="timeline">{{ trans('customer.howlongdosethesystemneedtosave') }}</label>   
                                                    <select class="c-input" id="timeline" name="timeline">
                                                        <option value="">{{ trans('customer.selectstimeperiod') }}</option>
                                                        <option value="1" {{ ($customerviewList[0]->timeLine == 1 ? 'selected="selected"' : '') }}>{{ trans('customer.sixmonth') }}</option>
                                                        <option value="2" {{ ($customerviewList[0]->timeLine == 2 ? 'selected="selected"' : '') }}>{{ trans('customer.oneyear') }}</option>
                                                        <option value="3" {{ ($customerviewList[0]->timeLine == 3 ? 'selected="selected"' : '') }}>{{ trans('customer.twoyear') }}</option>
                                                        <option value="4" {{ ($customerviewList[0]->timeLine == 4 ? 'selected="selected"' : '') }}>{{ trans('customer.threeyear') }}</option>
                                                        <option value="5" {{ ($customerviewList[0]->timeLine == 5 ? 'selected="selected"' : '') }}>{{ trans('customer.fouryear') }}</option>
                                                        <option value="6" {{ ($customerviewList[0]->timeLine == 6 ? 'selected="selected"' : '') }}>{{ trans('customer.fiveyear') }}</option>
                                                    </select>
                                                </div> 

                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="lastUpdate">{{ trans('customer.lastupdate') }}</label>   
                                                    <input class="c-input" type="text" name="lastUpdate" id="updatedDate" value="{{ date("d.m.Y",strtotime($customerviewList[0]->updatedDate))}}" > 
                                                </div> 
                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="timeline">Select Customer Status Type</label>   
                                                    <select class="c-input" id="status" name="status">
                                                        <option value="">Select Status Type</option>
                                                        <option value="1" {{ ($customerviewList[0]->customer_status == 1 ? 'selected="selected"' : '') }}>Already Customer</option>
                                                        <option value="2" {{ ($customerviewList[0]->customer_status == 2 ? 'selected="selected"' : '') }}>Retired Customer</option>
                                                        <option value="3" {{ ($customerviewList[0]->customer_status == 3 ? 'selected="selected"' : '') }}>Prospective Customer</option>
                                                    </select>
                                                </div> 
                                                <div class="c-choice c-choice--checkbox">
                                                    <p><input name="remeber" type="checkbox" value="yes" {{ ($customerviewList[0]->reminder == 'yes' ? 'checked="checked"' : '') }}>{{ trans('customer.rememberfordeletewithmail') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                                <div class="c-field u-mb-small">
                                                    <label class="c-field__label" for="purpose">{{ trans('customer.memoryforpurpose') }}</label>   
                                                    <textarea class="c-input" name="purpose" id="purpose">{{ $customerviewList[0]->purpose }}</textarea>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col u-mb-medium">
                                        <label class="c-field__label" for="type">&nbsp;</label>
                                        <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('customer.save') }}">
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div><!-- // .col-12 -->
        </div>
    </div><!-- // .container -->
    <style>
        input.has-error {
            border-color: red;
        }

        select.has-error {
            border-color: red;
        }
    </style>

    @endsection

