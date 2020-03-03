@extends('layouts.app')
@section('content')
@include('layouts.include.body_header')

<div class="container-fluid">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="c-field u-mb-small">
                                    <h4>{{ trans('customer.newcustomer') }} / {{ trans('customer.interested') }}</h4>
                                    <hr>
                                </div> 
                            </div>
                        </div>
                        
                        <form name="add-customer" id="addCustomer" action="{{ route('add-customer') }}" method="post">
                            <div class="col-lg-12">
                                <div class="row addcustomer"> 
                                
                                <div class="col-lg-6"> 
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="customerNumber">{{ trans('customer.customernumber') }}</label>   
                                            <input class="c-input customerNumber" type="text" name="customerNumber[]" id="customerNumber"  > 
                                        </div>  
                                    
                                        <div class="c-field u-mb-small">
                                            <div class="row">
                                                <div class="col-lg-6"> 
                                                    <input type="radio" name='customerType[]' value="customer" checked="checked">Corporate Customer
                                                </div>
                                                <div class="col-lg-6"> 
                                                    <input type="radio" name='customerType[]' value="interested">Private Customer
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                        
                                         <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="companyName">{{ trans('customer.companyname') }}</label>   
                                            <input class="c-input companyName" type="text" name="companyName[]" id="companyName"> 
                                        </div>
                                        
                                        <div class="c-field u-mb-small">
                                            <div class="row">
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="address">{{ trans('customer.address') }}</label>   
                                                    <input class="c-input address" type="text" name="address[]" id="address"> 
                                               </div>
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="state">{{ trans('customer.plzstate') }}</label>   
                                                    <input class="c-input state" type="text" name="state[]" id="state"> 
                                               </div>
                                            </div>
                                        </div>
                                        
                                        <div class="c-field u-mb-small">
                                            <div class="row">
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="telephone">{{ trans('customer.telephone') }}</label>   
                                                    <input class="c-input telephone" type="text" name="telephone[]" id="telephone"> 
                                               </div>
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="fax">{{ trans('customer.fax') }}</label>   
                                                    <input class="c-input fax" type="text" name="fax[]" id="fax"> 
                                               </div>
                                            </div>
                                        </div>
                                        
                                        <div class="c-field u-mb-small">
                                            <div class="row">
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="email">{{ trans('customer.email') }}</label>   
                                                    <input class="c-input cust_email" type="text" name="email[]" id="email"> 
                                               </div>
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="web">{{ trans('customer.web') }}</label>   
                                                    <input class="c-input web" type="text" name="web[]" id="web"> 
                                               </div>
                                            </div>
                                        </div>
                                    
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="taxNumber">{{ trans('customer.taxnumber') }}</label>   
                                            <input class="c-input taxNumber" type="text" name="taxNumber[]" id="taxNumber"> 
                                        </div>  
                                        
                                        <div class="c-field u-mb-small">
                                            <label class="c-field__label" for="note">{{ trans('customer.note') }}</label>   
                                            <textarea class="c-input note" name="note[]" id="note"></textarea>
                                        </div> 
                                    <br> 
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="appendContact">
                                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
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
                                            <select class="c-input contactGender" id="type" name="gender[]">
                                                    <option value="">{{ trans('words.pleaseSelect') }}</option>
                                                    <option value="Male">{{ trans('customer.male') }}</option>
                                                    <option value="Female">{{ trans('customer.female') }}</option>
                                            </select>
                                        </div>

                                        <div class="c-field u-mb-small">
                                            <div class="row">
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="firstName">{{ trans('customer.firstname') }}</label>   
                                                    <input class="c-input contactFirstName" type="text" name="firstName[]" id="firstName"> 
                                               </div>
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="surName">{{ trans('customer.surname') }}</label>   
                                                    <input class="c-input contactSurName" type="text" name="surName[]" id="surName"> 
                                               </div>
                                            </div>
                                        </div>
                                        
                                        <div class="c-field u-mb-small">
                                            <div class="row">
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="contacttelephone">{{ trans('customer.telephone') }}</label>   
                                                    <input class="c-input contactTelephone" type="text" name="contacttelephone[]" id="contacttelephone"> 
                                               </div>
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="contactfax">{{ trans('customer.fax') }}</label>   
                                                    <input class="c-input contactFax" type="text" name="contactfax[]" id="contactfax"> 
                                               </div>
                                            </div>
                                        </div>
                                        
                                        <div class="c-field u-mb-small">
                                            <div class="row">
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="mobile">{{ trans('customer.mobile') }}</label>   
                                                    <input class="c-input contactMobile" type="text" name="mobile[]" id="mobile"> 
                                               </div>
                                               <div class="col-lg-6"> 
                                                    <label class="c-field__label" for="contactEmail">{{ trans('customer.email') }}</label>   
                                                    <input class="c-input contactEmail" type="text" name="contactEmail[]" id="contactEmail"> 
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
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="c-field u-mb-small">
                                        <div class="row">
                                                <div class="col-lg-6">
                                                    <h4>{{ trans('customer.privacy') }} </h4>
                                                </div>
                                        </div>
                                        <hr>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="registerDate">{{ trans('customer.registerdate') }}</label>   
                                                <input class="c-input" type="text" name="registerDate" id="datepicker"  > 
                                            </div> 
                                            
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="timeline">{{ trans('customer.howlongdosethesystemneedtosave') }}</label>   
                                                <select class="c-input" id="timeline" name="timeline">
                                                    <option value="">{{ trans('customer.selectstimeperiod') }}</option>
                                                    <option value="1">{{ trans('customer.sixmonth') }}</option>
                                                    <option value="2">{{ trans('customer.oneyear') }}</option>
                                                    <option value="3">{{ trans('customer.twoyear') }}</option>
                                                    <option value="4">{{ trans('customer.threeyear') }}</option>
                                                    <option value="5">{{ trans('customer.fouryear') }}</option>
                                                    <option value="6">{{ trans('customer.fiveyear') }}</option>
                                            </select>
                                            </div> 
                                            
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="lastUpdate">{{ trans('customer.lastupdate') }}</label>   
                                                <input class="c-input" type="text" name="lastUpdate" id="datepicker_search1"  > 
                                            </div> 
                                            
                                            <div class="c-choice c-choice--checkbox">
                                                <p><input name="remeber" type="checkbox" value="yes">{{ trans('customer.rememberfordeletewithmail') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="c-field u-mb-small">
                                                <label class="c-field__label" for="purpose">{{ trans('customer.memoryforpurpose') }}</label>   
                                                <textarea class="c-input" name="purpose" id="purpose"></textarea>
                                            </div>  
                                        </div>
                                        
                                     
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

