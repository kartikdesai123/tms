<!--<form name="add-customer" id="addCustomer" action="{{ route('add_workplacedetails') }}" method="post">-->
@if(count($workplace_customer))
@foreach($workplace_customer as $value)         
<div class="row">
    <div class="col-lg-6"> 

        <div class="c-field u-mb-small">
            <label class="c-field__label" for="companyName">Workplace Name</label>   
            <input class="c-input" type="text" name="workplaceName" id="workplaceName" value="{{ $value->workplaceName }}"> 

            <input class="c-input" type="hidden" name="customerNo" id="workplace_id" value="{{ $value->id }}">

        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="address">Address</label>   
                    <input class="c-input" type="text" name="address" id="address" value="{{ $value->address }}"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="state">PLZ / State</label>   
                    <input class="c-input" type="text" name="state" id="state" value="{{ $value->state }}"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="telephone">Telephone</label>   
                    <input class="c-input" type="text" name="telephone" id="telephone" value="{{ $value->telephone }}"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="fax">Fax</label>   
                    <input class="c-input" type="text" name="fax" id="fax" value="{{ $value->fax }}"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="email">Email</label>   
                    <input class="c-input" type="text" name="email" id="email" value="{{ $value->email }}"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="web">Web</label>   
                    <input class="c-input" type="text" name="web" id="web" value="{{ $value->web }}"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <label class="c-field__label" for="taxNumber">Responsible Worker</label>   

            <select class="c-select c-select--multiple" id="select3" name="responsibleWorker[]">
                <option value="Worker1">Worker1</option>
                <option value="Worker2">Worker2</option>
                <option value="Worker3">Worker3</option>
                <option value="Worker4">Worker4</option>
                <option value="Worker5">Worker5</option>
            </select>
        </div>  

        <div class="c-field u-mb-small">
            <label class="c-field__label" for="note">Note</label>   
            <textarea class="c-input" name="note" id="note"> {{ $value->note }}</textarea>
        </div> 

        <br> 
    </div>
    @endforeach
    @endif
    @if(count($workplace_contact))
    @foreach($workplace_contact as $value)  
    <div class="col-lg-6">
        <div class="appendContact">
            <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Contact </h4>
                    </div>
                    <div class="col-lg-6">  
                        <i class="fa fa-plus-circle pull-right addContact" style="margin-top:10px;margin-right: 15px"></i>
                    </div>
                </div>
                <hr>
            </div> 

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="gender">{{ trans('words.gender') }}</label>
                <select class="c-input" id="type" name="gender[]">
                    <option value="">{{ trans('words.pleaseSelect') }}</option>
                    <option value="Male" >Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="firstName">First Name</label>   
                        <input class="c-input" type="text" name="firstName[]" id="firstName" value="{{ $value->firstName }}"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="surName">Sur Name</label>   
                        <input class="c-input" type="text" name="surName[]" id="surName" value="{{ $value->lastName }}"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="contacttelephone">Telephone</label>   
                        <input class="c-input" type="text" name="contacttelephone[]" id="contacttelephone" value="{{ $value->telephone }}"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="contactfax">Fax</label>   
                        <input class="c-input" type="text" name="contactfax[]" id="contactfax" value="{{ $value->fax }}"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <div class="row">
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="mobile">Mobile</label>   
                        <input class="c-input" type="text" name="mobile[]" id="mobile" value="{{ $value->mobile }}"> 
                    </div>
                    <div class="col-lg-6"> 
                        <label class="c-field__label" for="contactEmail">E-mail</label>   
                        <input class="c-input" type="text" name="contactEmail[]" id="contactEmail" value="{{ $value->email }}"> 
                    </div>
                </div>
            </div>

            <div class="c-field u-mb-small">
                <label class="c-field__label" for="contactnote">Note</label>   
                <textarea class="c-input" name="contactnote[]" id="contactnote">{{ $value->note }}</textarea>
            </div> 
            <br>
        </div>
    </div>

@endforeach
@else
<div class="col-lg-6">
    <div class="appendContact">
        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6">
                    <h4>Contact </h4>
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
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="firstName">First Name</label>   
                    <input class="c-input contactFirstName" type="text" name="firstName[]" id="firstName"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="surName">Sur Name</label>   
                    <input class="c-input contactSurName" type="text" name="surName[]" id="surName"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="contacttelephone">Telephone</label>   
                    <input class="c-input contactTelephone" type="text" name="contacttelephone[]" id="contacttelephone"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="contactfax">Fax</label>   
                    <input class="c-input contactFax" type="text" name="contactfax[]" id="contactfax"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <div class="row">
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="mobile">Mobile</label>   
                    <input class="c-input contactMobile" type="text" name="mobile[]" id="mobile"> 
                </div>
                <div class="col-lg-6"> 
                    <label class="c-field__label" for="contactEmail">E-mail</label>   
                    <input class="c-input contactEmail" type="text" name="contactEmail[]" id="contactEmail"> 
                </div>
            </div>
        </div>

        <div class="c-field u-mb-small">
            <label class="c-field__label" for="contactnote">Note</label>   
            <textarea class="c-input" name="contactnote[]" id="contactnote"></textarea>
        </div> 
    </div>
    @endif
    <!--                    <div class="col-lg-12">
                            <div class="col u-mb-medium">
                                <label class="c-field__label" for="type">&nbsp;</label>
                                <input type="submit" class="c-btn c-btn--info c-btn--fullwidth" value="{{ trans('words.save') }}">
                            </div>
                        </div>-->
    <!--</form>-->